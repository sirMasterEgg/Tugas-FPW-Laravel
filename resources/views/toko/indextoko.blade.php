@extends('layout.maintemplate')
@section('content')
    <div class="flex flex-row">
        @include('toko.layout.sidebar')
        <div class="container w-5/6 p-10">
        {{-- <div class="container w-[calc(100%-18rem)] p-10"> --}}
            Ini dasboard toko
        </div>
    </div>
@endsection
