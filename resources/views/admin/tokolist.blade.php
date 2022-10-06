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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Session::get('data')??[] as $user)
                                @if($user['user_role'] == 'store')
                                <tr class="bg-white border-b hover:bg-gray-50 ">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $user['user_username'] }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $user['user_storename'] }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $user['user_phone'] }}
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <a href="{{ route('admin-toko-edit', $user['user_username']) }}" class="font-medium text-blue-600  hover:underline">Edit</a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
