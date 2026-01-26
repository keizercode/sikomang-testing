@extends('layouts.app')

@section('title', 'Pemanfaatan Mangrove - SIKOMANG')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

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
                <div class="info-icon-wrapper">
                    <img
                        src="https://res.cloudinary.com/dmcvht1vr/image/upload/v1769407250/aec8dafa-beba-46ec-979c-fb12d5f5af5a.png"
                        alt="Info"
                        class="info-icon-img"
                        onclick="toggleMatrix()"
                    >
                </div>
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
                    <span class="location-name">Kecamatan Penjaringan</span>
                    <span class="location-count">11 Sites</span>
                </li>
                <li>
                    <span class="location-name">Kecamatan Cilincing</span>
                    <span class="location-count">5 Sites</span>
                </li>
                <li>
                    <span class="location-name">Kepulauan Seribu Utara</span>
                    <span class="location-count">3 Sites</span>
                </li>
                <li>
                    <span class="location-name">Kepulauan Seribu Selatan</span>
                    <span class="location-count">4 Sites</span>
                </li>
            </ul>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="main-content">
        {{-- Search + Map Button --}}
        <div class="flex items-center gap-4 mb-6">
            <!-- Search -->
            <div class="search-bar flex-1 max-w-[500px]">
                <input type="text" placeholder="Cari lokasi mangrove" id="searchInput">
                <button class="btn-search">🔍</button>
            </div>

            <!-- Spacer -->
            <div class="ml-auto">
                <!-- Map Button -->
                <button
                    onclick="openMapModal()"
                    class="flex items-center justify-center
                           w-[48px] h-[48px]
                           rounded-[12px]
                           border border-[#E0E4EE]
                           bg-white
                           hover:bg-gray-50
                           transition-colors"
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

        {{-- Filter Tabs by Group --}}
        <div class="filter-tabs">
            <button class="tab active" onclick="filterByGroup('all')">Semua</button>
            <button class="tab" onclick="filterByGroup('hutan-lindung-angke-kapuk')">Penjaringan, Jakarta Utara</button>
            <button class="tab" onclick="filterByGroup('elang-laut-boulevard')">Cilincing, Jakarta Utara</button>
            <button class="tab" onclick="filterByGroup('pasmar-1-tni-al')">Kep. Seribu Utara</button>
            <button class="tab" onclick="filterByGroup('kep-seribu-selatan')">Kep. Seribu Selatan</button>
        </div>

        {{-- Cards Grid --}}
        <div class="cards-grid">
            @foreach($locations as $location)
            <a href="{{ route('detail-lokasi', $location['slug']) }}"
               class="card location-card"
               data-group="{{ $location['group'] ?? 'all' }}"
               style="text-decoration: none; color: inherit; display: block;">
                <div class="card-image">
                    <img src="{{ $location['images'][0] ?? 'https://via.placeholder.com/300x200' }}" alt="{{ $location['name'] }}" loading="lazy">
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ $location['name'] }}</h3>
                    <div class="card-badges">
                        <span class="badge badge-{{ strtolower($location['type']) }}">{{ $location['type'] }}</span>
                        <span class="badge badge-year">{{ $location['year'] }}</span>
                    </div>
                    <div class="card-info">
                        <div class="info-row">
                            <span class="icon">
                                <img src="https://res.cloudinary.com/dmcvht1vr/image/upload/v1769412092/605f77f2-e3f3-415e-8ae4-8846f9770cc7.png" alt="Location" style="width: 16px; height: 16px; object-fit: contain;">
                            </span>
                            <span class="text">{{ $location['coords'] }}</span>
                        </div>
                        <div class="info-row details">
                            <div class="detail-item">
                                <span class="label">Luas Area</span>
                                <span class="value">{{ $location['area'] }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Kerapatan</span>
                                <span class="value">{{ $location['density'] }}</span>
                            </div>
                        </div>
                        <p class="description">{{ $location['description'] ?? 'Tidak ada deskripsi' }}</p>

                        @if(isset($location['damage_count']) && $location['damage_count'] > 0)
                        <div class="status damage-status">
                            <span class="status-icon">⚠️</span>
                            <span class="status-text">{{ $location['damage_count'] }} Kerusakan teridentifikasi</span>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </main>
</div>

{{-- Modal Matriks Rekomendasi --}}
<div class="matrix-backdrop" id="matrixBackdrop" onclick="closeMatrix()"></div>
<div class="matrix-modal" id="matrixModal">
    <button class="modal-close" onclick="closeMatrix()">&times;</button>
    <div class="matrix-header">
        <h3>Matrik Rekomendasi Pengelolaan Kawasan Hutan Mangrove DKI Jakarta</h3>
    </div>

    <div class="matrix-container">
        {{-- Y-Axis Label --}}
        <div class="y-axis-label">
            <span>Nilai Akhir Kesehatan (NAK)</span>
        </div>

        {{-- Matrix Grid --}}
        <div class="matrix-grid">
            {{-- Row 10 --}}
            <div class="nak-label">10</div>
            <div class="matrix-cell pengkayaan-prioritas">
                <div class="cell-title">Pengkayaan Prioritas</div>
                <ul><li>N/A</li></ul>
            </div>
            <div class="matrix-cell dilindungi">
                <div class="cell-title">Dilindungi</div>
                <ul><li>N/A</li></ul>
            </div>
            <div class="matrix-cell dipertahankan">
                <div class="cell-title">Dipertahankan dan/atau Pemanfaatan Lestari</div>
                <ul><li>N/A</li></ul>
            </div>

            {{-- Row 8 --}}
            <div class="nak-label">8</div>
            <div class="matrix-cell pengkayaan">
                <div class="cell-title">Pengkayaan</div>
                <ul>
                    <li>Pantai Marunda</li>
                    <li>Mangrove STIP</li>
                    <li>Mangrove Si Pitung</li>
                </ul>
            </div>
            <div class="matrix-cell pengkayaan">
                <div class="cell-title">Pengkayaan</div>
                <ul>
                    <li>Rawa Hutan Lindung</li>
                    <li>Pos 2 Hutan Lindung</li>
                    <li>TWA Angke Kapuk</li>
                </ul>
            </div>
            <div class="matrix-cell dilindungi-2">
                <div class="cell-title">Dilindungi</div>
                <ul>
                    <li>Pos 5 Hutan Lindung</li>
                    <li>Pos Elang Laut</li>
                    <li>Pasmar 1 TNI AL</li>
                    <li>Pulau Lancang Besar</li>
                    <li>Ekowisata Mangrove PIK</li>
                </ul>
            </div>

            {{-- Row 6 --}}
            <div class="nak-label">6</div>
            <div class="matrix-cell rehabilitasi">
                <div class="cell-title">Rehabilitasi</div>
                <ul>
                    <li>Tanah Timbul (Bird Feeding)</li>
                    <li>Pulau Kelapa Dua</li>
                    <li>Pulau Tidung Besar dan Tidung Kecil</li>
                    <li>Pulau Pramuka</li>
                </ul>
            </div>
            <div class="matrix-cell pengkayaan-rehabilitasi">
                <div class="cell-title">Pengkayaan / Rehabilitasi</div>
                <ul>
                    <li>Suaka Margasatwa Muara Angke</li>
                </ul>
            </div>
            <div class="matrix-cell pengkayaan-2">
                <div class="cell-title">Pengkayaan</div>
                <ul>
                    <li>Pulau Kelapa</li>
                    <li>Komunitas Mangrove Muara Angke</li>
                </ul>
            </div>

            {{-- Row 4 --}}
            <div class="nak-label">4</div>
            <div class="matrix-cell restorasi">
                <div class="cell-title">Restorasi</div>
                <ul><li>N/A</li></ul>
            </div>
            <div class="matrix-cell rehabilitasi-2">
                <div class="cell-title">Rehabilitasi</div>
                <ul><li>N/A</li></ul>
            </div>
            <div class="matrix-cell rehabilitasi-3">
                <div class="cell-title">Rehabilitasi</div>
                <ul><li>N/A</li></ul>
            </div>

            {{-- Row 2 --}}
            <div class="nak-label">2</div>
            <div class="matrix-cell restorasi-prioritas">
                <div class="cell-title">Restorasi Prioritas</div>
                <ul><li>N/A</li></ul>
            </div>
            <div class="matrix-cell restorasi-2">
                <div class="cell-title">Restorasi</div>
                <ul><li>N/A</li></ul>
            </div>
            <div class="matrix-cell rehabilitasi-prioritas">
                <div class="cell-title">Rehabilitasi Prioritas</div>
                <ul><li>N/A</li></ul>
            </div>
        </div>

        {{-- X-Axis Labels --}}
        <div class="x-axis-labels">
            <div class="x-label">Jarang</div>
            <div class="x-label">Sedang</div>
            <div class="x-label">Lebat</div>
        </div>

        {{-- X-Axis Title --}}
        <div class="x-axis-title">Kelas Kerapatan</div>
    </div>
</div>

{{-- Modal Map Group --}}
<div class="map-group-backdrop" id="mapGroupBackdrop" onclick="closeMapModal()"></div>
<div class="map-group-modal" id="mapGroupModal">
    <button class="modal-close" onclick="closeMapModal()">&times;</button>
    <div class="map-group-header">
        <h3 id="mapGroupTitle">Peta Sebaran Mangrove</h3>
    </div>
    <div id="groupMap" style="height: 500px; width: 100%; border-radius: 8px;"></div>
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

.info-icon-wrapper {
    position: relative;
    cursor: pointer;
}

.info-icon-img {
    width: 20px;
    height: 20px;
    object-fit: contain;
    transition: opacity 0.2s;
}

.info-icon-img:hover {
    opacity: 0.7;
}

/* Matrix Modal Styles */
.matrix-backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

.matrix-backdrop.show {
    display: block;
}

.matrix-modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    z-index: 10000;
    max-width: 95vw;
    max-height: 90vh;
    overflow: auto;
    padding: 1.5rem;
}

.matrix-modal.show {
    display: block;
}

.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: none;
    border: none;
    font-size: 2rem;
    color: #6b7280;
    cursor: pointer;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s;
}

.modal-close:hover {
    background: #f3f4f6;
    color: #1a1a1a;
}

/* Map Group Modal Styles */
.map-group-backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

.map-group-backdrop.show {
    display: block;
}

.map-group-modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    z-index: 10000;
    max-width: 90vw;
    width: 800px;
    max-height: 80vh;
    overflow: hidden;
    padding: 1.5rem;
}

.map-group-modal.show {
    display: block;
}

.map-group-header {
    margin-bottom: 1rem;
}

.map-group-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a1a1a;
    text-align: center;
}

.matrix-header h3 {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1a1a1a;
}

.matrix-container {
    display: grid;
    grid-template-columns: 60px 1fr;
    grid-template-rows: auto 1fr auto auto;
    gap: 0.5rem;
}

.y-axis-label {
    grid-column: 1;
    grid-row: 1 / 3;
    display: flex;
    align-items: center;
    justify-content: center;
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    font-weight: 600;
    font-size: 0.875rem;
    color: #374151;
}

.matrix-grid {
    grid-column: 2;
    grid-row: 2;
    display: grid;
    grid-template-columns: 40px repeat(3, 1fr);
    gap: 0.5rem;
}

.nak-label {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
    color: #374151;
}

.matrix-cell {
    padding: 0.75rem;
    border-radius: 6px;
    min-height: 100px;
}

.cell-title {
    font-weight: 600;
    font-size: 0.75rem;
    margin-bottom: 0.5rem;
    color: white;
    text-align: center;
}

.matrix-cell ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.matrix-cell li {
    font-size: 0.7rem;
    color: #1a1a1a;
    padding: 0.25rem 0;
    line-height: 1.3;
}

/* Color schemes for each category */
.pengkayaan-prioritas {
    background: linear-gradient(135deg, #d4f4dd 0%, #b8e6c9 100%);
}

.dilindungi {
    background: linear-gradient(135deg, #d1f5e8 0%, #a8e6cf 100%);
}

.dipertahankan {
    background: linear-gradient(135deg, #b8dfe6 0%, #8cc8d9 100%);
}

.pengkayaan {
    background: linear-gradient(135deg, #d4a574 0%, #c69461 100%);
}

.dilindungi-2 {
    background: linear-gradient(135deg, #6fb98f 0%, #5ba87d 100%);
}

.rehabilitasi {
    background: linear-gradient(135deg, #e8b4a8 0%, #d9998c 100%);
}

.pengkayaan-rehabilitasi {
    background: linear-gradient(135deg, #d4a574 0%, #c69461 100%);
}

.pengkayaan-2 {
    background: linear-gradient(135deg, #f4e6a8 0%, #e8d98c 100%);
}

.restorasi {
    background: linear-gradient(135deg, #c85a54 0%, #b44a44 100%);
}

.rehabilitasi-2 {
    background: linear-gradient(135deg, #d4a574 0%, #c69461 100%);
}

.rehabilitasi-3 {
    background: linear-gradient(135deg, #d9a67a 0%, #c89461 100%);
}

.restorasi-prioritas {
    background: linear-gradient(135deg, #e8a4a4 0%, #d98989 100%);
}

.restorasi-2 {
    background: linear-gradient(135deg, #f5c4c4 0%, #e8a8a8 100%);
}

.rehabilitasi-prioritas {
    background: linear-gradient(135deg, #f4d4a8 0%, #e8c48c 100%);
}

.x-axis-labels {
    grid-column: 2;
    grid-row: 3;
    display: grid;
    grid-template-columns: 40px repeat(3, 1fr);
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.x-label {
    text-align: center;
    font-weight: 600;
    font-size: 0.875rem;
    color: #374151;
}

.x-label:first-child {
    grid-column: 2;
}

.x-axis-title {
    grid-column: 2;
    grid-row: 4;
    text-align: center;
    font-weight: 600;
    font-size: 0.875rem;
    color: #374151;
    margin-top: 0.5rem;
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

.badge-rehabilitasi {
    background-color: #fed7aa;
    color: #9a3412;
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

.status.damage-status {
    background: #fef2f2;
    padding: 0.5rem 0.75rem;
    border-radius: 4px;
    border-left: 3px solid #dc2626;
    margin-bottom: 0.5rem;
}

.status.damage-status .status-text {
    color: #991b1b;
    font-weight: 600;
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

    .matrix-modal {
        padding: 1rem;
        max-width: 100%;
        max-height: 95vh;
    }

    .matrix-header h3 {
        font-size: 0.938rem;
    }

    .matrix-grid {
        grid-template-columns: 30px repeat(3, 1fr);
        gap: 0.25rem;
    }

    .nak-label {
        font-size: 0.75rem;
    }

    .matrix-cell {
        padding: 0.5rem;
        min-height: 80px;
    }

    .cell-title {
        font-size: 0.65rem;
    }

    .matrix-cell li {
        font-size: 0.625rem;
    }

    .x-axis-labels {
        grid-template-columns: 30px repeat(3, 1fr);
    }

    .x-label,
    .x-axis-title,
    .y-axis-label span {
        font-size: 0.75rem;
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

    .matrix-modal {
        padding: 0.75rem;
    }

    .matrix-header h3 {
        font-size: 0.813rem;
        line-height: 1.3;
    }

    .matrix-container {
        grid-template-columns: 40px 1fr;
    }

    .matrix-grid {
        grid-template-columns: 25px repeat(3, 1fr);
        gap: 0.2rem;
    }

    .matrix-cell {
        padding: 0.35rem;
        min-height: 70px;
    }

    .cell-title {
        font-size: 0.6rem;
        margin-bottom: 0.25rem;
    }

    .matrix-cell li {
        font-size: 0.55rem;
        padding: 0.15rem 0;
    }

    .nak-label {
        font-size: 0.7rem;
    }

    .x-axis-labels {
        grid-template-columns: 25px repeat(3, 1fr);
        gap: 0.2rem;
    }

    .x-label,
    .x-axis-title {
        font-size: 0.7rem;
    }

    .y-axis-label span {
        font-size: 0.7rem;
    }

    .map-group-modal {
        max-width: 95vw;
        padding: 1rem;
    }

    #groupMap {
        height: 350px;
    }
}
</style>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter tabs functionality
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.querySelector('.btn-search');

    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            const searchTerm = searchInput.value.toLowerCase();
            filterCards(searchTerm);
        });
    }

    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchBtn.click();
            }
        });
    }
});

// Filter cards by search term
function filterCards(searchTerm) {
    const cards = document.querySelectorAll('.location-card');
    cards.forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const description = card.querySelector('.description').textContent.toLowerCase();

        if (title.includes(searchTerm) || description.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Filter by group
function filterByGroup(group) {
    const cards = document.querySelectorAll('.location-card');

    cards.forEach(card => {
        const cardGroup = card.getAttribute('data-group');

        if (group === 'all' || cardGroup === group) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Matrix Modal Functions
function toggleMatrix() {
    const modal = document.getElementById('matrixModal');
    const backdrop = document.getElementById('matrixBackdrop');

    modal.classList.toggle('show');
    backdrop.classList.toggle('show');
}

function closeMatrix() {
    const modal = document.getElementById('matrixModal');
    const backdrop = document.getElementById('matrixBackdrop');

    modal.classList.remove('show');
    backdrop.classList.remove('show');
}

// Map Modal Functions
let groupMap = null;

function openMapModal() {
    const modal = document.getElementById('mapGroupModal');
    const backdrop = document.getElementById('mapGroupBackdrop');

    modal.classList.add('show');
    backdrop.classList.add('show');

    // Initialize map if not already initialized
    setTimeout(() => {
        if (!groupMap) {
            initGroupMap();
        } else {
            groupMap.invalidateSize();
        }
    }, 100);
}

function closeMapModal() {
    const modal = document.getElementById('mapGroupModal');
    const backdrop = document.getElementById('mapGroupBackdrop');

    modal.classList.remove('show');
    backdrop.classList.remove('show');
}

function initGroupMap() {
    // Initialize map
    groupMap = L.map('groupMap').setView([-6.10, 106.80], 12);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19
    }).addTo(groupMap);

    // Group locations data
    const groupLocations = {
        'hutan-lindung-angke-kapuk': [
            { name: 'Rawa Hutan Lindung', coords: [-6.1023, 106.7655] },
            { name: 'Tanah Timbul (Bird Feeding)', coords: [-6.1012, 106.7645] },
            { name: 'Pos 2 Hutan Lindung', coords: [-6.1025, 106.7680] },
            { name: 'Pos 5 Hutan Lindung', coords: [-6.0895, 106.7820] },
            { name: 'Pos 3 Hutan Lindung', coords: [-6.1008, 106.7700] }
        ],
        'elang-laut-boulevard': [
            { name: 'Titik 2 Elang Laut', coords: [-6.1015, 106.7670] },
            { name: 'Titik 1 Elang Laut', coords: [-6.1020, 106.7665] }
        ],
        'pasmar-1-tni-al': [
            { name: 'Rusun TNI AL', coords: [-6.0912, 106.9105] },
            { name: 'Pasmar 1 TNI AL', coords: [-6.1156, 106.8598] }
        ]
    };

    // Add all markers
    const allLocations = [...groupLocations['hutan-lindung-angke-kapuk'],
                          ...groupLocations['elang-laut-boulevard'],
                          ...groupLocations['pasmar-1-tni-al']];

    allLocations.forEach(location => {
        const marker = L.marker(location.coords).addTo(groupMap);
        marker.bindPopup(`<strong>${location.name}</strong>`);
    });
}

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeMatrix();
        closeMapModal();
    }
});
</script>
@endpush
@endsection
