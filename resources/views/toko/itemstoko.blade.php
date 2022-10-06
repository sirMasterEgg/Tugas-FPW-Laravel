@extends('layout.maintemplate')
@section('content')
    <div class="flex flex-row">
        @include('toko.layout.sidebar')
        <div class="container w-5/6 p-10">
        {{-- <div class="container w-[calc(100%-18rem)] p-10"> --}}

            <div class="w-full">

                <div class="mb-6">
                    <a href="{{ route('toko-addItem') }}" class="text-white bg-persian-green-std hover:bg-persian-green-hov focus:ring-1 focus:ring-charcoal-std font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none ">Tambah Barang</a>
                </div>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Kode Barang
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Nama Barang
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Harga Barang
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Jumlah Terjual
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Session::get('active')['items']??[] as $i => $item)
                                @if ($i % 2 == 0)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $item['kode_barang'] }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $item['nama_barang'] }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $item['harga_barang'] }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $item['jumlah_terjual'] }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('toko-doDeleteItem', $item['kode_barang']) }}" class="font-medium text-red-600  hover:underline">Delete</a>
                                    </td>
                                </tr>
                                @else
                                <tr class="bg-gray-50 border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $item['kode_barang'] }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $item['nama_barang'] }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $item['harga_barang'] }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $item['jumlah_terjual'] }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('toko-doDeleteItem', $item['kode_barang']) }}" class="font-medium text-red-600  hover:underline">Delete</a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if(Session::has('success'))
                <div id="toast-success" class="flex items-center p-4 mb-4 mr-4 w-full max-w-xs text-gray-500 bg-gray-50 rounded-lg shadow bottom-0 right-0 absolute" role="alert">
                    <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg  ">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Check icon</span>
                    </div>
                    <div class="ml-3 text-sm font-normal">{{ Session::get('success') }}</div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8    " data-dismiss-target="#toast-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                @endif

            </div>

        </div>
    </div>
@endsection
