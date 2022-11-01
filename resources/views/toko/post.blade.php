@extends('layout.maintemplate')
@section('content')
    <div class="flex flex-row">
        @include('toko.layout.sidebar')
        <div class="container w-5/6 p-10">

            <form action="{{ route('toko-doPost') }}" class="mb-5" method="post">
                @csrf
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 ">Your message</label>
                <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500      " name="message" placeholder="Your message..."></textarea>
                <button type="submit" class="mt-5 text-white bg-persian-green-std hover:bg-persian-green-hov focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2   ">Post</button>
            </form>


            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Post
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Timestamp
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr class="bg-white border-b  ">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-normal max-w-xl">
                                {{ $item->content }}
                            </th>
                            <td class="py-4 px-6">
                                {{ $item->created_at }}
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('toko-doHapusPost', $item->id) }}" class="font-medium text-red-600  hover:underline">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
