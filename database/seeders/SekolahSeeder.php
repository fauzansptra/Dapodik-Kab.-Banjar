<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use App\Models\RuanganTahun;
use App\Models\SekolahTahun;
use App\Models\Tahun; // Ensure Tahun model is imported
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SekolahSeeder extends Seeder
{
    public function run()
    {
        $hasError = false; // Flag to track if an error occurs

        try {
            $filePath = storage_path('app/dataset.xlsx');

            if (!file_exists($filePath)) {
                dump("❌ Error: File dataset.xlsx not found in storage/app/");
                return;
            }

            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            foreach ($rows as $index => $row) {
                if ($index == 1) continue; // Skip header row

                try {
                    $namaSekolah = trim($row['B'] ?? '');
                    $npsn = trim($row['C'] ?? '');
                    $bentukPendidikan = trim($row['D'] ?? '');
                    $status = trim($row['E'] ?? '');
                    $lastSyncRaw = trim($row['F'] ?? '');
                    $jmlSync = (int) ($row['G'] ?? 0);
                    $jumlahPesertaDidik = (int) ($row['H'] ?? 0);
                    $jumlahRombel = (int) ($row['I'] ?? 0);
                    $jumlahGuru = (int) ($row['J'] ?? 0);
                    $jumlahPegawai = (int) ($row['K'] ?? 0);
                    $tahunValue = (int) ($row['O'] ?? 0);
                    $namaKecamatan = trim($row['P'] ?? '');

                    if (empty($namaKecamatan)) {
                        dump("⚠️ Skipping row {$index}: Kecamatan is empty");
                        continue;
                    }

                    // Find or create Kecamatan
                    $kecamatan = Kecamatan::firstOrCreate(
                        ['nama_kecamatan' => ucfirst(strtolower($namaKecamatan))],
                        ['created_at' => now(), 'updated_at' => now()]
                    );

                    if (!$kecamatan || !$kecamatan->id) {
                        dump("⚠️ Skipping row {$index}: Failed to create/find Kecamatan '{$namaKecamatan}'");
                        continue;
                    }

                    if ($tahunValue === 0) {
                        dump("⚠️ Skipping row {$index}: Tahun is missing or invalid");
                        continue;
                    }

                    // Find or create Tahun
                    $tahun = Tahun::firstOrCreate(
                        ['tahun' => $tahunValue],
                        ['created_at' => now(), 'updated_at' => now()]
                    );

                    $lastSync = null;
                    if (!empty($lastSyncRaw)) {
                        try {
                            $lastSync = Carbon::createFromFormat('d M Y H:i:s', $lastSyncRaw)->format('Y-m-d H:i:s');
                        } catch (\Exception $e) {
                            $lastSync = now();
                        }
                    }

                    // Find or create Sekolah
                    $sekolah = Sekolah::firstOrCreate(
                        ['NPSN' => $npsn],
                        [
                            'nama_sekolah'       => $namaSekolah,
                            'bentuk_pendidikan'  => $bentukPendidikan,
                            'status'             => $status,
                            'last_sync'          => $lastSync,
                            'jml_sync'           => $jmlSync,
                            'kecamatan_id'       => $kecamatan->id,
                        ]
                    );

                    if (!$sekolah || !$sekolah->id) {
                        dump("⚠️ Skipping row {$index}: Failed to create Sekolah '{$namaSekolah}' (NPSN: {$npsn})");
                        continue;
                    }

                    // Find or create SekolahTahun using tahun_id
                    $sekolahTahun = SekolahTahun::updateOrCreate(
                        ['sekolah_id' => $sekolah->id, 'tahun_id' => $tahun->id], // Use tahun_id reference
                        [
                            'jml_peserta_didik' => $jumlahPesertaDidik,
                            'jml_guru'         => $jumlahGuru,
                            'jml_pegawai'      => $jumlahPegawai,
                            'jml_rombel'       => $jumlahRombel,
                        ]
                    );

                    // Room types mapping
                    $ruanganTypes = [
                        'L' => ['jenis' => 'Kelas'],
                        'M' => ['jenis' => 'Lab'],
                        'N' => ['jenis' => 'Perpustakaan']
                    ];

                    foreach ($ruanganTypes as $column => $data) {
                        $jumlah = (int) ($row[$column] ?? 0);
                        if ($jumlah > 0) {
                            RuanganTahun::create([
                                'sekolah_tahun_id' => $sekolahTahun->id,
                                'jenis_ruangan'    => $data['jenis'],
                                'jumlah'          => $jumlah,
                            ]);
                        }
                    }
                } catch (\Exception $e) {
                    dump("❌ Error in row {$index}: {$e->getMessage()}");
                    $hasError = true;
                    continue;
                }
            }
        } catch (\Exception $e) {
            dump("❌ Seeder failed: " . $e->getMessage());
            $hasError = true;
        } finally {
            if (!$hasError) {
                dump("✅ Seeding completed successfully!");
            } else {
                dump("⚠️ Seeding completed with errors.");
            }
        }
    }
}
