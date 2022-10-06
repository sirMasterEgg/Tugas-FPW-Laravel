@extends('layout.maintemplate')

@section('registerform')
<div class="flex items-center justify-center min-h-screen bg-charcoal-std">
    <div class="px-8 py-6 mx-4 mt-4 text-left rounded bg-white shadow-lg md:w-1/3 lg:w-1/3 sm:w-1/3">
        <h3 class="text-2xl font-bold text-center">Sign Up</h3>
    <form action="{{ route('customer-doregister') }}" method="POST">
        @csrf
            <div class="mt-4">
                <div>
                    <label class="block" for="Name">Full Name</label>
                    <input type="text" placeholder="Full Name" name="user_fullname" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std">
                </div>
                <div class="mt-4">
                    <label class="block" for="email">Username</label>
                    <input type="text" placeholder="Username" name="user_username" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std">
                </div>
                <div class="mt-4">
                    <label class="block">Password</label>
                    <input type="password" placeholder="Password" name="user_password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std">
                </div>
                <div class="mt-4">
                    <label class="block">Confirm Password</label>
                    <input type="password" placeholder="Password" name="user_confirm_password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std">
                </div>
                <div class="mt-4">
                    <label class="block">Address</label>
                    <input type="text" placeholder="Address" name="user_address" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std">
                </div>
                <div class="mt-4">
                    <label class="block">Phone Number</label>
                    <input type="text" placeholder="Phone Number" name="user_phone" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-persian-green-std">
                </div>
                <div class="mt-4">
                    <label class="block">Gender</label>
                    <fieldset class="py-2 mt-2">

                        <div class="flex flex-row gap-7">
                            <div class="flex items-center mb-4">
                              <input id="gender-option-1" type="radio" name="user_gender" value="Male" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-persian-green-std accent-persian-green-std">
                              <label for="gender-option-1" class="block ml-2 text-sm font-medium text-gray-900 ">
                                Male
                              </label>
                            </div>

                            <div class="flex items-center mb-4">
                              <input id="gender-option-2" type="radio" name="user_gender" value="Female" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-persian-green-std accent-persian-green-std">
                              <label for="gender-option-2" class="block ml-2 text-sm font-medium text-gray-900 ">
                                Female
                              </label>
                            </div>
                        </div>

                      </fieldset>
                </div>
                @if(Session::has('error'))
                <span class="text-xs text-red-400">{{ Session::get('error') }}</span>
                @endif
                <div class="flex">
                    <button class="w-full px-6 py-2 mt-4 text-white transition duration-150 ease-in-out bg-persian-green-std rounded-lg hover:bg-persian-green-hov ">
                        Create Account
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
