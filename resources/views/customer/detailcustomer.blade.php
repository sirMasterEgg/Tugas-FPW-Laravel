@extends('layout.maintemplate')
@section('content')
    <div class="flex justify-center">
        @include('customer.layout.navbar')
        <div class="container mt-14 py-10">

            <h1 class="mb-5 text-2xl font-bold tracking-tight text-gray-900">{{ $namatoko->name }}</h1>

            <div class="flex mb-5 gap-4 flex-wrap">
                @foreach ($posts as $item)
                <div class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100   ">
                    <p class="font-normal text-gray-700 ">{{ $item->content }}</p>
                    <span class="text-xs">{{ $item->created_at }}</span>
                </div>
                @endforeach
            </div>


            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Product
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Qty
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Price
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd(Session::get('data')) --}}

                        @foreach ($nama as $key => $item)
                        <form action="{{ route('customer-add-cart') }}" method="POST">
                            @csrf
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <td class="py-4 px-6 font-semibold text-gray-900 ">
                                    <a href="{{ route('customer-details-barang',[$item->username_store, $item->kode_barang]) }}">
                                        {{ $item->nama_barang }}
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <input type="hidden" name="toko" value="{{ $item->username_store }}">
                                            <input type="number" id="first_product" class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1" value="0" name="jumlah" min="0">
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-semibold text-gray-900 ">
                                    {{ $item->harga_barang }}
                                </td>
                                <td class="py-4 px-6">
                                    <button class="font-medium text-blue-500  hover:underline" name="kode_barang" value="{{ $item->kode_barang }}" type="submit">Add to cart</button>
                                </td>
                            </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
