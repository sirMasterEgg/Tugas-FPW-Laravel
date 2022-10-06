@extends('layout.maintemplate')

@section('content')
    <div class="flex flex-row">
        @include('admin.layout.sidebar')
        <div class="container w-5/6 p-10">
            <div class="w-full">

                <form action="{{ route('admin-toko-doedit') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                        <input type="text" id="username" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" placeholder="Username" value="{{ $data['user_username'] }}" required="" name="username">
                    </div>
                    <div class="mb-6">
                        <label for="storename" class="block mb-2 text-sm font-medium text-gray-900 ">Store Name</label>
                        <input type="text" id="storename" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" required="" value="{{ $data['user_storename'] }}" placeholder="Store Name" name="storename">
                    </div>
                    <div class="mb-6">
                        <label for="phonenumber" class="block mb-2 text-sm font-medium text-gray-900 ">Phone Number</label>
                        <input type="text" id="phonenumber" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" required="" value="{{ $data['user_phone'] }}" placeholder="Phone Number" name="phone">
                    </div>
                    <input type="hidden" name="id" value="{{ $data['user_username'] }}">
                    <button type="submit" class="text-white bg-persian-green-std hover:bg-persian-green-hov focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save Changes</button>
                </form>

            </div>
        </div>
    </div>
@endsection
