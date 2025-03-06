<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use App\Models\SekolahTahun;
use App\Models\Tahun;
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

            $counter=0;
            $maxRows=300;
            foreach ($rows as $index => $row) {
                if ($index == 1) continue; // Skip header row
                if ($counter >= $maxRows) {
                    dump("✅ Stopping after processing {$maxRows} rows.");
                    break;
                }
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
                    $jumlahKelas = (int) ($row['L'] ?? 0); // New column
                    $jumlahLab = (int) ($row['M'] ?? 0); // New column
                    $jumlahPerpustakaan = (int) ($row['N'] ?? 0); // New column
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

                    // Update SekolahTahun with new fields
                    SekolahTahun::updateOrCreate(
                        ['sekolah_id' => $sekolah->id, 'tahun_id' => $tahun->id],
                        [
                            'jml_peserta_didik'  => $jumlahPesertaDidik,
                            'jml_guru'           => $jumlahGuru,
                            'jml_pegawai'        => $jumlahPegawai,
                            'jml_rombel'         => $jumlahRombel,
                            'jml_kelas'          => $jumlahKelas,  // Added
                            'jml_lab'            => $jumlahLab,  // Added
                            'jml_perpustakaan'   => $jumlahPerpustakaan,  // Added
                        ]
                    );
                    $counter++;
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
