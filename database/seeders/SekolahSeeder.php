<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use App\Models\RuanganTahun;
use App\Models\SekolahTahun;
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
                    $tahun = (int) ($row['O'] ?? 0);
                    $namaKecamatan = trim($row['P'] ?? '');

                    if (empty($namaKecamatan)) {
                        dump("⚠️ Skipping row {$index}: Kecamatan is empty");
                        continue;
                    }

                    $kecamatan = Kecamatan::firstOrCreate(
                        ['NamaKecamatan' => ucfirst(strtolower($namaKecamatan))],
                        ['created_at' => now(), 'updated_at' => now()]
                    );

                    if (!$kecamatan || !$kecamatan->KecamatanID) {
                        dump("⚠️ Skipping row {$index}: Failed to create/find Kecamatan '{$namaKecamatan}'");
                        continue;
                    }

                    $lastSync = null;
                    if (!empty($lastSyncRaw)) {
                        try {
                            $lastSync = Carbon::createFromFormat('d M Y H:i:s', $lastSyncRaw)->format('Y-m-d H:i:s');
                        } catch (\Exception $e) {
                            $lastSync = now();
                        }
                    }

                    $sekolah = Sekolah::firstOrCreate(
                        ['NPSN' => $npsn],
                        [
                            'NamaSekolah'        => $namaSekolah,
                            'BentukPendidikan'   => $bentukPendidikan,
                            'Status'             => $status,
                            'LastSync'           => $lastSync,
                            'JmlSync'            => $jmlSync,
                            'KecamatanID'        => $kecamatan->KecamatanID,
                        ]
                    );

                    if (!$sekolah || !$sekolah->SekolahID) {
                        dump("⚠️ Skipping row {$index}: Failed to create Sekolah '{$namaSekolah}' (NPSN: {$npsn})");
                        continue;
                    }

                    $sekolahTahun = SekolahTahun::firstOrCreate(
                        ['SekolahID' => $sekolah->SekolahID, 'Tahun' => $tahun],
                        [
                            'JumlahPesertaDidik' => $jumlahPesertaDidik,
                            'JumlahGuru'         => $jumlahGuru,
                            'JumlahPegawai'      => $jumlahPegawai,
                            'JumlahRombel'       => $jumlahRombel,
                        ]
                    );

                    $ruanganTypes = [
                        'L' => ['jenis' => 'Kelas'],
                        'M' => ['jenis' => 'Lab'],
                        'N' => ['jenis' => 'Perpustakaan']
                    ];

                    foreach ($ruanganTypes as $column => $data) {
                        $jumlah = (int) ($row[$column] ?? 0);
                        if ($jumlah > 0) {
                            RuanganTahun::create([
                                'SekolahTahunID' => $sekolahTahun->SekolahTahunID,
                                'JenisRuangan'    => $data['jenis'],
                                'Jumlah'         => $jumlah,
                            ]);
                        }
                    }
                } catch (\Exception $e) {
                    dump("❌ Error in row {$index}: {$e->getMessage()}");
                    $hasError = true; // Set error flag
                    continue;
                }
            }
        } catch (\Exception $e) {
            dump("❌ Seeder failed: " . $e->getMessage());
            $hasError = true; // Set error flag
        } finally {
            if (!$hasError) {
                dump("✅ Seeding completed successfully!");
            } else {
                dump("⚠️ Seeding completed with errors.");
            }
        }
    }
}
