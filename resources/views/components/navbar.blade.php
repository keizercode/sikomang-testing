<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img
                    src="https://pencil-matter-70015947.figma.site/_assets/v11/e6fb723ab1735b08498a0a60cab1e81508afa7e6.png"
                    alt="SIKOMANG Logo"
                    class="h-10 w-10 md:h-12 md:w-12"
                >

                {{-- Vertical Divider --}}
                <div class="h-12 w-px bg-gray-300"></div>

                {{-- Text --}}
                <div class="hidden sm:block">
                    <h1 class="text-base md:text-lg font-bold text-navbar leading-tight">SIKOMANG</h1>
                    <p class="text-[10px] md:text-xs text-muted leading-tight">
                        Sistem Informasi dan Komunikasi<br>Mangrove DKI Jakarta
                    </p>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            @if (!($hideNavbarMenu ?? false))
            <div class="hidden md:flex items-center space-x-6 lg:space-x-8">
                {{-- <a href="{{ route('marketplace') ?? '#' }}" class="nav-link flex items-center space-x-2 text-secondary hover:text-primary transition-colors"> --}}
                <a href="{{ '#' }}" class="nav-link flex items-center space-x-2 text-secondary hover:text-primary transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.3333 8.33333C13.3333 9.21739 12.9821 10.0652 12.357 10.6904C11.7319 11.3155 10.8841 11.6667 10 11.6667C9.11595 11.6667 8.2681 11.3155 7.64298 10.6904C7.01786 10.0652 6.66667 9.21739 6.66667 8.33333M2.58583 5.02833H17.4142M2.83333 4.55583C2.61696 4.84433 2.5 5.19522 2.5 5.55583V16.6667C2.5 17.1087 2.67559 17.5326 2.98816 17.8452C3.30072 18.1577 3.72464 18.3333 4.16667 18.3333H15.8333C16.2754 18.3333 16.6993 18.1577 17.0118 17.8452C17.3244 17.5326 17.5 17.1087 17.5 16.6667V5.55583C17.5 5.19522 17.383 4.84433 17.1667 4.55583L15.5 2.33333C15.3448 2.12634 15.1434 1.95833 14.912 1.84262C14.6806 1.72691 14.4254 1.66667 14.1667 1.66667H5.83333C5.57459 1.66667 5.3194 1.72691 5.08798 1.84262C4.85655 1.95833 4.65525 2.12634 4.5 2.33333L2.83333 4.55583Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-medium text-sm">Marketplace</span>
                </a>

                {{-- <a href="{{ route('komunitas') ?? '#' }}" class="nav-link flex items-center space-x-2 text-secondary hover:text-primary transition-colors"> --}}
                <a href="{{ '#' }}" class="nav-link flex items-center space-x-2 text-secondary hover:text-primary transition-colors">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-medium text-sm">Komunitas</span>
                </a>

                {{-- <a href="{{ route('edukasi') ?? '#' }}" class="nav-link flex items-center space-x-2 text-secondary hover:text-primary transition-colors"> --}}
                <a href="{{ '#' }}" class="nav-link flex items-center space-x-2 text-secondary hover:text-primary transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 3H8C9.06087 3 10.0783 3.42143 10.8284 4.17157C11.5786 4.92172 12 5.93913 12 7V21C12 20.2044 11.6839 19.4413 11.1213 18.8787C10.5587 18.3161 9.79565 18 9 18H2V3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 3H16C14.9391 3 13.9217 3.42143 13.1716 4.17157C12.4214 4.92172 12 5.93913 12 7V21C12 20.2044 12.3161 19.4413 12.8787 18.8787C13.4413 18.3161 14.2044 18 15 18H22V3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-medium text-sm">Edukasi</span>
                </a>
            </div>
            @endif

            {{-- Mobile Menu Button --}}
            <button type="button" class="md:hidden p-2 rounded-lg hover:bg-gray-100" id="mobile-menu-btn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Navigation --}}
        <div class="md:hidden hidden pb-4" id="mobile-menu">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('marketplace') ?? '#' }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-gray-500" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.3333 8.33333C13.3333 9.21739 12.9821 10.0652 12.357 10.6904C11.7319 11.3155 10.8841 11.6667 10 11.6667C9.11595 11.6667 8.2681 11.3155 7.64298 10.6904C7.01786 10.0652 6.66667 9.21739 6.66667 8.33333M2.58583 5.02833H17.4142M2.83333 4.55583C2.61696 4.84433 2.5 5.19522 2.5 5.55583V16.6667C2.5 17.1087 2.67559 17.5326 2.98816 17.8452C3.30072 18.1577 3.72464 18.3333 4.16667 18.3333H15.8333C16.2754 18.3333 16.6993 18.1577 17.0118 17.8452C17.3244 17.5326 17.5 17.1087 17.5 16.6667V5.55583C17.5 5.19522 17.383 4.84433 17.1667 4.55583L15.5 2.33333C15.3448 2.12634 15.1434 1.95833 14.912 1.84262C14.6806 1.72691 14.4254 1.66667 14.1667 1.66667H5.83333C5.57459 1.66667 5.3194 1.72691 5.08798 1.84262C4.85655 1.95833 4.65525 2.12634 4.5 2.33333L2.83333 4.55583Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-medium text-sm text-secondary">Marketplace</span>
                </a>
                <a href="{{ route('komunitas') ?? '#' }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-medium text-sm text-secondary">Komunitas</span>
                </a>
                <a href="{{ route('edukasi') ?? '#' }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 3H8C9.06087 3 10.0783 3.42143 10.8284 4.17157C11.5786 4.92172 12 5.93913 12 7V21C12 20.2044 11.6839 19.4413 11.1213 18.8787C10.5587 18.3161 9.79565 18 9 18H2V3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 3H16C14.9391 3 13.9217 3.42143 13.1716 4.17157C12.4214 4.92172 12 5.93913 12 7V21C12 20.2044 12.3161 19.4413 12.8787 18.8787C13.4413 18.3161 14.2044 18 15 18H22V3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-medium text-sm text-secondary">Edukasi</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
        document.getElementById('mobile-menu')?.classList.toggle('hidden');
    });
</script>
