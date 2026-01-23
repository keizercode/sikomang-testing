@extends('layouts.app')

@section('title', $location['name'] . ' - Detail Lokasi - SIKOMANG')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .detail-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 2rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .breadcrumb a {
        color: #009966;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .detail-header {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 2rem;
        margin-bottom: 2rem;
        align-items: start;
    }

    .title-section h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1rem;
    }

    .badges {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.813rem;
        font-weight: 600;
    }

    .badge-pengkayaan {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-rehabilitasi {
        background: #fed7aa;
        color: #9a3412;
    }

    .badge-year {
        background: #f3f4f6;
        color: #374151;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        border: none;
    }

    .btn-primary {
        background: #009966;
        color: white;
    }

    .btn-primary:hover {
        background: #008855;
    }

    .btn-secondary {
        background: white;
        color: #374151;
        border: 1px solid #e5e7eb;
    }

    .btn-secondary:hover {
        background: #f9fafb;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .main-content {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #1a1a1a;
    }

    #detailMap {
        height: 400px;
        border-radius: 8px;
        overflow: hidden;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .info-label {
        font-size: 0.813rem;
        color: #6b7280;
    }

    .info-value {
        font-size: 0.938rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }

    .gallery-item {
        aspect-ratio: 4/3;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .gallery-item:hover {
        transform: scale(1.05);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #009966 0%, #00724c 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px;
    }

    .stat-label {
        font-size: 0.875rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }

    .damage-alert {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 1rem;
        display: flex;
        align-items: start;
        gap: 0.75rem;
    }

    .damage-alert svg {
        width: 1.25rem;
        height: 1.25rem;
        color: #dc2626;
        flex-shrink: 0;
    }

    .damage-text {
        font-size: 0.875rem;
        color: #991b1b;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal-content {
        position: relative;
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 1200px;
        top: 50%;
        transform: translateY(-50%);
    }

    .modal-content img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #bbb;
    }

    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .detail-header {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            justify-content: flex-start;
        }
    }

    @media (max-width: 768px) {
        .detail-container {
            padding: 1rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .gallery {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    }
</style>
@endpush

@section('content')
<div class="detail-container">
    {{-- Breadcrumb --}}
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        <a href="{{ route('monitoring') }}">Monitoring</a>
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        <a href="{{ route('hasil-pemantauan') }}">Hasil Pemantauan</a>
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        <span>{{ $location['name'] }}</span>
    </nav>

    {{-- Header --}}
    <div class="detail-header">
        <div class="title-section">
            <h1>{{ $location['name'] }}</h1>
            <div class="badges">
                <span class="badge badge-{{ strtolower($location['type']) }}">{{ $location['type'] }}</span>
                <span class="badge badge-year">{{ $location['year'] }}</span>
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn btn-primary" onclick="window.print()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                <span>Data</span>
            </button>
            <button class="btn btn-secondary" onclick="generateReport()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Report</span>
            </button>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">
        {{-- Main Content --}}
        <div class="main-content">
            {{-- Map Card --}}
            <div class="card">
                <h2 class="card-title">Peta Lokasi</h2>
                <div id="detailMap"></div>
            </div>

            {{-- Informasi Lokasi Kawasan --}}
            <div class="card">
                <h2 class="card-title">Informasi Lokasi Kawasan</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Koordinat</span>
                        <span class="info-value">{{ $location['coords'] }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Luas Area</span>
                        <span class="info-value">{{ $location['area'] }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kerapatan</span>
                        <span class="info-value">{{ $location['density'] }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kesehatan Mangrove</span>
                        <span class="info-value">{{ $location['health'] }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Serapan Karbon</span>
                        <span class="info-value">{{ $location['carbon_data'] }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Pengelola</span>
                        <span class="info-value">{{ $location['manager'] }}</span>
                    </div>
                </div>

                <div style="margin-top: 1.5rem;">
                    <div class="info-item">
                        <span class="info-label">Lokasi</span>
                        <span class="info-value">{{ $location['location'] }}</span>
                    </div>
                </div>

                <div style="margin-top: 1.5rem;">
                    <div class="info-item">
                        <span class="info-label">Species</span>
                        <span class="info-value">{{ $location['species'] }}</span>
                    </div>
                </div>

                <div style="margin-top: 1.5rem;">
                    <div class="info-item">
                        <span class="info-label">Deskripsi</span>
                        <p style="color: #4b5563; line-height: 1.6; margin-top: 0.5rem;">{{ $location['description'] }}</p>
                    </div>
                </div>
            </div>

            {{-- Galeri Foto --}}
            <div class="card">
                <h2 class="card-title">Galeri Foto</h2>
                <div class="gallery">
                    @foreach($location['images'] as $index => $image)
                    <div class="gallery-item" onclick="openModal('{{ $image }}')">
                        <img src="{{ $image }}" alt="{{ $location['name'] }} - Foto {{ $index + 1 }}" loading="lazy">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="sidebar">
            {{-- Stats Cards --}}
            <div class="stat-card">
                <div class="stat-label">Kesehatan Mangrove</div>
                <div class="stat-value">{{ $location['health'] }}</div>
                <div class="stat-label" style="margin-top: 0.5rem;">{{ $location['health_score'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Total Luas Area</div>
                <div class="stat-value">{{ $location['area'] }}</div>
            </div>

            {{-- Damage Alert --}}
            @if($location['damage_count'] > 0)
            <div class="damage-alert">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <div class="damage-text" style="font-weight: 600; margin-bottom: 0.25rem;">
                        {{ $location['damage_count'] }} Kerusakan Teridentifikasi
                    </div>
                    <div class="damage-text">
                        Diperlukan tindakan konservasi segera
                    </div>
                </div>
            </div>
            @endif

            {{-- Certificate Status --}}
            <div class="card">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span style="font-size: 0.875rem; color: #dc2626;">{{ $location['certificate_status'] }}</span>
                </div>
            </div>

            {{-- Back Button --}}
            <a href="{{ route('hasil-pemantauan') }}" class="btn btn-secondary" style="justify-content: center;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </div>
</div>

{{-- Image Modal --}}
<div id="imageModal" class="modal" onclick="closeModal()">
    <span class="close">&times;</span>
    <div class="modal-content">
        <img id="modalImage" src="" alt="Detail Image">
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Parse coordinates
    const coords = '{{ $location["coords"] }}'.split(',').map(c => parseFloat(c.trim()));

    // Initialize map
    const map = L.map('detailMap').setView([coords[0], coords[1]], 15);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add marker
    const marker = L.marker([coords[0], coords[1]]).addTo(map);
    marker.bindPopup('<strong>{{ $location["name"] }}</strong><br>{{ $location["location"] }}').openPopup();

    // Add circle to show approximate area
    L.circle([coords[0], coords[1]], {
        color: '#009966',
        fillColor: '#00996633',
        fillOpacity: 0.3,
        radius: 500
    }).addTo(map);

    // Modal functions
    function openModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        modal.style.display = 'block';
        modalImg.src = imageSrc;
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    // Generate Report function
    function generateReport() {
        alert('Fitur generate report akan segera tersedia');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush
