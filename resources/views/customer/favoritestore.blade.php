@extends('layout.maintemplate')
@section('content')
    <div class="flex justify-center">
    @include('customer.layout.navbar')
        <div class="container mt-14 py-10">

            <h1 class="text-2xl font-bold mb-5">List Toko Favorites</h1>


            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200  ">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Nama Toko
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value)
                        <tr class="bg-white border-b  ">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $value->name }}
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection

