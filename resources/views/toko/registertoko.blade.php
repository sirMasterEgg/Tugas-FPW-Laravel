@extends('layout.maintemplate')

@section('registerform')
<div class="flex items-center justify-center min-h-screen bg-charcoal-std">
    <div class="px-8 py-6 mx-4 my-4 text-left rounded bg-white shadow-lg md:w-1/3 lg:w-1/3 sm:w-1/3">
        <h3 class="text-2xl font-bold text-center">Sign Up for Seller</h3>
        <form action="{{ route('toko-doRegister') }}" method="POST">
            @csrf
            <div class="mt-4">
                <div>
                    <label class="block" for="NameSeller">Store Name<label>
                    <input type="text" placeholder="Store Name" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std" name="user_storename">
                    @error('user_storename')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block" for="Name">Full Name<label>
                    <input type="text" placeholder="Full Name" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std" name="user_ownername">
                    @error('user_ownername')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block" for="username">Username<label>
                    <input type="text" placeholder="Username" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std" name="user_username">
                    @error('user_username')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block">Password<label>
                    <input type="password" placeholder="Password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std" name="user_password">
                    @error('user_password')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block">Confirm Password<label>
                    <input type="password" placeholder="Password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std" name="user_confirm_password">
                    @error('user_confirm_password')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block">Phone Number<label>
                    <input type="text" placeholder="Phone Number" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std" name="user_phone">
                    @error('user_phone')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block">Bank Account<label>
                    <input type="text" placeholder="Bank Account" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std" name="user_bank">
                    @error('user_bank')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4 mb-4">
                    <label class="block">Gender</label>
                    <fieldset class="py-2 mt-2">

                        <div class="flex flex-row gap-7">
                            <div class="flex items-center">
                              <input id="gender-option-1" type="radio" name="user_gender" value="0" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-persian-green-std accent-persian-green-std">
                              <label for="gender-option-1" class="block ml-2 text-sm font-medium text-gray-900 ">
                                Male
                              </label>
                            </div>

                            <div class="flex items-center">
                              <input id="gender-option-2" type="radio" name="user_gender" value="1" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-persian-green-std accent-persian-green-std">
                              <label for="gender-option-2" class="block ml-2 text-sm font-medium text-gray-900 ">
                                Female
                              </label>
                            </div>
                        </div>

                    </fieldset>
                    @error('user_gender')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-between">
                    <label class="inline-flex items-center">
                        <input type="checkbox" value="checked" class="w-4 h-4 rounded focus:ring-persian-green-std accent-persian-green-std focus:ring-2 " name="user_termsncon"/>
                        <span class="ml-2 select-none">I agree with all of terms and conditions</span>
                      </label>
                </div>
                @error('user_termsncon')
                <span class="text-xs text-red-400">{{ $message }}</span>
                @enderror
                <div class="flex">
                    <button class="w-full px-6 py-2 mt-4 text-white transition duration-150 ease-in-out bg-persian-green-std rounded-lg hover:bg-persian-green-hov ">
                        Create Seller Account
                    </button>
                </div>
                <div class="mt-6 text-grey-dark">
                    Already have an account?
                    <a class="inline-block px-6 py-2 border border-persian-green-std text-persian-green-std font-medium text-xs leading-tight uppercase rounded hover:bg-persian-green-hov hover:text-neutral-50 transition duration-150 ease-in-out" href="{{ route('login') }}">
                        Log in
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
