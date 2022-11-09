@extends('layout.maintemplate')
@section('content')
    <div class="flex justify-center">
        @include('customer.layout.navbar')
        <div class="container mt-14 py-10">

            <h1 class="mb-5 text-2xl font-bold tracking-tight text-gray-900">{{ $toko->name }}</h1>

            <a href="{{ route('customer-details', $toko->username) }}"><button class="focus:outline-none text-white bg-sandy-brown-std hover:bg-sandy-brown-hov focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Back</button></a>

            <h1>Nama Barang : {{ $barang->nama_barang }}</h1>
            <h2>Harga Barang : {{ $barang->harga_barang }}</h2>
            <h3>Stok Barang : {{ $barang->stok_barang }}</h3>
            @php
                $total = 0;
            @endphp
            @foreach ($terjual as $row)
                @php
                    $total += (int) $row->pivot->jumlah_barang
                @endphp
            @endforeach
            <h4>Terjual : {{ $total }}</h4>

            @php
                $total_reviews = 0;
                foreach ($reviews as $key => $value) {
                    $total_reviews += $value->pivot->rating;
                }
                $avg = $total_reviews / count($reviews);
            @endphp

            <h4 class="font-bold">Rating : {{ $avg }}</h4>

            <h1 class="my-5 text-xl font-bold tracking-tight text-gray-900">Post a review</h1>
            <form method="POST" action="{{ route('customer-add-review-barang', [$toko->username, $barang->kode_barang]) }}">
                @csrf
                <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Rating</label>
                <input type="number" name="rating" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="1-5" min="1" max="5">
                </div>
                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Review</label>
                    <textarea name="review" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Review"></textarea>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
            </form>
            @error('rating')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror
            @if(Session::has('error'))
                <p class="text-red-500">
                    {{ Session::get('error') }}
                </p>
            @endif
            @if(Session::has('success'))
                <p class="text-green-500">
                    {{ Session::get('success') }}
                </p>
            @endif

            <h1 class="my-5 text-xl font-bold tracking-tight text-gray-900">List review</h1>

            @foreach ($reviews as $review)
                <p class="border border-b-black">
                    Rating: {{ $review->pivot->rating }} <br>
                    Review: {{ $review->pivot->review }} <br>
                    Nama : {{ $review->name }} <br>
                    {{ Carbon\Carbon::parse($review->pivot->created_at)->diffForHumans() }}
                </p>
            @endforeach
        </div>
    </div>
@endsection
