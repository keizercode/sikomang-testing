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
            [
                'slug' => 'rawa-hutan-lindung',
                'name' => 'Rawa Hutan Lindung',
                'type' => 'Pengkayaan',
                'year' => '2025',
                'area' => '44.7 ha',
                'density' => 'Sedang',
                'health' => '98% Sehat',
                'health_score' => 'NAK: 7.2',
                'coords' => '-6.1023, 106.7655',
                'location' => 'Kecamatan Penjaringan, Jakarta Utara',
                'manager' => 'DPHK',
                'species' => 'Avicennia alba, Avicennia marina...',
                'damage_count' => 2,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Kawasan hutan mangrove lindung yang memiliki kerapatan sedang dengan tingkat kesehatan yang baik.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1755389322/rhl2_htfyvf.jpg',
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758002227/2-tanah_timbul-1_couywb.jpg',
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758003912/3-pos_2_hutan_lindung-3_hk6fqt.jpg'
                ]
            ],
            [
                'slug' => 'tanah-timbul-bird-feeding',
                'name' => 'Tanah Timbul (Bird Feeding)',
                'type' => 'Rehabilitasi',
                'year' => '2025',
                'area' => '2.89 ha',
                'density' => 'Jarang',
                'health' => '75% Sehat',
                'health_score' => 'NAK: 5.8',
                'coords' => '-6.10, 106.76',
                'location' => 'Kecamatan Penjaringan, Jakarta Utara',
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
                'coords' => '-6.10, 106.76',
                'location' => 'Kecamatan Penjaringan, Jakarta Utara',
                'manager' => 'DPHK',
                'species' => 'Api-api, Buta-buta...',
                'damage_count' => 4,
                'carbon_data' => 'Data tidak tersedia',
                'certificate_status' => 'Tidak tersedia sertifikat',
                'description' => 'Pos pemantauan 2 di kawasan hutan lindung dengan program pengkayaan jenis.',
                'images' => [
                    'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758003912/3-pos_2_hutan_lindung-3_hk6fqt.jpg'
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
