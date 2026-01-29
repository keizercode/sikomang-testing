    <div class="flex md:w-[25%] p-5 flex-col gap-3 mb-5">
        <a href="{{ url('persebaran/flora') }}" class="bg-success-light p-5 rounded-[10px] shadow-md flex justify-between items-center">
            <div class="flex flex-col gap-3">
                <span class="text-gray-500 text-[12px]">Persebaran Flora</span>
                <span class="text-4xl poppins-bold text-success">520</span>
            </div>
            <div>
                <img src="{{asset('assets/images/leaf.svg')}}" alt="" width="55">
            </div>
        </a>
        <a href="{{ url('persebaran/fauna') }}" class="p-5 rounded-[10px] shadow-md flex justify-between items-center">
            <div class="flex flex-col gap-3">
                <span class="text-gray-500 text-[12px]">Persebaran Fauna</span>
                <span class="text-4xl poppins-bold text-success">520</span>
            </div>
            <div>
                <img src="{{asset('assets/images/pet.svg')}}" alt="" width="55">
            </div>
        </a>
        <a href="{{ url('persebaran/lokasi') }}" class="p-5 rounded-[10px] shadow-md flex justify-between items-center">
            <div class="flex flex-col gap-3">
                <span class="text-gray-500 text-[12px]">Persebaran Lokasi</span>
                <span class="text-4xl poppins-bold text-success">520</span>
            </div>
            <div>
                <img src="{{asset('assets/images/map.svg')}}" alt="" width="55">
            </div>
        </a>
        <hr class="border-gray-300">
        <div class="mt-5">
            <div class="flex gap-3">
                <img src="{{asset('assets/images/globe-leaf')}}.svg" alt="" width="25">
                <span class="poppins-semibold">Status Flora & Fauna</span>
            </div>
            <div class="flex flex-col gap-3 mt-5">
                <div class="p-2 bg-success-light rounded-[10px] flex justify-between text-[11px] poppins-semibold text-success items-center">
                    <span>Dilindungi</span>
                    <span>1.520</span>
                </div>
                <div class="p-2 bg-primary-light rounded-[10px] flex justify-between text-[11px] poppins-semibold text-primary items-center">
                    <span>Tidak Dilindungi</span>
                    <span>1.520</span>
                </div>
                <div class="p-2 bg-danger-light rounded-[10px] flex justify-between text-[11px] poppins-semibold text-danger items-center">
                    <span>Terancam Punah</span>
                    <span>1.520</span>
                </div>
            </div>
        </div>
    </div>

