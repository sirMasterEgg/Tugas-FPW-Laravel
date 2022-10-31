@extends('layout.maintemplate')
@section('content')
    <div class="flex justify-center">
        @include('customer.layout.navbar')
        <div class="container mt-14 py-10">
            <form action="{{ route('customer-dotopup-saldo') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="nominal" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah Top Up</label>
                    <input type="text" id="nominal" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" placeholder="Jumlah Top Up" name="user_top_up">
                    @error('user_top_up')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="current-password" class="block mb-2 text-sm font-medium text-gray-900 ">Current Password</label>
                    <input type="password" id="current-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-persian-green-std focus:border-persian-green-std block w-full p-2.5" placeholder="Current Password" name="user_current_password">
                    @error('user_current_password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="text-white bg-persian-green-std hover:bg-persian-green-hov focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Isi Saldo</button>
            </form>

        </div>
    </div>
@endsection
