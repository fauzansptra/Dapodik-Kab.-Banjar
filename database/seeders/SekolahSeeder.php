<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use App\Models\Ruangan;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SekolahSeeder extends Seeder
{
    public function run()
    {
        try {
            // Load Excel file from storage
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

                // ✅ Trim and clean values
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
                $semester = trim($row['O'] ?? '');
                $namaKecamatan = trim($row['P'] ?? '');

                // ✅ Handle missing Kecamatan
                if (empty($namaKecamatan)) {
                    dump("⚠️ Skipping row {$index}: Kecamatan is empty");
                    continue;
                }

                // ✅ Find or create Kecamatan
                $kecamatan = Kecamatan::firstOrCreate(
                    ['NamaKecamatan' => ucfirst(strtolower($namaKecamatan))],
                    ['created_at' => now(), 'updated_at' => now()]
                );

                if (!$kecamatan || !$kecamatan->KecamatanID) {
                    dump("⚠️ Skipping row {$index}: Failed to create/find Kecamatan '{$namaKecamatan}'");
                    continue;
                }

                // ✅ Convert LastSync to proper format
                $lastSync = null;
                if (!empty($lastSyncRaw)) {
                    try {
                        $lastSync = Carbon::createFromFormat('d M Y H:i:s', $lastSyncRaw)->format('Y-m-d H:i:s');
                    } catch (\Exception $e) {
                        $lastSync = now(); // Default to current timestamp if parsing fails
                    }
                }

                try {
                    // ✅ Find or create Sekolah
                    $sekolah = Sekolah::firstOrCreate(
                        ['NPSN' => $npsn], // Search by unique column
                        [
                            'NamaSekolah'        => $namaSekolah,
                            'BentukPendidikan'   => $bentukPendidikan,
                            'Status'             => $status,
                            'LastSync'           => $lastSync,
                            'JmlSync'            => $jmlSync,
                            'JumlahPesertaDidik' => $jumlahPesertaDidik,
                            'JumlahRombel'       => $jumlahRombel,
                            'JumlahGuru'         => $jumlahGuru,
                            'JumlahPegawai'      => $jumlahPegawai,
                            'Semester'           => $semester,
                            'KecamatanID'        => $kecamatan->KecamatanID,
                        ]
                    );

                    if (!$sekolah || !$sekolah->SekolahID) {
                        dump("⚠️ Skipping row {$index}: Failed to create Sekolah '{$namaSekolah}' (NPSN: {$npsn})");
                        continue;
                    }

                    dump("✅ Inserted/Retrieved Sekolah: {$sekolah->NamaSekolah} (ID: {$sekolah->id})");

                    // ✅ Insert into Ruangan table
                    $ruanganTypes = [
                        'L' => ['jenis' => 'Kelas'],
                        'M' => ['jenis' => 'Lab'],
                        'N' => ['jenis' => 'Perpustakaan']
                    ];

                    foreach ($ruanganTypes as $column => $data) {
                        $jumlah = (int) ($row[$column] ?? 0);
                        if ($jumlah > 0) {
                            Ruangan::create([
                                'SekolahID' => $sekolah->SekolahID,
                                'Jenis'     => $data['jenis'],
                                'Jumlah'    => $jumlah,
                            ]);
                        }
                    }
                } catch (\Exception $e) {
                    dump("❌ Error in row {$index}: {$e->getMessage()}");
                    continue;
                }
            }
        } catch (\Exception $e) {
            dump("❌ Seeder failed: " . $e->getMessage());
        }
    }
}
