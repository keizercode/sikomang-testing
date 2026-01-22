

@extends('layouts.app')


@section('title', 'Pemanfaatan Mangrove - SIKOMANG')

@section('content')
<div class="mangrove-container">
    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Pemanfaatan Mangrove</h2>
        </div>

        <div class="stats-section">
            <h3>Total Pemanfaatan Kawasan Mangrove</h3>
            <div class="stat-number primary">23</div>
            <div class="stat-label">Pemanfaatan Aktif (ha)</div>
            <div class="stat-number secondary">297</div>
        </div>

        <div class="info-section">
            <div class="info-header">
                <h3>Rekamandasi Pemanfaatan</h3>
                <i class="info-icon">ⓘ</i>
            </div>

            <div class="recommendation-tags">
                <span class="tag tag-green">Dilindungi: 6</span>
                <span class="tag tag-yellow">Pengkayaan: 11</span>
                <span class="tag tag-orange">Pengkayaan / Rehabilitasi: 1</span>
                <span class="tag tag-red">Rehabilitasi: 3</span>
            </div>
        </div>

        <div class="geography-section">
            <h3>Sebaran Geografis</h3>
            <ul class="location-list">
                <li>
                    <span class="location-name">Tangerang</span>
                    <span class="location-count">11 Desa</span>
                </li>
                <li>
                    <span class="location-name">Kec. Sepatan Timur</span>
                    <span class="location-count">1 Desa</span>
                </li>
                <li>
                    <span class="location-name">Kecamatan Sepulu Ulung</span>
                    <span class="location-count">5 Desa</span>
                </li>
                <li>
                    <span class="location-name">Kecamatan Sentry Uctharn</span>
                    <span class="location-count">1 Desa</span>
                </li>
            </ul>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="main-content">
        {{-- Search Bar --}}
    {{-- Search + Map Button --}}
<div class="flex items-center gap-4 mb-6">
    <!-- Search -->
    <div class="search-bar flex-1 max-w-[500px]">
        <input type="text" placeholder="Cari lokasi mangrove">
        <button class="btn-search">🔍</button>
    </div>

    <!-- Spacer -->
    <div class="ml-auto">
        <!-- Map Button -->
        <button
            class="flex items-center justify-center
                   w-[48px] h-[48px]
                   rounded-[12px]
                   border border-[#E0E4EE]
                   bg-white"
        >
            <svg
                class="w-5 h-5"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >


                    <path
                        d="M8.714 14H5.004
                           C4.79433 14.0001 4.58999 14.0661 4.41987 14.1886
                           C4.24976 14.3112 4.12247 14.4841 4.056 14.683
                           L2.052 20.683
                           C2.00176 20.8333 1.98797 20.9934 2.01175 21.1501
                           C2.03554 21.3068 2.09623 21.4556 2.18882 21.5842
                           C2.28141 21.7128 2.40324 21.8176 2.54428 21.8899
                           C2.68532 21.9622 2.84152 21.9999 3 22H21
                           C21.1584 21.9999 21.3144 21.9621 21.4554 21.8899
                           C21.5963 21.8177 21.7181 21.713 21.8106 21.5845
                           C21.9032 21.456 21.9639 21.3074 21.9878 21.1508
                           C22.0117 20.9942 21.998 20.8343 21.948 20.684
                           L19.948 14.684
                           C19.8817 14.4848 19.7543 14.3115 19.584 14.1888
                           C19.4136 14.066 19.209 13.9999 18.999 14H15.287
                           M18 8
                           C18 11.613 14.131 15.429 12.607 16.795
                           C12.4327 16.9282 12.2194 17.0003 12 17.0003
                           C11.7806 17.0003 11.5673 16.9282 11.393 16.795
                           C9.87 15.429 6 11.613 6 8
                           C6 6.4087 6.63214 4.88258 7.75736 3.75736
                           C8.88258 2.63214 10.4087 2 12 2
                           C13.5913 2 15.1174 2.63214 16.2426 3.75736
                           C17.3679 4.88258 18 6.4087 18 8
                           M14 8
                           C14 9.10457 13.1046 10 12 10
                           C10.8954 10 10 9.10457 10 8
                           C10 6.89543 10.8954 6 12 6
                           C13.1046 6 14 6.89543 14 8Z"
                    />
                </svg>
        </button>
         </div>
    </div>



        {{-- Filter Tabs --}}
        <div class="filter-tabs">
            <button class="tab active">Semua</button>
            <button class="tab">Penjaringan, Jakarta Utara</button>
            <button class="tab">Cilincing, Jakarta Utara</button>
            <button class="tab">Kep. Seribu Utara</button>
            <button class="tab">Kep. Seribu Selatan</button>
        </div>

        {{-- Cards Grid --}}
        <div class="cards-grid">

            @php
             $hideNavbarMenu = true;
            $locations = [
                ['name' => 'Rawa Hutan Lindung', 'type' => 'Dilindungi', 'year' => '2020', 'area' => '44.7 ha', 'condition' => 'Sedang', 'coords' => '6.12, 106.76', 'desc' => 'Anacardio ada, Anacamia mamp...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1755389322/rhl2_htfyvf.jpg'],
                ['name' => 'Tanah Timbul (Bird Feeding)', 'type' => 'Pengkayaan', 'year' => '2021', 'area' => '2.83 ha', 'condition' => 'Jerang', 'coords' => '6.12, 106.76', 'desc' => 'Anacamia mamp, Aligue Rishcara...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758002227/2-tanah_timbul-1_couywb.jpg'],
                ['name' => 'Pos 2 Hutan Lindung', 'type' => 'Pengkayaan', 'year' => '2020', 'area' => 'N/A', 'condition' => 'Sedang', 'coords' => '6.12, 106.76', 'desc' => 'Aliquip, Brisubido...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758003912/3-pos_2_hutan_lindung-3_hk6fqt.jpg'],
                ['name' => 'Pos 5 Hutan Lindung', 'type' => 'Dilindungi', 'year' => '2020', 'area' => '4.7 ha', 'condition' => 'Lebat', 'coords' => '6.12, 106.76', 'desc' => 'Acaratilia da, Ecordania agalona...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758005191/4-pos5_hl-3_gezsmd.jpg'],
                ['name' => 'Titik 2 Elang Laut', 'type' => 'Dilindungi', 'year' => '2021', 'area' => 'N/A', 'condition' => 'Lebat', 'coords' => '6.12, 106.76', 'desc' => 'Ricampria mucormata, Sonneratia caseolans...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758023885/5-elang_laut-3_xcqyxo.jpg'],
                ['name' => 'TWA Angke Kapuk', 'type' => 'Pengkayaan', 'year' => '2021', 'area' => '99.82 ha', 'condition' => 'Sedang', 'coords' => '6.12, 106.76', 'desc' => 'Anacamio ada, Anacama mamp...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758027332/6-twa_angke-1_zobavq.jpg'],
                ['name' => 'Rusun TNI AL', 'type' => 'Pengkayaan', 'year' => '2025', 'area' => '6 ha', 'condition' => 'Jerang', 'coords' => '6.12, 106.91', 'desc' => 'Anacamio ada, Rhizophora mucormata...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758068635/7-rusun_tni_al-1_gx1iqa.jpg'],
                ['name' => 'Mangrove STIP', 'type' => 'Pengkayaan', 'year' => '2021', 'area' => '4.6 ha', 'condition' => 'Jerang', 'coords' => '6.12, 106.95', 'desc' => 'Anacamio ada, Anacama mamp...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758072894/8-stip-2_lmj2wl.jpg'],
                ['name' => 'Mangrove Si Pitung', 'type' => 'Pengkayaan', 'year' => '2021', 'area' => '5.5 ha', 'condition' => 'Jerang', 'coords' => '6.12, 106.86', 'desc' => 'Anacamia mamp, Rhizophora mucormata...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758075414/9-si_pitung-3_puez20.jpg'],
                ['name' => 'Pasmar 1 TNI AL', 'type' => 'Dilindungi', 'year' => '2021', 'area' => '5.5 ha', 'condition' => 'Jerang', 'coords' => '6.12, 106.86', 'desc' => 'Anacamia mamp, Rhizophora mucormata...', 'status' => 'Tidak sedian berfectifikat', 'image' => 'https://res.cloudinary.com/dgctlfa2t/image/upload/v1758079131/10-pasmar_cq9f1q.jpg'],
            ];
            @endphp

            @foreach($locations as $location)
            <div class="card">
                <div class="card-image">
                    <img src="{{ $location['image'] }}" alt="{{ $location['name'] }}" loading="lazy">
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ $location['name'] }}</h3>
                    <div class="card-badges">
                        <span class="badge badge-{{ strtolower($location['type']) }}">{{ $location['type'] }}</span>
                        <span class="badge badge-year">{{ $location['year'] }}</span>
                    </div>
                    <div class="card-info">
                        <div class="info-row">
                            <span class="icon">📍</span>
                            <span class="text">{{ $location['coords'] }}</span>
                        </div>
                        <div class="info-row details">
                            <div class="detail-item">
                                <span class="label">Luas Area</span>
                                <span class="value">{{ $location['area'] }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Kerapatan</span>
                                <span class="value">{{ $location['condition'] }}</span>
                            </div>
                        </div>
                        <p class="description">{{ $location['desc'] }}</p>
                        <div class="status">
                            <span class="status-icon">📄</span>
                            <span class="status-text">{{ $location['status'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Repeat cards as shown in the design --}}
            @for($i = 0; $i < 5; $i++)
                @foreach(array_slice($locations, 6, 3) as $location)
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('images/mangrove/' . $location['image']) }}" alt="{{ $location['name'] }}" loading="lazy">
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">{{ $location['name'] }}</h3>
                        <div class="card-badges">
                            <span class="badge badge-{{ strtolower($location['type']) }}">{{ $location['type'] }}</span>
                            <span class="badge badge-year">{{ $location['year'] }}</span>
                        </div>
                        <div class="card-info">
                            <div class="info-row">
                                <span class="icon">📍</span>
                                <span class="text">{{ $location['coords'] }}</span>
                            </div>
                            <div class="info-row details">
                                <div class="detail-item">
                                    <span class="label">Luas Area</span>
                                    <span class="value">{{ $location['area'] }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="label">Kerapatan</span>
                                    <span class="value">{{ $location['condition'] }}</span>
                                </div>
                            </div>
                            <p class="description">{{ $location['desc'] }}</p>
                            <div class="status">
                                <span class="status-icon">📄</span>
                                <span class="status-text">{{ $location['status'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endfor
        </div>
    </main>
</div>

<style>
/* ===== CSS Variables ===== */
:root {
    --primary-color: #00a67e;
    --secondary-color: #e8f5f1;
    --text-dark: #2d3748;
    --text-light: #718096;
    --border-color: #e2e8f0;
    --bg-white: #ffffff;
    --bg-gray: #f7fafc;
    --yellow: #fbbf24;
    --orange: #fb923c;
    --red: #ef4444;
    --green: #10b981;
}

/* ===== Reset & Base Styles ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    color: var(--text-dark);
    background-color: var(--bg-gray);
    line-height: 1.6;
}

/* ===== Main Container ===== */
.mangrove-container {
    display: grid;
    grid-template-columns: 280px 1fr;
    min-height: 100vh;
    gap: 0;
}

/* ===== Sidebar ===== */
.sidebar {
    background-color: var(--bg-white);
    padding: 1.5rem;
    border-right: 1px solid var(--border-color);
    overflow-y: auto;
}

.sidebar-header h2 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
}

.stats-section {
    margin-bottom: 2rem;
}

.stats-section h3 {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-light);
    margin-bottom: 0.75rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stat-number.primary {
    color: var(--primary-color);
}

.stat-number.secondary {
    color: var(--text-dark);
    font-size: 2rem;
    margin-top: 0.5rem;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-light);
    margin-bottom: 0.75rem;
}

.info-section {
    margin-bottom: 2rem;
}

.info-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.info-header h3 {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-dark);
}

.info-icon {
    color: var(--text-light);
    cursor: help;
}

.recommendation-tags {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.tag {
    display: inline-block;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-size: 0.813rem;
    font-weight: 500;
}

.tag-green {
    background-color: #d1fae5;
    color: #065f46;
}

.tag-yellow {
    background-color: #fef3c7;
    color: #92400e;
}

.tag-orange {
    background-color: #fed7aa;
    color: #9a3412;
}

.tag-red {
    background-color: #fee2e2;
    color: #991b1b;
}

.geography-section h3 {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.location-list {
    list-style: none;
}

.location-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.625rem 0;
    border-bottom: 1px solid var(--border-color);
    font-size: 0.875rem;
}

.location-name {
    color: var(--text-dark);
}

.location-count {
    color: var(--text-light);
    font-size: 0.813rem;
}

/* ===== Main Content ===== */
.main-content {
    padding: 1.5rem;
    background-color: var(--bg-gray);
}

/* ===== Search Bar ===== */
.search-bar {
    display: flex;
    margin-bottom: 1.5rem;
    max-width: 500px;
}

.search-bar input {
    flex: 1;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px 0 0 8px;
    font-size: 0.875rem;
    outline: none;
}

.search-bar input:focus {
    border-color: var(--primary-color);
}

.btn-search {
    padding: 0.75rem 1.25rem;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 0 8px 8px 0;
    cursor: pointer;
    transition: background-color 0.2s;
}

.btn-search:hover {
    background-color: #008c6a;
}

/* ===== Filter Tabs ===== */
.filter-tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.tab {
    padding: 0.625rem 1.25rem;
    background-color: var(--bg-white);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}

.tab:hover {
    background-color: var(--secondary-color);
}

.tab.active {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

/* ===== Action Buttons ===== */
.action-buttons {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    justify-content: flex-end;
}

.btn {
    padding: 0.625rem 1.25rem;
    border: none;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary {
    background-color: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background-color: #008c6a;
}

.btn-success {
    background-color: #10b981;
    color: white;
}

.btn-success:hover {
    background-color: #059669;
}

/* ===== Cards Grid ===== */
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.25rem;
}

.card {
    background-color: var(--bg-white);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.card-image {
    width: 100%;
    height: 160px;
    overflow: hidden;
    background-color: var(--bg-gray);
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-content {
    padding: 1rem;
}

.card-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
}

.card-badges {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.badge {
    padding: 0.25rem 0.625rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
}

.badge-dilindungi {
    background-color: #d1fae5;
    color: #065f46;
}

.badge-pengkayaan {
    background-color: #fef3c7;
    color: #92400e;
}

.badge-year {
    background-color: var(--bg-gray);
    color: var(--text-light);
}

.card-info {
    font-size: 0.813rem;
}

.info-row {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    color: var(--text-light);
}

.info-row .icon {
    font-size: 1rem;
}

.info-row.details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    padding: 0.75rem;
    background-color: var(--bg-gray);
    border-radius: 6px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.detail-item .label {
    font-size: 0.75rem;
    color: var(--text-light);
}

.detail-item .value {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-dark);
}

.description {
    color: var(--text-light);
    font-size: 0.813rem;
    margin-bottom: 0.75rem;
    line-height: 1.5;
}

.status {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #dc2626;
    font-size: 0.75rem;
}

.status-icon {
    font-size: 0.875rem;
}

/* ===== Responsive Design ===== */
@media (max-width: 1200px) {
    .cards-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
}

@media (max-width: 992px) {
    .mangrove-container {
        grid-template-columns: 1fr;
    }

    .sidebar {
        border-right: none;
        border-bottom: 1px solid var(--border-color);
    }

    .cards-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
}

@media (max-width: 768px) {
    .filter-tabs {
        overflow-x: auto;
        flex-wrap: nowrap;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }

    .filter-tabs::-webkit-scrollbar {
        display: none;
    }

    .cards-grid {
        grid-template-columns: 1fr;
    }

    .action-buttons {
        justify-content: flex-start;
    }
}

@media (max-width: 576px) {
    .main-content {
        padding: 1rem;
    }

    .sidebar {
        padding: 1rem;
    }

    .search-bar {
        max-width: 100%;
    }

    .stat-number {
        font-size: 2rem;
    }

    .stat-number.secondary {
        font-size: 1.75rem;
    }
}
</style>

<script>
// Optional: Add interactivity if needed
document.addEventListener('DOMContentLoaded', function() {
    // Filter tabs functionality
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            // Add filter logic here
        });
    });

    // Search functionality
    const searchInput = document.querySelector('.search-bar input');
    const searchBtn = document.querySelector('.btn-search');

    searchBtn.addEventListener('click', function() {
        const searchTerm = searchInput.value.toLowerCase();
        // Add search logic here
        console.log('Searching for:', searchTerm);
    });

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchBtn.click();
        }
    });
});
</script>
@endsection

