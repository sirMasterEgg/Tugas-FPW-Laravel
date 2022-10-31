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
                                Qty
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Price
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Subtotal
                            </th>
                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach (Session::get('cart')??[] as $key => $value)
                        @php
                            $total += $value['cart_item']['item_price'] * $value['cart_item']['item_quantity'];
                        @endphp
                        <form action="{{ route('customer-remove-cart') }}" method="post">
                            @csrf
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $value['cart_item']['item_name'] }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ $value['cart_item']['item_quantity'] }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $value['cart_item']['item_price'] }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $value['cart_item']['item_price'] * $value['cart_item']['item_quantity'] }}
                                </td>
                                <input type="hidden" name="index" value="{{ $key }}">
                                <td class="py-4 px-6 text-right">
                                    <button type="submit" class="font-medium text-red-600  hover:underline">Remove</button>
                                </td>
                            </tr>
                        </form>
                        @endforeach
                        <tr>
                            <td class="py-4 px-6">
                                <h1 class="font-bold text-black text-lg">Total : {{ $total }}</h1>
                            </td>
                            <td colspan="3">
                                <form action="{{ route('customer-checkout-cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="total" value="{{ $total }}">
                                    <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Checkout</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if(Session::has('error'))
            <span class="text-sm text-red-500">{{ Session::get('error') }}</span>
            @endif
        </div>
    </div>
@endsection
