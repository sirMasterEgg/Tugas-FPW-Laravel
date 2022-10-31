@extends('layout.maintemplate')
@section('content')
    <div class="flex justify-center">
        @include('customer.layout.navbar')
        <div class="container mt-14 py-10">

            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Product name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Store name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Time
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Qty
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Session::get('history')??[] as $key => $value)
                            @foreach ($value['cart'] as $value1)

                                    <tr class="bg-white border-b hover:bg-gray-50 ">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $value1['cart_item']['item_name'] }}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $value1['cart_toko'] }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $value['time'] }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $value1['cart_item']['item_quantity'] }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $value1['cart_item']['item_price'] * $value1['cart_item']['item_quantity'] }}
                                        </td>
                                    </tr>

                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
