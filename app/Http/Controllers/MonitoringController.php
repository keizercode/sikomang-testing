<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Menampilkan halaman profil sebaran mangrove
     */
    public function index()
    {
        $data = [
            'title' => 'Profil Sebaran Mangrove DKI Jakarta 2025',
            'total_sites' => 23,
            'total_area' => 297,
            'monitoring_data' => $this->getMonitoringData()
        ];

        return view('pages.monitoring', $data);
    }

    /**
     * Menampilkan hasil pemantauan dengan detail lokasi
     */
    public function hasilPemantauan()
    {
        $locations = $this->getLocations();

        return view('pages.hasil-pemantauan', compact('locations'));
    }

    /**
     * Menampilkan detail lokasi pemantauan
     */
    public function detailLokasi($slug)
    {
        $location = $this->getLocationBySlug($slug);

        if (!$location) {
            abort(404, 'Lokasi tidak ditemukan');
        }

        return view('pages.detail-lokasi', compact('location'));
    }

    /**
     * Get monitoring data untuk tabel
     */
    private function getMonitoringData()
    {
        return [
            'luar_kawasan' => [
                [
                    'fungsi' => 'APL (Areal Penggunaan Lain)',
                    'jarang' => 36.54,
                    'sedang' => 56.38,
                    'lebat' => 171.28,
                    'total' => 264.21,
                    'status' => 'Bukan Kawasan Konservasi'
                ]
            ],
            'dalam_kawasan' => [
                [
                    'fungsi' => 'HL (Hutan Lindung)',
                    'jarang' => 3.03,
                    'sedang' => 39.06,
                    'lebat' => 19.59,
                    'total' => 61.67,
                    'status' => 'Kawasan Konservasi'
                ],
                [
                    'fungsi' => 'HP (Hutan Produksi)',
                    'jarang' => 2.20,
                    'sedang' => 6.53,
                    'lebat' => 71.84,
                    'total' => 80.57,
                    'status' => 'Bukan Kawasan Konservasi'
                ],
                [
                    'fungsi' => 'TN (Taman Nasional)',
                    'jarang' => 29.72,
                    'sedang' => 5.01,
                    'lebat' => 21.65,
                    'total' => 56.39,
                    'status' => 'Kawasan Konservasi'
                ],
                [
                    'fungsi' => 'SM (Suaka Margasatwa)',
                    'jarang' => 8.31,
                    'sedang' => 11.96,
                    'lebat' => 26.83,
                    'total' => 47.10,
                    'status' => 'Kawasan Konservasi'
                ],
                [
                    'fungsi' => 'TWA (Taman Wisata Alam)',
                    'jarang' => 2.01,
                    'sedang' => 94.49,
                    'lebat' => 1.79,
                    'total' => 98.28,
                    'status' => 'Kawasan Konservasi'
                ]
            ]
        ];
    }

    /**
     * Get all locations
     */
    private function getLocations()
    {
        return [
            // Kategori Jarang - Penjaringan
            [
                'slug' => 'rawa-hutan-lindung',
                'name' => 'Rawa Hutan Lindung',
                'type' => 'Pengkayaan',
                'year' => '2025',
                'area' => '44.7 ha',
                'density' => 'Jarang',
                'health' => '98% Sehat',
                'health_score' => 'NAK: 7.2',
                'coords' => '-6.1023, 106.7655',
                'location' => 'Kecamatan Penjaringan, Jakarta Utara, Rawa Hutan Lindung',
                'group' => 'penjaringan',
                'manager' => 'DPHK',
                'species' => 'Avicennia alba, Avicennia marina...',
                'damage_count' => 2,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Kawasan hutan mangrove lindung yang memiliki kerapatan jarang dengan tingkat kesehatan yang baik.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1755389322/rhl2_htfyvf.jpg',
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758002227/2-tanah_timbul-1_couywb.jpg',
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758003912/3-pos_2_hutan_lindung-3_hk6fqt.jpg'
                ],
                'damages' => [
                    'Dahan patah dan pohon tumbang akibat angin kencang',
                    'Sampah dari laut'
                ],
                'actions' => [
                    'Pembersihan area terdampak yang menghalangi akses',
                    'Pagar jaring dekat pesisir'
                ],
                'species_detail' => [
                    'vegetasi' => [
                        'Avicennia alba',
                        'Avicennia marina',
                        'Excoecaria agallocha',
                        'Nypa fruticans',
                        'Rhizophora apiculata',
                        'Rhizophora mucronata'
                    ],
                    'fauna' => [
                        'Ular Tambang',
                        'Tupai',
                        'Biawak',
                        'Monyet ekor panjang',
                        'Ikan',
                        '16 Jenis Burung'
                    ]
                ],
                'activities' => [
                    'description' => 'Titik pengamatan berada di rawa dekat muara Kali Adem. Aktivitas di sekitarnya terbatas oleh:',
                    'items' => [
                        'Nelayan, Petani tambak',
                        'Petugas kawasan'
                    ]
                ],
                'forest_utilization' => [
                    'Hutan Lindung',
                    'Hutan Konservasi',
                    'Habitat flora & fauna',
                    'Pelindung pesisir',
                    'Ekowisata'
                ],
                'programs' => [
                    'Pembibitan/persemaian',
                    'Grebek sampah (pembersihan)',
                    'Penanaman mangrove',
                    'Penyediaan lahan'
                ],
                'stakeholders' => [
                    'PLN PJB',
                    'Universitas Trisakti',
                    'Yamaha',
                    'Bank DKI',
                    'AEON',
                    'Mitsubishi Motor'
                ]
            ],
            [
                'slug' => 'pos-5-hutan-lindung',
                'name' => 'Pos 5 Hutan Lindung',
                'type' => 'Dilindungi',
                'year' => '2025',
                'area' => '4.7 ha',
                'density' => 'Jarang',
                'health' => '92% Sehat',
                'health_score' => 'NAK: 6.8',
                'coords' => '-6.0895, 106.7820',
                'location' => 'Kecamatan Penjaringan, Jakarta Utara, Pos 5 Hutan Lindung',
                'group' => 'penjaringan',
                'manager' => 'DPHK',
                'species' => 'Sonneratia caseolaris, Avicennia alba...',
                'damage_count' => 1,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Pos pemantauan 5 di kawasan hutan lindung dengan status dilindungi.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758005191/4-pos5_hl-3_gezsmd.jpg'
                ]
            ],

            // Kategori Jarang - Cilincing
            [
                'slug' => 'rusun-tni-al',
                'name' => 'Rusun TNI AL',
                'type' => 'Pengkayaan',
                'year' => '2025',
                'area' => '6 ha',
                'density' => 'Jarang',
                'health' => '80% Sehat',
                'health_score' => 'NAK: 6.2',
                'coords' => '-6.0912, 106.9105',
                'location' => 'Kecamatan Cilincing, Jakarta Utara, Rusun TNI AL',
                'group' => 'cilincing',
                'manager' => 'DPHK',
                'species' => 'Avicennia alba, Rhizophora mucronata...',
                'damage_count' => 3,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Kawasan mangrove di sekitar Rusun TNI AL dengan program pengkayaan.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758068635/7-rusun_tni_al-1_gx1iqa.jpg'
                ]
            ],

            // Kategori Sedang - Penjaringan
            [
                'slug' => 'tanah-timbul-bird-feeding',
                'name' => 'Tanah Timbul (Bird Feeding)',
                'type' => 'Rehabilitasi',
                'year' => '2025',
                'area' => '2.89 ha',
                'density' => 'Sedang',
                'health' => '75% Sehat',
                'health_score' => 'NAK: 5.8',
                'coords' => '-6.1012, 106.7645',
                'location' => 'Kecamatan Penjaringan, Jakarta Utara, Tanah Timbul',
                'group' => 'penjaringan',
                'manager' => 'DPHK',
                'species' => 'Avicennia marina, Nypa fruticans...',
                'damage_count' => 3,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Area tanah timbul yang difungsikan sebagai tempat feeding burung dengan program rehabilitasi mangrove.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758002227/2-tanah_timbul-1_couywb.jpg',
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1755389322/rhl2_htfyvf.jpg'
                ]
            ],
            [
                'slug' => 'pos-2-hutan-lindung',
                'name' => 'Pos 2 Hutan Lindung',
                'type' => 'Pengkayaan',
                'year' => '2025',
                'area' => 'N/A',
                'density' => 'Sedang',
                'health' => '85% Sehat',
                'health_score' => 'NAK: 6.5',
                'coords' => '-6.1025, 106.7680',
                'location' => 'Kecamatan Penjaringan, Jakarta Utara, Pos 2 Hutan Lindung',
                'group' => 'penjaringan',
                'manager' => 'DPHK',
                'species' => 'Api-api, Buta-buta...',
                'damage_count' => 4,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Pos pemantauan 2 di kawasan hutan lindung dengan program pengkayaan jenis.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758003912/3-pos_2_hutan_lindung-3_hk6fqt.jpg'
                ]
            ],
            [
                'slug' => 'twa-angke-kapuk',
                'name' => 'TWA Angke Kapuk',
                'type' => 'Pengkayaan',
                'year' => '2025',
                'area' => '99.82 ha',
                'density' => 'Sedang',
                'health' => '88% Sehat',
                'health_score' => 'NAK: 7.0',
                'coords' => '-6.0921, 106.7590',
                'location' => 'Kecamatan Penjaringan, Jakarta Utara, TWA Angke Kapuk',
                'group' => 'penjaringan',
                'manager' => 'DPHK',
                'species' => 'Avicennia alba, Avicennia marina...',
                'damage_count' => 2,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Taman Wisata Alam Angke Kapuk dengan kerapatan sedang dan program pengkayaan.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758027332/6-twa_angke-1_zobavq.jpg'
                ]
            ],

            // Kategori Lebat - Penjaringan
            [
                'slug' => 'titik-2-elang-laut',
                'name' => 'Titik 2 Elang Laut',
                'type' => 'Dilindungi',
                'year' => '2025',
                'area' => 'N/A',
                'density' => 'Lebat',
                'health' => '95% Sehat',
                'health_score' => 'NAK: 8.1',
                'coords' => '-6.1015, 106.7670',
                'location' => 'Kecamatan Penjaringan, Jakarta Utara, Elang Laut',
                'group' => 'penjaringan',
                'manager' => 'DPHK',
                'species' => 'Rhizophora mucronata',
                'damage_count' => 3,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Kawasan dengan kerapatan lebat yang menjadi habitat elang laut.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758023885/5-elang_laut-3_xcqyxo.jpg'
                ]
            ],

            // Kategori Lebat - Cilincing
            [
                'slug' => 'mangrove-stip',
                'name' => 'Mangrove STIP',
                'type' => 'Pengkayaan',
                'year' => '2025',
                'area' => '4.6 ha',
                'density' => 'Lebat',
                'health' => '90% Sehat',
                'health_score' => 'NAK: 7.5',
                'coords' => '-6.1223, 106.9512',
                'location' => 'Kecamatan Cilincing, Jakarta Utara, STIP',
                'group' => 'cilincing',
                'manager' => 'DPHK',
                'species' => 'Avicennia alba, Avicennia marina...',
                'damage_count' => 2,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Kawasan mangrove di area STIP dengan kerapatan lebat.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758072894/8-stip-2_lmj2wl.jpg'
                ]
            ],
            [
                'slug' => 'mangrove-si-pitung',
                'name' => 'Mangrove Si Pitung',
                'type' => 'Pengkayaan',
                'year' => '2025',
                'area' => '5.5 ha',
                'density' => 'Lebat',
                'health' => '87% Sehat',
                'health_score' => 'NAK: 7.3',
                'coords' => '-6.1198, 106.8645',
                'location' => 'Kecamatan Cilincing, Jakarta Utara, Si Pitung',
                'group' => 'cilincing',
                'manager' => 'DPHK',
                'species' => 'Avicennia marina, Rhizophora mucronata...',
                'damage_count' => 4,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Kawasan mangrove Si Pitung dengan kerapatan lebat dan program pengkayaan.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758075414/9-si_pitung-3_puez20.jpg'
                ]
            ],
            [
                'slug' => 'pasmar-1-tni-al',
                'name' => 'Pasmar 1 TNI AL',
                'type' => 'Dilindungi',
                'year' => '2025',
                'area' => '5.5 ha',
                'density' => 'Lebat',
                'health' => '93% Sehat',
                'health_score' => 'NAK: 7.8',
                'coords' => '-6.1156, 106.8598',
                'location' => 'Kecamatan Cilincing, Jakarta Utara, Pasmar 1',
                'group' => 'cilincing',
                'manager' => 'DPHK',
                'species' => 'Avicennia marina, Rhizophora mucronata...',
                'damage_count' => 1,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Kawasan mangrove di area Pasmar 1 TNI AL dengan status dilindungi.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758079131/10-pasmar_cq9f1q.jpg'
                ]
            ]
        ];
    }

    /**
     * Get location by slug
     */
    private function getLocationBySlug($slug)
    {
        $locations = $this->getLocations();

        foreach ($locations as $location) {
            if ($location['slug'] === $slug) {
                return $location;
            }
        }

        return null;
    }
}
