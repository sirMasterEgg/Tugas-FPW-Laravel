@extends('layout.maintemplate')
@section('content')
    <div class="flex justify-center">
        @include('customer.layout.navbar')
        <div class="container mt-14 py-10">
            <form action="{{ route('customer-doEditProfile') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                    <input type="text" id="username" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" value="{{ Session::get('active')['user_username']??'' }}" placeholder="Username" name="user_username">
                </div>
                <div class="mb-6">
                    <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900 ">Full Name</label>
                    <input type="text" id="fullname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" value="{{ Session::get('active')['user_fullname']??'' }}" placeholder="Full Name" name="user_fullname">
                </div>
                <div class="mb-6">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 ">Address</label>
                    <input type="text" id="alamat" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" value="{{ Session::get('active')['user_address']??'' }}" placeholder="Address" name="user_address">
                </div>
                <div class="mb-6">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Phone Number</label>
                    <input type="text" id="phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" value="{{ Session::get('active')['user_phone']??'' }}" placeholder="Phone Number" name="user_phone">
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">New Password</label>
                    <input type="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" placeholder="New Password" name="user_new_password">
                </div>
                <div class="mb-6">
                    <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm New Password</label>
                    <input type="password" id="repeat-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" placeholder="Confirm New Password" name="user_confirm_new_password">
                </div>
                <div class="mb-6">
                    <label for="current-password" class="block mb-2 text-sm font-medium text-gray-900 ">Current Password</label>
                    <input type="password" id="current-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" placeholder="Current Password" name="user_current_password">
                </div>
                <button type="submit" class="text-white bg-persian-green-std hover:bg-persian-green-hov focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update Profile</button>
            </form>

        </div>
    </div>
@endsection
