@extends('layouts.app')

@section('title', 'Pemanfaatan Mangrove - SIKOMANG')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@vite('resources/css/hasil-pemantauan.css')
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
            <button class="tab" onclick="filterByGroup('penjaringan')">Penjaringan, Jakarta Utara</button>
            <button class="tab" onclick="filterByGroup('cilincing')">Cilincing, Jakarta Utara</button>
            <button class="tab" onclick="filterByGroup('kep-seribu-utara')">Kep. Seribu Utara</button>
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
    const tabs = document.querySelectorAll('.filter-tabs .tab');

    // Update active tab
    tabs.forEach(tab => {
        tab.classList.remove('active');
    });

    // Set active tab
    const clickedTab = event.target;
    clickedTab.classList.add('active');

    // Filter cards
    let visibleCount = 0;
    cards.forEach(card => {
        const cardGroup = card.getAttribute('data-group');

        if (group === 'all' || cardGroup === group) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    console.log(`Filtered to group: ${group}, visible cards: ${visibleCount}`);
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
        'penjaringan': [
            { name: 'Rawa Hutan Lindung', coords: [-6.1023, 106.7655] },
            { name: 'Tanah Timbul (Bird Feeding)', coords: [-6.1012, 106.7645] },
            { name: 'Pos 2 Hutan Lindung', coords: [-6.1025, 106.7680] },
            { name: 'Pos 5 Hutan Lindung', coords: [-6.0895, 106.7820] },
            { name: 'TWA Angke Kapuk', coords: [-6.0921, 106.7590] },
            { name: 'Titik 2 Elang Laut', coords: [-6.1015, 106.7670] }
        ],
        'cilincing': [
            { name: 'Rusun TNI AL', coords: [-6.0912, 106.9105] },
            { name: 'Mangrove STIP', coords: [-6.1223, 106.9512] },
            { name: 'Mangrove Si Pitung', coords: [-6.1198, 106.8645] },
            { name: 'Pasmar 1 TNI AL', coords: [-6.1156, 106.8598] }
        ]
    };

    // Add all markers
    const allLocations = [...groupLocations['penjaringan'], ...groupLocations['cilincing']];

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
