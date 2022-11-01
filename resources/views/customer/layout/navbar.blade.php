@php
    $cust = DB::table('customers')->select()->where('username', Session::get('active'))->first()
@endphp
<nav class="bg-white shadow-lg border-gray-200 px-2 sm:px-4 py-2.5 fixed w-full z-20 top-0 left-0 h-14">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="{{ route('customer-index') }}" class="flex items-center">
            <img src="{{ asset('img/logo.png') }}" class="mr-3 h-6 sm:h-9" alt="cBay Logo">
        </a>
        <div class="flex items-center md:order-2 gap-4">
            <span class="block">
                <a href="{{ route('customer-cart') }}" class="focus:outline-none text-white bg-persian-green-std hover:bg-persian-green-hov focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-0.5 mb-2">Cart</a>
            </span>
            <button type="button" class="flex mr-3 text-sm bg-gray-400 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 " id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://source.unsplash.com/100x100" alt="user photo">
            </button>
            <span class="text-sm text-gray-900 block">Saldo : {{ $cust->saldo }}</span>
            <!-- Dropdown menu -->
            <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow" id="user-dropdown" style="position: absolute; inset: 0px auto auto -10px; margin: 0px;" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            {{-- <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow" id="user-dropdown" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 10px, 0px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"> --}}
                <div class="py-3 px-4">
                    <span class="block text-sm text-gray-900 ">
                        {{ $cust->name }}
                    </span>
                    <span class="block text-sm font-medium text-gray-500 truncate ">
                        {{ $cust->username }}
                    </span>
                </div>
                <ul class="py-1" aria-labelledby="user-menu-button">
                    <li>
                        <a href="{{ route('customer-index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 ">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('customer-profile') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 ">Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('customer-history') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 ">History</a>
                    </li>
                    <li>
                        <a href="{{ route('customer-topup-saldo') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 ">Isi Saldo</a>
                    </li>
                    <li>
                        <a href="{{ route('customer-favorite') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 ">List Favorite Toko</a>
                    </li>
                    <li class="border-t border-gray-300">
                        <a href="{{ route('logout') }}" class="block py-2 px-4 text-sm text-red-600 hover:bg-gray-100 ">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
