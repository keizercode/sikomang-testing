@extends('layouts.app')

@section('title', $location['name'] . ' - Detail Lokasi - SIKOMANG')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@vite([
'resources/css/detail-lokasi.css',
'resources/js/detail-lokasi.js'
])
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

            {{-- Kerusakan & Aksi Penanganan --}}
            @if(isset($location['damages']) && count($location['damages']) > 0)
            <div class="card">
                <h2 class="card-title">Kerusakan Teridentifikasi</h2>
                <ul class="damage-list">
                    @foreach($location['damages'] as $index => $damage)
                    <li class="damage-item">
                        <span class="damage-number">{{ $index + 1 }}.</span>
                        <span>{{ $damage }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            @if(isset($location['actions']) && count($location['actions']) > 0)
            <div class="card">
                <h2 class="card-title">Aksi Penanganan</h2>
                <ul class="action-list">
                    @foreach($location['actions'] as $index => $action)
                    <li class="action-item">
                        <span class="action-number">{{ $index + 1 }}.</span>
                        <span>{{ $action }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            @endif

            {{-- Spesies (Vegetasi dan Fauna) --}}
            @if(isset($location['species_detail']))
            <div class="card">
                <button class="accordion-header" onclick="toggleAccordion('species')">
                    <h2 class="card-title" style="margin: 0;">Spesies (Vegetasi dan Fauna)</h2>
                    <svg class="accordion-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="accordion-content" id="accordion-species">
                    @if(isset($location['species_detail']['vegetasi']))
                    <div class="species-section">
                        <h3 class="species-subtitle">Vegetasi:</h3>
                        <ul class="species-list">
                            @foreach($location['species_detail']['vegetasi'] as $veg)
                            <li>{{ $veg }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(isset($location['species_detail']['fauna']))
                    <div class="species-section">
                        <h3 class="species-subtitle">Fauna:</h3>
                        <ul class="species-list">
                            @foreach($location['species_detail']['fauna'] as $fauna)
                            <li>{{ $fauna }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Aktivitas Sekitar --}}
            @if(isset($location['activities']))
            <div class="card">
                <button class="accordion-header" onclick="toggleAccordion('activities')">
                    <h2 class="card-title" style="margin: 0;">Aktivitas Sekitar</h2>
                    <svg class="accordion-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="accordion-content" id="accordion-activities">
                    <p class="activity-description">{{ $location['activities']['description'] }}</p>
                    <ul class="activity-list">
                        @foreach($location['activities']['items'] as $activity)
                        <li>{{ $activity }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- Pemanfaatan Hutan --}}
            @if(isset($location['forest_utilization']))
            <div class="card">
                <button class="accordion-header" onclick="toggleAccordion('utilization')">
                    <h2 class="card-title" style="margin: 0;">Pemanfaatan Hutan</h2>
                    <svg class="accordion-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="accordion-content" id="accordion-utilization">
                    <ul class="utilization-list">
                        @foreach($location['forest_utilization'] as $util)
                        <li>{{ $util }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- Program yang Dilaksanakan --}}
            @if(isset($location['programs']))
            <div class="card">
                <button class="accordion-header" onclick="toggleAccordion('programs')">
                    <h2 class="card-title" style="margin: 0;">Program yang Dilaksanakan</h2>
                    <svg class="accordion-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="accordion-content" id="accordion-programs">
                    <ul class="program-list">
                        @foreach($location['programs'] as $program)
                        <li>{{ $program }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- Pihak Terkait --}}
            @if(isset($location['stakeholders']))
            <div class="card">
                <button class="accordion-header" onclick="toggleAccordion('stakeholders')">
                    <h2 class="card-title" style="margin: 0;">Pihak Terkait</h2>
                    <svg class="accordion-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="accordion-content" id="accordion-stakeholders">
                    <ul class="stakeholder-list">
                        @foreach($location['stakeholders'] as $stakeholder)
                        <li>{{ $stakeholder }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

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

@endpush
