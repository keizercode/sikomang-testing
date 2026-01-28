@extends('layouts.app')

@section('title', 'SIKOMANG - Sistem Informasi dan Komunikasi Mangrove DKI Jakarta')

@section('content')
    {{-- Hero Section --}}
    <section class="py-12 md:py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">
                {{-- Left Content --}}
                <div>
                    <p class="text-sm md:text-base mb-2 text-muted">Dinas Lingkungan Hidup DKI Jakarta</p>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 text-secondary">Sistem Informasi dan Komunikasi Mangrove DKI Jakarta</h1>
                </div>

                {{-- Right Content --}}
                <div class="lg:text-left flex flex-col items-start lg:items-end">
                    <p class="text-sm md:text-base mb-6 max-w-md" style="color: #4c5250;">
                        Sikomang hadir sebagai platform pemantauan dan strategi pengendalian kerusakan ekosistem mangrove di DKI Jakarta.
                    </p>

                    {{-- Button Group --}}
                    <div class="flex flex-wrap gap-3">
                        {{-- Button SIKOMANG --}}
                        <a
                            href="{{ route('monitoring') }}"
                            class="inline-flex items-center space-x-2 text-white px-6 py-3 rounded-lg font-semibold transition-all"
                            style="background-color: #009966;"
                            onmouseover="this.style.backgroundColor='#2d5c54'"
                            onmouseout="this.style.backgroundColor='#009966'"
                        >
                            <span>SIKOMANG</span>
                            {{-- Globe Icon --}}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zM3 12h18M12 3c3 4 3 14 0 18M12 3c-3 4-3 14 0 18"/>
                            </svg>
                        </a>

                        {{-- Button Pelajari Lebih Lanjut --}}
                        <button
                        type="button"
                        onclick="openModal()"
                        class="cursor-pointer inline-flex items-center space-x-2 border border-gray-300 text-secondary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all"
                    >
                        <span>Pelajari lebih lanjut</span>
                        {{-- Info Icon --}}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                        </svg>
                    </button>
                    </div>
                </div>
            </div>

            {{-- Hero Images Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-10">
                {{-- Image 1 --}}
                <div class="rounded-2xl overflow-hidden h-64 md:h-80">
                    <img
                        src="https://ext.same-assets.com/1105228812/3696522300.png"
                        alt="Akar Mangrove"
                        class="w-full h-full object-cover"
                    >
                </div>

                {{-- Image 2 --}}
                <div class="rounded-2xl overflow-hidden h-64 md:h-80">
                    <img
                        src="https://ext.same-assets.com/1105228812/3198143648.jpeg"
                        alt="Hutan Mangrove"
                        class="w-full h-full object-cover"
                    >
                </div>

                {{-- Quote Card --}}
                <div class="hero-gradient relative rounded-2xl p-6 md:p-8 h-64 md:h-80 flex flex-col justify-between">
                    {{-- Quote Icon --}}
                    <div class="absolute top-6 left-8 w-6 h-4">
                        <svg class="w-full h-full" fill="none" viewBox="0 0 24 15" preserveAspectRatio="xMidYMid meet">
                            <path d="M3.47266 8.14844L1.66797 14.6016H7.4375L10.2266 7.90234V0H0V8.14844H3.47266Z" fill="#EAFF00"/>
                            <path d="M14.8945 14.6016L16.6992 8.14844H13.2266V0H23.4531V7.90234L20.6641 14.6016H14.8945Z" fill="white"/>
                        </svg>
                    </div>

                    <div class="pt-6">
                        <p class="text-white text-sm md:text-base leading-relaxed">
                            Meningkatkan Ketahanan Masyarakat dan Keberlanjutan Lingkungan Pesisir melalui Pengendalian Kerusakan Mangrove
                        </p>
                    </div>

                    {{-- Mangrove Icon --}}
                    <div class="flex justify-start">
                    <svg class="w-16 h-16 text-white/30" viewBox="0 0 80 80" fill="none" preserveAspectRatio="none" viewBox="0 0 92 92"><g id="lucide/sprout"><path d="M53.6667 36.5547V26.8333C53.6667 22.7667 55.2821 18.8666 58.1577 15.991C61.0333 13.1155 64.9333 11.5 69 11.5H74.75C75.2583 11.5 75.7458 11.7019 76.1053 12.0614C76.4647 12.4208 76.6667 12.9083 76.6667 13.4167V19.1667C76.6667 23.2333 75.0512 27.1334 72.1756 30.009C69.3001 32.8845 65.4 34.5 61.3333 34.5C57.2667 34.5 53.3666 36.1155 50.491 38.991C47.6155 41.8666 46 45.7667 46 49.8333M46 49.8333C46 57.5 49.8333 61.3333 49.8333 69C49.8333 73.1471 48.4883 77.1823 46 80.5M46 49.8333C46 46.2739 45.0088 42.7847 43.1375 39.7568C41.2661 36.7289 38.5886 34.282 35.4049 32.6901C32.2212 31.0983 28.6572 30.4245 25.1121 30.7441C21.567 31.0638 18.1809 32.3643 15.3333 34.5C15.3333 38.0595 16.3245 41.5486 18.1959 44.5765C20.0672 47.6044 22.7447 50.0513 25.9284 51.6432C29.1121 53.235 32.6762 53.9089 36.2213 53.5892C39.7664 53.2696 43.1524 51.969 46 49.8333ZM19.1667 80.5H72.8333" id="Vector" stroke="var(--stroke-0, white)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></g></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Articles Section --}}
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="mb-8 md:mb-12">
                <p class="text-sm mb-1" style="color: #4c5250;">Postingan</p>
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold" style="color: #242621;">Artikel Terkini</h2>
            </div>

            {{-- Articles Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                {{-- Article 1 --}}
                <x-article-card
                    image="https://ext.same-assets.com/1105228812/2230853859.png"
                    date="6 Januari 2026"
                    author="Admin, DLH Jakarta"
                    title="Peran Vital Mangrove dalam Pertahanan Pesisir Jakarta"
                    excerpt="Temukan bagaimana hutan mangrove di Jakarta menjaga wilayah pesisir dari erosi dan gelombang besar, mendukung keanekaragaman hayati, dan menopang kehidupan masyarakat lokal."
                    link="#"
                />

                {{-- Article 2 --}}
                <x-article-card
                    image="https://ext.same-assets.com/1105228812/2230853859.png"
                    date="5 Januari 2026"
                    author="Admin, DLH Jakarta"
                    title="Revolusi Energi Terbarukan: Solusi untuk Masa Depan"
                    excerpt="Jelajahi bagaimana energi terbarukan dapat mengubah lanskap energi global dan mengurangi ketergantungan pada bahan bakar fosil, serta dampaknya terhadap perubahan iklim."
                    link="#"
                />

                {{-- Article 3 --}}
                <x-article-card
                    image="https://ext.same-assets.com/1105228812/2708995451.jpeg"
                    date="5 Januari 2026"
                    author="Admin, DLH Jakarta"
                    title="Menghidupkan Tradisi: Festival Budaya Betawi"
                    excerpt="Saksikan keindahan dan kekayaan budaya Betawi melalui festival tahunan yang menampilkan seni, kuliner, dan tradisi yang telah diwariskan dari generasi ke generasi."
                    link="#"
                />
            </div>

            {{-- View All Button --}}
            <div class="text-center mt-10">
                <a
                    href="{{ route('articles.index') ?? '#' }}"
                    class="inline-flex items-center space-x-2 border-2 px-6 py-3 rounded-lg font-semibold transition-all"
                    style="border-color: #009966; color: #009966;"
                    onmouseover="this.style.backgroundColor='#009966'; this.style.color='white';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='#009966';"
                >
                    <span>Lihat Semua Artikel</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Modal Tentang Sikomang --}}
    <div id="aboutModal" class="fixed inset-0 z-50 hidden">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>

        {{-- Modal Content --}}
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative animate-modal">
                {{-- Modal Header --}}
                <div class="flex items-center justify-between p-6 pb-4">
                    <h2 class="text-2xl md:text-3xl font-bold" style="color: #242621;">Tentang Sikomang</h2>
                    <button
                        type="button"
                        onclick="closeModal()"
                        class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:bg-gray-100 transition-all"
                    >
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="px-6 pb-6">
                    <p class="text-gray-700 leading-relaxed mb-6">
                        Sikomang (Sistem Informasi dan Komunikasi Mangrove DKI Jakarta) adalah platform resmi dari Dinas Lingkungan Hidup DKI Jakarta yang dikembangkan untuk:
                    </p>

                    <ul class="space-y-4 mb-6">
                        <li class="flex items-start space-x-3">
                            <span class="text-xl">📊</span>
                            <span class="text-gray-700">Memantau kondisi ekosistem mangrove di wilayah pesisir DKI Jakarta.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-xl">🌱</span>
                            <span class="text-gray-700">Mendukung konservasi dan rehabilitasi hutan mangrove.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-xl">👥</span>
                            <span class="text-gray-700">Menghubungkan masyarakat, komunitas, dan pemerintah dalam menjaga keberlanjutan lingkungan pesisir.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-xl">🎯</span>
                            <span class="text-gray-700">Menyediakan edukasi dan informasi terkini mengenai mangrove serta dampaknya terhadap ketahanan lingkungan.</span>
                        </li>
                    </ul>

                    <p class="text-gray-700 leading-relaxed">
                        Dengan adanya Sikomang, diharapkan masyarakat dapat lebih mudah berpartisipasi dalam perlindungan dan pengendalian kerusakan ekosistem mangrove.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .animate-modal {
        animation: modalFadeIn 0.2s ease-out forwards;
    }
</style>
@endpush

@push('scripts')
<script>
    function openModal() {
        const modal = document.getElementById('aboutModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('aboutModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush
