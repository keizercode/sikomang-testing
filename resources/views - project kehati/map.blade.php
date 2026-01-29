@extends('layouts.layoutMain')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endsection
@section('content')
<div class="md:w-[75%] px-5">
    <div class="p-5 w-full shadow-md rounded-[10px] bg-[#fff]">
         <div id="map"></div>
    </div>
</div>
@endsection
@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            // ===== Inisialisasi peta =====
            const defaultLat = -6.200000;
            const defaultLng = 106.816666;
            const defaultZoom = 12;

            const map = L.map('map').setView([defaultLat, defaultLng], defaultZoom);

            // Tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Marker (dapat digerakkan)
            let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

            // Element input
            const latInput = document.getElementById('latInput');
            const lngInput = document.getElementById('lngInput');
            const btnUseLocation = document.getElementById('btnUseLocation');
            const btnClear = document.getElementById('btnClear');

            // Fungsi format untuk menampilkan lat/lng (6 desimal)
            function fmt(n) {
            return Number(n).toFixed(6);
            }

            // Set input berdasarkan koordinat
            function setInputs(lat, lng) {
            latInput.value = fmt(lat);
            lngInput.value = fmt(lng);
            }

            // Ketika klik di map => pindah marker & isi input
            map.addEventListener('click', function(e) {
            const { lat, lng } = e.latlng;
            marker.setLatLng([lat, lng]);
            setInputs(lat, lng);
            });

            // Ketika marker di-drag selesai => update input
            marker.addEventListener('moveend', function(e) {
                const pos = e.target.getLatLng();
                setInputs(pos.lat, pos.lng);
            });


            // Tombol: gunakan lokasi (geolocation)
            btnUseLocation.addEventListener('click', function() {
            if (!navigator.geolocation) {
                alert('Geolocation tidak didukung oleh browser ini.');
                return;
            }

            btnUseLocation.disabled = true;
            btnUseLocation.textContent = 'Mencari lokasi...';

            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                map.setView([lat, lng], 15);
                marker.setLatLng([lat, lng]);
                setInputs(lat, lng);
                btnUseLocation.disabled = false;
                btnUseLocation.textContent = 'Gunakan Lokasi Saya';
            }, function(err) {
                alert('Gagal mendapatkan lokasi: ' + err.message);
                btnUseLocation.disabled = false;
                btnUseLocation.textContent = 'Gunakan Lokasi Saya';
            }, {
                enableHighAccuracy: true,
                timeout: 10000
            });
            });

            // Tombol reset: pindah kembali ke default dan clear input
            btnClear.addEventListener('click', function() {
                map.setView([defaultLat, defaultLng], defaultZoom);
                marker.setLatLng([defaultLat, defaultLng]);
                latInput.value = '';
                lngInput.value = '';
            });

            // Inisialisasi input awal (kosong)
            latInput.value = '';
            lngInput.value = '';

            // Opsional: jika mau isi input dengan koordinat awal marker:
            // setInputs(defaultLat, defaultLng);
        </script>
@endsection