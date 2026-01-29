@extends('layouts.front')
@section('content')
<section class="relative overflow-hidden p-10  md:px-20">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-white">
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
            <div class="blob blob-1 absolute top-[10%] right-[15%] w-[40vw] h-[40vw] rounded-full mix-blend-multiply filter blur-[80px] animate-blob-slow opacity-15 bg-gradient-to-br from-green-300 to-emerald-400"></div>
            <div class="blob blob-2 absolute bottom-[5%] left-[20%] w-[35vw] h-[35vw] rounded-full mix-blend-multiply filter blur-[80px] animate-blob-slow opacity-15 bg-gradient-to-br from-green-300 to-emerald-400"></div>
            <div class="blob blob-3 absolute top-[30%] left-[10%] w-[30vw] h-[30vw] rounded-full mix-blend-multiply filter blur-[80px] animate-blob-slow opacity-15 bg-gradient-to-br from-green-300 to-emerald-400"></div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-3/5 z-10 relative justify-center flex flex-col gap-6">
            <h4 class="">Dinas Lingkungan Hidup Provinsi DKI Jakarta</h4>
            <h4 class="text-[45px] poppins-black text-[#197B30]">Sistem Informasi <br />Keanekaragaman Hayati</h4>
            <p class="">
                Kehati hadir sebagai platform sumber informasi Flora dan Fauna di 
                Wilayah Provinsi DKI Jakarta
            </p>
            <div class="mt-2">
                <a href="persebaran/lokasi" class="px-4 py-3 text-sm bg-[#197B30] text-white rounded-full">Lihat Selengkapnya</a>
            </div>
        </div>
        <div class="flex items-center w-3/5 relative z-100 flex md:block hidden">
            <img src="{{ asset('assets/images/tree2.png') }}" width="90%">
        </div>
    </div>
</section>
@endsection