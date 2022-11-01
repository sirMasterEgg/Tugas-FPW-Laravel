@extends('layout.maintemplate')
@section('content')
    <div class="flex flex-row">
        @include('toko.layout.sidebar')
        <div class="container w-5/6 p-10">
        {{-- <div class="container w-[calc(100%-18rem)] p-10"> --}}
            <div class="w-full">


                <form action="{{ route('toko-doAddItem') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="namabarang" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Barang</label>
                        <input type="text" id="namabarang" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Barang" name="nama_barang">
                        @error('nama_barang')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" {{ Session::has('error') ? 'mb-2' : 'mb-6' }}">
                        <label for="hargabarang" class="block mb-2 text-sm font-medium text-gray-900 ">Harga</label>
                        <input type="text" id="hargabarang" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Harga" name="harga_barang">
                        @error('harga_barang')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" {{ Session::has('error') ? 'mb-2' : 'mb-6' }}">
                        <label for="stokbarang" class="block mb-2 text-sm font-medium text-gray-900 ">Harga</label>
                        <input type="text" id="stokbarang" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Stok" name="stok_barang">
                        @error('stok_barang')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(Session::has('error'))
                        <p class="mb-4 text-sm text-red-600 dark:text-red-500">{{ Session::get('error') }}</p>
                    @endif
                    <button type="submit" class="text-white bg-persian-green-std hover:bg-persian-green-hov focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Item</button>
                </form>


            </div>
        </div>
    </div>
@endsection
