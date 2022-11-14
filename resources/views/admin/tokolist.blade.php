@extends('layout.maintemplate')

@section('content')
    <div class="flex flex-row">
        @include('admin.layout.sidebar')
        <div class="container w-5/6 p-10">
        {{-- <div class="container w-[calc(100%-18rem)] p-10"> --}}
            <div class="w-full">

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100  ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Username
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Store Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Phone Number
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <span class="sr-only">Block</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($store as $user)

                                <tr class="bg-white border-b hover:bg-gray-50 ">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $user->username }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $user->store_name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $user->phone_number }}
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <a href="{{ route('admin-toko-edit', $user['user_username']) }}" class="font-medium text-blue-600  hover:underline">Edit</a>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form action="{{ route('admin-toko-block') }}" method="post">
                                            @csrf
                                            @if($user->trashed())
                                            <button type="submit" name="username" value="{{ $user->username }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Unblock</button>
                                            @else
                                            <button type="submit" name="username" value="{{ $user->username }}" class="focus:outline-none text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Block</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>

                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
