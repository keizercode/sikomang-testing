@extends('layouts.app')

@section('title', 'Profil Sebaran Mangrove DKI Jakarta 2025 - SIKOMANG')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .monitoring-container {
        display: grid;
        grid-template-columns: 500px 1fr;
        gap: 0;
        height: calc(100vh - 80px);
        overflow: hidden;
    }

    .info-panel {
        background: white;
        padding: 1.5rem 2rem;
        overflow-y: auto;
        border-right: 1px solid #B9B9B9;
    }

    .map-container {
        position: relative;
        height: 100%;
    }

    #map {
        width: 100%;
        height: 100%;
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

    .btn-primary {
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

    .btn-primary:hover {
        background: #008855;
    }

    .btn-primary svg {
        width: 1rem;
        height: 1rem;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.8rem;
        border: 1px solid #FFFFFF;
    }

    .data-table th {
        background: #00724C;
        color: white;
        padding: 0.6rem 0.5rem;
        text-align: left;
        font-weight: 600;
        border: 1px solid #FFFFFF;
        font-size: 0.75rem;
    }

    .data-table td {
        padding: 0.5rem;
        border: 1px solid #FFFFFF;
        /* background: #47AC8A; */
        font-size: 0.8rem;
    }

    .data-table tr:nth-child(even) {
        background: #E5F4EF;
    }

    .section-header {
        background: #009966;
        color: white;
        padding: 0.5rem;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .section-header td {
        background: #47AC8A;
        color: white;
        font-weight: 600;
        border: 1px solid #FFFFFF;
    }

    /* Map Legend Styles - Updated to match image */
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
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .legend-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .legend-map-data {
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
    }

    .legend-map-data svg {
        width: 0.875rem;
        height: 0.875rem;
        color: #6b7280;
    }

    .legend-expand-btn {
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

    .legend-expand-btn:hover {
        color: #374151;
    }

    .legend-expand-btn svg {
        width: 0.75rem;
        height: 0.75rem;
    }

    .legend-card-body {
        padding: 0.75rem;
        background: #fafafa;
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

    .legend-dataset-value a {
        color: #0b5394;
        text-decoration: none;
    }

    .legend-dataset-value a:hover {
        text-decoration: underline;
    }

    /* Leaflet controls styling */
    .leaflet-control-zoom {
        border: none !important;
        box-shadow: 0 1px 4px rgba(0,0,0,0.15) !important;
    }

    .leaflet-control-zoom a {
        background: white !important;
        color: #333 !important;
        border: none !important;
    }

    .leaflet-control-layers {
        border: none !important;
        box-shadow: 0 1px 4px rgba(0,0,0,0.15) !important;
        border-radius: 0.375rem !important;
    }

    /* Panel toggle button */
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
    }

    .panel-toggle:hover {
        background: #E5F4EF;
    }

    .panel-toggle svg {
        width: 1rem;
        height: 1rem;
        color: #6b7280;
    }

    @media (max-width: 1024px) {
        .monitoring-container {
            grid-template-columns: 1fr;
            height: auto;
        }

        .info-panel {
            height: auto;
            border-right: none;
            border-bottom: 1px solid #e5e7eb;
        }

        .map-container {
            height: 500px;
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
    }

    @media (max-width: 640px) {
        .info-panel {
            padding: 1rem;
        }

        .page-title {
            font-size: 1.25rem;
        }

        .data-table {
            font-size: 0.7rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.4rem 0.25rem;
        }

        .map-container {
            height: 400px;
        }

        .map-legend {
            flex-direction: column;
        }

        .legend-card {
            min-width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="monitoring-container">
    {{-- Info Panel --}}
    <div class="info-panel">
        <h1 class="page-title">
            Profil Sebaran Mangrove DKI Jakarta 2025
        </h1>

        <p class="page-description">
            SIKOMANG menyediakan data monitoring komprehensif untuk 23 titik pemantauan di 4 wilayah DKI Jakarta. Platform ini memungkinkan pemantauan real-time kondisi ekosistem mangrove, pelaporan kerusakan, dan koordinasi upaya konservasi untuk mendukung kelestarian lingkungan pesisir Jakarta.
        </p>

        <a href="#hasil-pemantauan" class="btn-primary">
            <span>Hasil Pemantauan</span>
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"/>
            </svg>
        </a>

        {{-- Data Table --}}
        <table class="data-table" id="hasil-pemantauan">
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
                <tr class="section-header">
                    <td colspan="6">Luar Kawasan</td>
                </tr>
                <tr>
                    <td>APL (Areal Penggunaan Lain)</td>
                    <td>36,54</td>
                    <td>56,38</td>
                    <td>171,28</td>
                    <td>264,21</td>
                    <td>Bukan Kawasan Konservasi</td>
                </tr>
                <tr class="section-header">
                    <td colspan="6">Dalam Kawasan</td>
                </tr>
                <tr>
                    <td>HL (Hutan Lindung)</td>
                    <td>3,03</td>
                    <td>39,06</td>
                    <td>19,59</td>
                    <td>61,67</td>
                    <td>Kawasan Konservasi</td>
                </tr>
                <tr>
                    <td>HP (Hutan Produksi)</td>
                    <td>2,20</td>
                    <td>6,53</td>
                    <td>71,84</td>
                    <td>80,57</td>
                    <td>Bukan Kawasan Konservasi</td>
                </tr>
                <tr>
                    <td>TN (Taman Nasional)</td>
                    <td>29,72</td>
                    <td>5,01</td>
                    <td>21,65</td>
                    <td>56,39</td>
                    <td>Kawasan Konservasi</td>
                </tr>
                <tr>
                    <td>SM (Suaka Margasatwa)</td>
                    <td>8,31</td>
                    <td>11,96</td>
                    <td>26,83</td>
                    <td>47,10</td>
                    <td>Kawasan Konservasi</td>
                </tr>
                <tr>
                    <td>TWA (Taman Wisata Alam)</td>
                    <td>2,01</td>
                    <td>94,49</td>
                    <td>1,79</td>
                    <td>98,28</td>
                    <td>Kawasan Konservasi</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Map Container --}}
    <div class="map-container">
        {{-- Panel Toggle Button --}}
        <button class="panel-toggle" onclick="togglePanel()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
            </svg>
        </button>

        <div id="map"></div>

        {{-- Map Legend - Updated Design --}}
        <div class="map-legend">
            {{-- Legend Card 1 - Jarang --}}
            <div class="legend-card">
                <div class="legend-card-header">
                    <div class="legend-map-data">
                        <svg data-v-f0822899="" class="fill-[#6B7280] group-hover:fill-[#000]" width="12" height="15" viewBox="0 0 12 15" xmlns="http://www.w3.org/2000/svg"><path data-v-f0822899="" d="M1.40625 13.125V1.875C1.40625 1.61719 1.61719 1.40625 1.875 1.40625H6.5625V3.75C6.5625 4.26855 6.98145 4.6875 7.5 4.6875H9.84375V13.125C9.84375 13.3828 9.63281 13.5938 9.375 13.5938H1.875C1.61719 13.5938 1.40625 13.3828 1.40625 13.125ZM1.875 0C0.84082 0 0 0.84082 0 1.875V13.125C0 14.1592 0.84082 15 1.875 15H9.375C10.4092 15 11.25 14.1592 11.25 13.125V4.52637C11.25 4.02832 11.0537 3.55078 10.7021 3.19922L8.04785 0.547852C7.69629 0.196289 7.22168 0 6.72363 0H1.875ZM6.32812 6.79688C6.32812 6.40723 6.01465 6.09375 5.625 6.09375C5.23535 6.09375 4.92188 6.40723 4.92188 6.79688V9.78809L4.01367 8.87988C3.73828 8.60449 3.29297 8.60449 3.02051 8.87988C2.74805 9.15527 2.74512 9.60059 3.02051 9.87305L5.12988 11.9824C5.40527 12.2578 5.85059 12.2578 6.12305 11.9824L8.23242 9.87305C8.50781 9.59766 8.50781 9.15234 8.23242 8.87988C7.95703 8.60742 7.51172 8.60449 7.23926 8.87988L6.33105 9.78809V6.79688H6.32812Z"></path></svg>
                        </svg>
                        <span>Map Data</span>
                    </div>
                    <button class="legend-expand-btn" onclick="toggleLegend('jarang')">
                        <span>Expand</span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>
                <div class="legend-card-body" id="legend-body-jarang">
                    <div class="legend-dataset">
                        <span class="legend-dataset-label">Agregate Dataset:</span>
                        <span class="legend-dataset-value">
                            <a href="#">Mangrove Jakarta - Jarang</a>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Legend Card 2 - Sedang --}}
            <div class="legend-card">
                <div class="legend-card-header">
                    <div class="legend-map-data">
                        <svg data-v-f0822899="" class="fill-[#6B7280] group-hover:fill-[#000]" width="12" height="15" viewBox="0 0 12 15" xmlns="http://www.w3.org/2000/svg"><path data-v-f0822899="" d="M1.40625 13.125V1.875C1.40625 1.61719 1.61719 1.40625 1.875 1.40625H6.5625V3.75C6.5625 4.26855 6.98145 4.6875 7.5 4.6875H9.84375V13.125C9.84375 13.3828 9.63281 13.5938 9.375 13.5938H1.875C1.61719 13.5938 1.40625 13.3828 1.40625 13.125ZM1.875 0C0.84082 0 0 0.84082 0 1.875V13.125C0 14.1592 0.84082 15 1.875 15H9.375C10.4092 15 11.25 14.1592 11.25 13.125V4.52637C11.25 4.02832 11.0537 3.55078 10.7021 3.19922L8.04785 0.547852C7.69629 0.196289 7.22168 0 6.72363 0H1.875ZM6.32812 6.79688C6.32812 6.40723 6.01465 6.09375 5.625 6.09375C5.23535 6.09375 4.92188 6.40723 4.92188 6.79688V9.78809L4.01367 8.87988C3.73828 8.60449 3.29297 8.60449 3.02051 8.87988C2.74805 9.15527 2.74512 9.60059 3.02051 9.87305L5.12988 11.9824C5.40527 12.2578 5.85059 12.2578 6.12305 11.9824L8.23242 9.87305C8.50781 9.59766 8.50781 9.15234 8.23242 8.87988C7.95703 8.60742 7.51172 8.60449 7.23926 8.87988L6.33105 9.78809V6.79688H6.32812Z"></path></svg>
                        </svg>
                        <span>Map Data</span>
                    </div>
                    <button class="legend-expand-btn" onclick="toggleLegend('sedang')">
                        <span>Expand</span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>
                <div class="legend-card-body" id="legend-body-sedang">
                    <div class="legend-dataset">
                        <span class="legend-dataset-label">Agregate Dataset:</span>
                        <span class="legend-dataset-value">
                            <a href="#">Mangrove Jakarta - Sedang</a>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Legend Card 3 - Lebat --}}
            <div class="legend-card">
                <div class="legend-card-header">
                    <div class="legend-map-data">
                        <svg data-v-f0822899="" class="fill-[#6B7280] group-hover:fill-[#000]" width="12" height="15" viewBox="0 0 12 15" xmlns="http://www.w3.org/2000/svg"><path data-v-f0822899="" d="M1.40625 13.125V1.875C1.40625 1.61719 1.61719 1.40625 1.875 1.40625H6.5625V3.75C6.5625 4.26855 6.98145 4.6875 7.5 4.6875H9.84375V13.125C9.84375 13.3828 9.63281 13.5938 9.375 13.5938H1.875C1.61719 13.5938 1.40625 13.3828 1.40625 13.125ZM1.875 0C0.84082 0 0 0.84082 0 1.875V13.125C0 14.1592 0.84082 15 1.875 15H9.375C10.4092 15 11.25 14.1592 11.25 13.125V4.52637C11.25 4.02832 11.0537 3.55078 10.7021 3.19922L8.04785 0.547852C7.69629 0.196289 7.22168 0 6.72363 0H1.875ZM6.32812 6.79688C6.32812 6.40723 6.01465 6.09375 5.625 6.09375C5.23535 6.09375 4.92188 6.40723 4.92188 6.79688V9.78809L4.01367 8.87988C3.73828 8.60449 3.29297 8.60449 3.02051 8.87988C2.74805 9.15527 2.74512 9.60059 3.02051 9.87305L5.12988 11.9824C5.40527 12.2578 5.85059 12.2578 6.12305 11.9824L8.23242 9.87305C8.50781 9.59766 8.50781 9.15234 8.23242 8.87988C7.95703 8.60742 7.51172 8.60449 7.23926 8.87988L6.33105 9.78809V6.79688H6.32812Z"></path></svg>
                        </svg>
                        <span>Map Data</span>
                    </div>
                    <button class="legend-expand-btn" onclick="toggleLegend('lebat')">
                        <span>Expand</span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>
                <div class="legend-card-body" id="legend-body-lebat">
                    <div class="legend-dataset">
                        <span class="legend-dataset-label">Agregate Dataset:</span>
                        <span class="legend-dataset-value">
                            <a href="#">Mangrove Jakarta - Lebat</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Initialize map centered on Jakarta Bay area (Kepulauan Seribu region)
    const map = L.map('map').setView([-5.9, 106.75], 10);

    // Add OpenStreetMap tiles with better styling
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Add layer control for base maps
    const baseMaps = {
        "OpenStreetMap": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
        "Satellite": L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}')
    };

    L.control.layers(baseMaps, null, {position: 'topleft'}).addTo(map);

    // Sample mangrove areas (replace with actual GeoJSON data)
    const mangroveAreas = {
        jarang: [
            {coords: [[-5.85, 106.70], [-5.88, 106.73], [-5.87, 106.68]], name: "Area Jarang 1"},
            {coords: [[-5.78, 106.82], [-5.80, 106.85], [-5.79, 106.80]], name: "Area Jarang 2"}
        ],
        sedang: [
            {coords: [[-5.90, 106.75], [-5.93, 106.78], [-5.92, 106.73]], name: "Area Sedang 1"},
            {coords: [[-5.82, 106.88], [-5.85, 106.91], [-5.84, 106.86]], name: "Area Sedang 2"}
        ],
        lebat: [
            {coords: [[-5.95, 106.80], [-5.98, 106.83], [-5.97, 106.78]], name: "Area Lebat 1"},
            {coords: [[-5.88, 106.65], [-5.91, 106.68], [-5.90, 106.63]], name: "Area Lebat 2"}
        ]
    };

    // Create layer groups
    const layers = {
        jarang: L.layerGroup(),
        sedang: L.layerGroup(),
        lebat: L.layerGroup()
    };

    // Add polygons for each density category
    Object.keys(mangroveAreas).forEach(density => {
        const color = density === 'jarang' ? '#fecaca' :
                     density === 'sedang' ? '#fde047' : '#86efac';

        mangroveAreas[density].forEach(area => {
            L.polygon(area.coords, {
                color: color,
                fillColor: color,
                fillOpacity: 0.6,
                weight: 2
            })
            .bindPopup(`<strong>${area.name}</strong><br>Kategori: ${density.charAt(0).toUpperCase() + density.slice(1)}`)
            .addTo(layers[density]);
        });

        layers[density].addTo(map);
    });

    // Add scale control
    L.control.scale({imperial: false, metric: true, position: 'bottomleft'}).addTo(map);

    // Toggle legend expand/collapse
    function toggleLegend(type) {
        const body = document.getElementById(`legend-body-${type}`);
        const btn = body.previousElementSibling.querySelector('.legend-expand-btn span');

        if (body.style.display === 'none') {
            body.style.display = 'block';
            btn.textContent = 'Expand';
        } else {
            body.style.display = 'none';
            btn.textContent = 'Collapse';
        }
    }

    // Toggle panel visibility
    function togglePanel() {
        const panel = document.querySelector('.info-panel');
        const container = document.querySelector('.monitoring-container');

        if (panel.style.display === 'none') {
            panel.style.display = 'block';
            container.style.gridTemplateColumns = '500px 1fr';
        } else {
            panel.style.display = 'none';
            container.style.gridTemplateColumns = '1fr';
        }

        // Invalidate map size after transition
        setTimeout(() => map.invalidateSize(), 300);
    }

    // Adjust map size on window resize
    window.addEventListener('resize', () => {
        map.invalidateSize();
    });
</script>
@endpush
