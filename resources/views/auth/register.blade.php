<x-guest-layout>
    <section class="bg-black flex flex-col md:flex-row h-screen items-center">
        

        <img src="../images/signup.jpg" alt="Loginimage" class=" max-md:w-full w-7/12 h-full object-cover brightness-50">
        <div class=" absolute top-0 left-0 w-7/12 h-full flex items-center justify-center">
        <div class="text-white">
            <span class="playfairdisplay text-white text-7xl max-md:hidden font-normal">Timeless Refinement</span><br><br>
            <span class="font-[poppins] text-white text-opacity-60 max-md:hidden text-2xl font-medium">Indulge in the timeless
                elegance <br> and exquisite craftsmanship <br> of luxury watches</span>
        </div>
        </div>

    <div class=" w-full md:max-w-md lg:max-w-full md:mx-auto md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center"><div class="w-full h-100">
        <img class="w-56 mx-auto max-md:relative max-md:bottom-52" src="../images/Zeot.png" alt="Zeot Logo">

        <x-validation-errors class="mb-4" />

        <form class="mt-6 max-md:relative max-md:bottom-16" method="POST" action="{{ route('register') }}">
            <h1 class="font-[poppins] text-gray-200 text-center text-xl md:text-2xl font-semibold leading-tight mb-6 mt-10 max-md:mb-6 max-md:mt-6">Create Account</h1>
            @csrf

            <div class="relative" >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="bi bi-person text-xl text-gray-300 mt-1.5"></i>
                </div>
                <input class="w-full px-4 py-3 border-0 border-b-2 hover:border-b-blue-500 mt-2 bg-black text-white pl-10" placeholder="Name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
            </div>

            <div class="mt-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="bi bi-envelope text-gray-300 mt-1.5"></i>
                </div>
                <input class="w-full px-4 py-3 border-0 border-b-2 hover:border-b-blue-500 mt-2 bg-black text-white pl-10" placeholder="Email"  id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username">
            </div>

            
            <div class="mt-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="bi bi-key text-gray-300 mt-1.5"></i>
                </div>
                <input class="w-full px-4 py-3 border-0 border-b-2 hover:border-b-blue-500 mt-2 bg-black text-white pl-10" placeholder="Password"  id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password">
            </div>
            

            <div class="mt-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="bi bi-lock text-gray-300 mt-1.5"></i>
                </div>
                <input class="w-full px-4 py-3 border-0 border-b-2 hover:border-b-blue-500 mt-2 bg-black text-white pl-10" placeholder="Confirm Password" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif
    
                <div class="text-right mt-2"> 
                    <div class="flex items-center justify-end mt-4">
                        <a class="text-sm font-semibold text-gray-400 hover:text-white focus:text-white" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                
                    <button type="submit"  class="w-full mt-6 text-center px-4 py-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-[#0a174a] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('REGISTER') }}
                    </button>
                </div>            
        </form>
    </div>
    </div>
</section>


</x-guest-layout>
