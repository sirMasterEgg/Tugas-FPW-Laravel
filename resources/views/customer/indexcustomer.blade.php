@extends('layout.maintemplate')
@section('content')
    <div class="flex justify-center">
    @include('customer.layout.navbar')
        <div class="container mt-14 py-10">

            <form method="GET">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="query" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search">
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-persian-green-std hover:bg-persian-green-hov focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
                </div>
            </form>

            @if(Session::has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ Session::get('error') }}</span>
                </div>
            @endif

            <div class="flex flex-wrap gap-5">
                @foreach ($data as $value)
                <div class="flex flex-wrap mt-4">
                    <div class="p-6 w-64 h-64 bg-white rounded-lg border border-gray-200 shadow-md">
                        <div class="h-3/4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $value->name }}</h5>
                        </div>
                        <a href="{{ route('customer-details', $value->username) }}" class="inline-flex cursor-pointer items-center py-2 px-3 text-sm font-medium text-center text-white bg-persian-green-std rounded-lg hover:bg-persian-green-hov focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                            Details
                        </a>
                        <a href="{{ route('customer-add-favorite', $value->username) }}" class="inline-flex cursor-pointer items-center py-2 px-3 text-sm font-medium text-center text-black bg-maize-crayola-std rounded-lg hover:bg-maize-crayola-hov focus:ring-4 focus:outline-none focus:ring-blue-300 ">

                            @if(DB::table('favorite_stores')->select()->where('username_customer', Session::get('active'))->where('username_store', $value->username)->first())
                            Remove Favorite
                            @else
                            Add to favorite
                            @endif
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

