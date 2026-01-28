@extends('layouts.app')

@section('title', 'Profil Sebaran Mangrove DKI Jakarta 2025 - SIKOMANG')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    /* ===========================
       LAYOUT STRUCTURE
       =========================== */
    .monitoring-wrapper {
        display: grid;
        grid-template-columns: 500px 1fr;
        height: calc(100vh - 80px);
        overflow: hidden;
    }

    /* ===========================
       INFO PANEL STYLES
       =========================== */
    .info-panel {
        background: white;
        padding: 1.5rem 2rem;
        overflow-y: auto;
        border-right: 1px solid #B9B9B9;
    }

    .page-header {
        margin-bottom: 0 rem;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .page-description {
        font-size: 0.875rem;
        color: #4b5563;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .page-description a {
        color: #009966;
        text-decoration: underline;
    }

    .cta-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #009966;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: background 0.2s;
        margin-bottom: 1.5rem;
    }

    .cta-button:hover {
        background: #008855;
    }

    .cta-button svg {
        width: 1rem;
        height: 1rem;
    }

    /* ===========================
       DATA TABLE STYLES
       =========================== */
    .data-table-container {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.8rem;
        border: 1px solid #FFFFFF;
    }

    .data-table thead th {
        background: #00724C;
        color: white;
        padding: 0.6rem 0.5rem;
        text-align: left;
        font-weight: 600;
        border: 1px solid #FFFFFF;
        font-size: 0.75rem;
    }

    .data-table tbody td {
        padding: 0.5rem;
        border: 1px solid #FFFFFF;
        font-size: 0.8rem;
    }

    .data-table tbody tr:nth-child(even) {
        background: #E5F4EF;
    }

    .section-header td {
        background: #47AC8A !important;
        color: white;
        font-weight: 600;
        border: 1px solid #FFFFFF;
    }

    /* ===========================
       MAP CONTAINER STYLES
       =========================== */
    .map-wrapper {
        position: relative;
        height: 100%;
    }

    #mangroveMap {
        width: 100%;
        height: 100%;
    }

    /* ===========================
       MAP LEGEND STYLES
       =========================== */
    .map-legend {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        max-width: 260px;
    }

    .legend-card {
        background: #F3F4F6;
        border-radius: 0.5rem;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .legend-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .legend-download-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        background: #8dd3c7;
        border: 1px solid #d1d5db;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 500;
        color: #374151;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .legend-download-btn:hover {
        opacity: 0.85;
        background: #7bc3bd;
    }

    .legend-sedang .legend-download-btn {
        background: #FFFFB3;
    }

    .legend-sedang .legend-download-btn:hover {
        background: #f0f0a3;
    }

    .legend-lebat .legend-download-btn {
        background: #BEBADA;
    }

    .legend-lebat .legend-download-btn:hover {
        background: #aeaaca;
    }

    .legend-download-btn svg {
        width: 0.875rem;
        height: 0.875rem;
        color: #6b7280;
    }

    .legend-toggle-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        background: none;
        border: none;
        color: #6b7280;
        font-size: 0.75rem;
        cursor: pointer;
        padding: 0.25rem;
    }

    .legend-toggle-btn:hover {
        color: #374151;
    }

    .legend-toggle-btn svg {
        width: 0.75rem;
        height: 0.75rem;
        transition: transform 0.2s;
    }

    .legend-toggle-btn.expanded svg {
        transform: rotate(180deg);
    }

    .legend-body {
        padding: 0.75rem;
        background: #fafafa;
        display: none;
    }

    .legend-body.show {
        display: block;
    }

    .legend-dataset {
        display: flex;
        gap: 0.5rem;
        font-size: 0.75rem;
    }

    .legend-dataset-label {
        color: #1E1E1E;
        white-space: nowrap;
    }

    .legend-dataset-value {
        color: #009966;
        font-weight: 500;
    }

    /* ===========================
       PANEL TOGGLE BUTTON
       =========================== */
    .panel-toggle {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: 1px solid #e5e7eb;
        border-left: none;
        padding: 1rem 0.5rem;
        cursor: pointer;
        z-index: 1000;
        border-radius: 0 0.375rem 0.375rem 0;
        box-shadow: 2px 0 4px rgba(0,0,0,0.1);
        display: none;
    }

    .panel-toggle:hover {
        background: #E5F4EF;
    }

    .panel-toggle svg {
        width: 1rem;
        height: 1rem;
        color: #6b7280;
    }

    /* ===========================
       CUSTOM MAP POPUP STYLES
       =========================== */
    .leaflet-popup-content-wrapper {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .custom-popup {
        padding: 0.5rem;
        min-width: 200px;
    }

    .popup-title {
        font-weight: 600;
        font-size: 0.875rem;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .popup-info {
        font-size: 0.75rem;
        color: #6b7280;
        margin: 0.25rem 0;
    }

    .popup-link {
        display: inline-block;
        margin-top: 0.5rem;
        color: #009966;
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .popup-link:hover {
        text-decoration: underline;
    }

    /* ===========================
       RESPONSIVE DESIGN
       =========================== */
    @media (max-width: 1024px) {
        .monitoring-wrapper {
            grid-template-columns: 1fr;
            height: auto;
        }

        .info-panel {
            height: auto;
            border-right: none;
            border-bottom: 1px solid #e5e7eb;
            max-height: 50vh;
        }

        .map-wrapper {
            height: 600px;
        }

        .map-legend {
            position: relative;
            top: 0;
            right: 0;
            margin: 1rem;
            max-width: 100%;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .legend-card {
            flex: 1;
            min-width: 200px;
        }

        .panel-toggle {
            display: none !important;
        }
    }

    @media (max-width: 768px) {
        .info-panel {
            padding: 1rem;
        }

        .page-title {
            font-size: 1.25rem;
        }

        .data-table {
            font-size: 0.7rem;
        }

        .data-table thead th,
        .data-table tbody td {
            padding: 0.4rem 0.25rem;
        }

        .map-wrapper {
            height: 500px;
        }

        .map-legend {
            flex-direction: column;
        }

        .legend-card {
            min-width: 100%;
        }
    }

    @media (max-width: 640px) {
        .map-wrapper {
            height: 400px;
        }

        .cta-button {
            font-size: 0.813rem;
            padding: 0.625rem 1.25rem;
        }
    }
</style>
@endpush

@section('content')
<div class="monitoring-wrapper">
    {{-- Info Panel Section --}}
    <aside class="info-panel">
        {{-- Page Header --}}
        <header class="page-header">
            <h1 class="page-title">
                Profil Sebaran Mangrove DKI Jakarta 2025
            </h1>

            <p class="page-description">
                SIKOMANG menyediakan data monitoring komprehensif untuk {{ $total_sites }} titik pemantauan di 4 wilayah DKI Jakarta.
                Platform ini memungkinkan pemantauan real-time kondisi ekosistem mangrove, pelaporan kerusakan, dan koordinasi
                upaya konservasi untuk mendukung kelestarian lingkungan pesisir Jakarta.
            </p>

            <a href="{{ route('hasil-pemantauan') }}" class="cta-button">
                <span>Hasil Pemantauan</span>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"/>
                </svg>
            </a>
        </header>

        {{-- Data Table Section --}}
        <div class="data-table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Fungsi Kawasan</th>
                        <th>Jarang</th>
                        <th>Sedang</th>
                        <th>Lebat</th>
                        <th>Luas Total</th>
                        <th>Status Konservasi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Luar Kawasan Section --}}
                    <tr class="section-header">
                        <td colspan="6">Luar Kawasan</td>
                    </tr>
                    @foreach($monitoring_data['luar_kawasan'] as $row)
                    <tr>
                        <td>{{ $row['fungsi'] }}</td>
                        <td>{{ $row['jarang'] }}</td>
                        <td>{{ $row['sedang'] }}</td>
                        <td>{{ $row['lebat'] }}</td>
                        <td>{{ $row['total'] }}</td>
                        <td>{{ $row['status'] }}</td>
                    </tr>
                    @endforeach

                    {{-- Dalam Kawasan Section --}}
                    <tr class="section-header">
                        <td colspan="6">Dalam Kawasan</td>
                    </tr>
                    @foreach($monitoring_data['dalam_kawasan'] as $row)
                    <tr>
                        <td>{{ $row['fungsi'] }}</td>
                        <td>{{ $row['jarang'] }}</td>
                        <td>{{ $row['sedang'] }}</td>
                        <td>{{ $row['lebat'] }}</td>
                        <td>{{ $row['total'] }}</td>
                        <td>{{ $row['status'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </aside>

    {{-- Map Container Section --}}
    <main class="map-wrapper">
        {{-- Panel Toggle Button (Desktop Only) --}}
        <button class="panel-toggle" onclick="togglePanel()" aria-label="Toggle Panel">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Leaflet Map --}}
        <div id="mangroveMap"></div>

        {{-- Map Legend --}}
        <div class="map-legend">
            @foreach(['jarang', 'sedang', 'lebat'] as $density)
            <div class="legend-card legend-{{ $density }}">
                <div class="legend-header">
                    <a href="{{ route('monitoring.export', $density) }}"
                       class="legend-download-btn"
                       title="Download data Mangrove {{ ucfirst($density) }}">
                        <svg viewBox="0 0 12 15" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.40625 13.125V1.875C1.40625 1.61719 1.61719 1.40625 1.875 1.40625H6.5625V3.75C6.5625 4.26855 6.98145 4.6875 7.5 4.6875H9.84375V13.125C9.84375 13.3828 9.63281 13.5938 9.375 13.5938H1.875C1.61719 13.5938 1.40625 13.3828 1.40625 13.125ZM1.875 0C0.84082 0 0 0.84082 0 1.875V13.125C0 14.1592 0.84082 15 1.875 15H9.375C10.4092 15 11.25 14.1592 11.25 13.125V4.52637C11.25 4.02832 11.0537 3.55078 10.7021 3.19922L8.04785 0.547852C7.69629 0.196289 7.22168 0 6.72363 0H1.875ZM6.32812 6.79688C6.32812 6.40723 6.01465 6.09375 5.625 6.09375C5.23535 6.09375 4.92188 6.40723 4.92188 6.79688V9.78809L4.01367 8.87988C3.73828 8.60449 3.29297 8.60449 3.02051 8.87988C2.74805 9.15527 2.74512 9.60059 3.02051 9.87305L5.12988 11.9824C5.40527 12.2578 5.85059 12.2578 6.12305 11.9824L8.23242 9.87305C8.50781 9.59766 8.50781 9.15234 8.23242 8.87988C7.95703 8.60742 7.51172 8.60449 7.23926 8.87988L6.33105 9.78809V6.79688H6.32812Z"/>
                        </svg>
                        <span>Map Data</span>
                    </a>
                    <button class="legend-toggle-btn" onclick="toggleLegend('{{ $density }}')" aria-label="Toggle Legend">
                        <span>Expand</span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>
                <div class="legend-body" id="legend-body-{{ $density }}">
                    <div class="legend-dataset">
                        <span class="legend-dataset-label">Dataset:</span>
                        <span class="legend-dataset-value">Mangrove Jakarta - {{ ucfirst($density) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // ===========================
    // CONFIGURATION
    // ===========================
    const CONFIG = {
        map: {
            center: [-6.10, 106.80],
            zoom: 11,
            maxZoom: 19
        },
        colors: {
            jarang: '#8dd3c7',
            sedang: '#FFFFB3',
            lebat: '#BEBADA'
        },
        circleRadius: 500, // 500 meters
        markerSize: 24
    };

    // ===========================
    // MANGROVE DATA FROM CONTROLLER
    // ===========================
    const locationsData = @json($locations);

    console.log('=== MONITORING MAP DEBUG ===');
    console.log('Total locations from controller:', locationsData.length);
    console.log('Locations data:', locationsData);

    // Group locations by density
    const mangroveData = {
        'jarang': [],
        'sedang': [],
        'lebat': []
    };

    locationsData.forEach(location => {
        // Parse coordinates from "lat, lng" string to [lat, lng] array
        const coordsArray = location.coords.split(',').map(c => parseFloat(c.trim()));

        const mapLocation = {
            name: location.name,
            coords: coordsArray,
            area: location.area,
            slug: location.slug,
            density: location.density
        };

        // Add to appropriate density group
        const densityKey = location.density.toLowerCase();
        if (mangroveData[densityKey]) {
            mangroveData[densityKey].push(mapLocation);
        }
    });

    console.log('Grouped by density:');
    console.log('- Jarang:', mangroveData.jarang.length, 'locations');
    console.log('- Sedang:', mangroveData.sedang.length, 'locations');
    console.log('- Lebat:', mangroveData.lebat.length, 'locations');

    // ===========================
    // MAP INITIALIZATION
    // ===========================
    const map = L.map('mangroveMap', {
        center: CONFIG.map.center,
        zoom: CONFIG.map.zoom,
        zoomControl: true,
        scrollWheelZoom: true
    });

    // ===========================
    // TILE LAYERS
    // ===========================
    const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: CONFIG.map.maxZoom
    }).addTo(map);

    const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri',
        maxZoom: CONFIG.map.maxZoom
    });

    // Layer control
    const baseMaps = {
        "Peta Standar": osmLayer,
        "Satelit": satelliteLayer
    };
    L.control.layers(baseMaps, null, { position: 'topleft' }).addTo(map);

    // ===========================
    // LAYER GROUPS
    // ===========================
    const layers = {
        jarang: L.layerGroup().addTo(map),
        sedang: L.layerGroup().addTo(map),
        lebat: L.layerGroup().addTo(map)
    };

    // ===========================
    // HELPER FUNCTIONS
    // ===========================
    function createCustomIcon(color) {
        return L.divIcon({
            className: 'custom-marker',
            html: `<div style="background-color: ${color}; width: ${CONFIG.markerSize}px; height: ${CONFIG.markerSize}px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`,
            iconSize: [CONFIG.markerSize, CONFIG.markerSize],
            iconAnchor: [CONFIG.markerSize / 2, CONFIG.markerSize / 2],
            popupAnchor: [0, -CONFIG.markerSize / 2]
        });
    }

    function createPopupContent(location, category) {
        return `
            <div class="custom-popup">
                <div class="popup-title">${location.name}</div>
                <div class="popup-info">📍 ${location.coords[0].toFixed(4)}, ${location.coords[1].toFixed(4)}</div>
                <div class="popup-info">📏 Luas: ${location.area}</div>
                <div class="popup-info">🌳 Kategori: ${category.charAt(0).toUpperCase() + category.slice(1)}</div>
                <a href="/monitoring/lokasi/${location.slug}" class="popup-link">Lihat Detail →</a>
            </div>
        `;
    }

    // ===========================
    // ADD MARKERS TO MAP
    // ===========================
    Object.keys(mangroveData).forEach(category => {
        mangroveData[category].forEach(location => {
            // Create marker
            const marker = L.marker(location.coords, {
                icon: createCustomIcon(CONFIG.colors[category])
            }).addTo(layers[category]);

            // Bind popup
            marker.bindPopup(createPopupContent(location, category));

            // Add coverage circle
            L.circle(location.coords, {
                color: CONFIG.colors[category],
                fillColor: CONFIG.colors[category],
                fillOpacity: 0.3,
                radius: CONFIG.circleRadius,
                weight: 2
            }).addTo(layers[category]);

            // Add tooltip
            marker.bindTooltip(location.name, {
                permanent: false,
                direction: 'top',
                className: 'custom-tooltip'
            });
        });
    });

    // ===========================
    // UI INTERACTION FUNCTIONS
    // ===========================
    function toggleLegend(type) {
        const body = document.getElementById(`legend-body-${type}`);
        const btn = body.previousElementSibling.querySelector('.legend-toggle-btn');
        const icon = btn.querySelector('svg path');
        const text = btn.querySelector('span');

        body.classList.toggle('show');
        btn.classList.toggle('expanded');

        if (body.classList.contains('show')) {
            text.textContent = 'Collapse';
        } else {
            text.textContent = 'Expand';
        }
    }

    function togglePanel() {
        const panel = document.querySelector('.info-panel');
        const container = document.querySelector('.monitoring-wrapper');
        const toggleBtn = document.querySelector('.panel-toggle');

        if (panel.style.display === 'none') {
            panel.style.display = 'block';
            container.style.gridTemplateColumns = '500px 1fr';
            toggleBtn.querySelector('svg path').setAttribute('d', 'M13 5l7 7-7 7M5 5l7 7-7 7');
        } else {
            panel.style.display = 'none';
            container.style.gridTemplateColumns = '0 1fr';
            toggleBtn.querySelector('svg path').setAttribute('d', 'M11 19l-7-7 7-7M18 19l-7-7 7-7');
        }

        setTimeout(() => map.invalidateSize(), 300);
    }

    // ===========================
    // EVENT LISTENERS
    // ===========================
    window.addEventListener('resize', () => {
        map.invalidateSize();
    });

    // Show toggle button on desktop when panel is hidden
    if (window.innerWidth > 1024) {
        const panel = document.querySelector('.info-panel');
        const toggleBtn = document.querySelector('.panel-toggle');

        if (panel.style.display === 'none') {
            toggleBtn.style.display = 'block';
        }
    }

    // Fix map rendering on page load
    setTimeout(() => {
        map.invalidateSize();
    }, 100);
</script>
@endpush
