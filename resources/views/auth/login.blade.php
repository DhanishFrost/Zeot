<x-guest-layout>

    <section class="bg-black flex flex-col md:flex-row h-screen items-center">
        

            <img src="../images/watch1.webp" alt="Loginimage" class=" max-md:w-full w-7/12 h-full object-cover brightness-50">
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

            @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
    
            <form class="mt-6 max-md:relative max-md:bottom-16" action="{{ route('login') }}" method="POST">
                <h1 class="font-[poppins] text-gray-200 text-center text-xl md:text-2xl font-semibold leading-tight mb-6 mt-10 max-md:mb-6 max-md:mt-6">Log in to your account</h1>

                @csrf
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="bi bi-envelope text-gray-300 mt-1.5"></i>
                    </div>
                    <input id="email" class="w-full px-4 py-3 border-0 border-b-2 hover:border-b-blue-500 mt-2 bg-black text-white pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email">
                </div>
                

                <div class="mt-4 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="bi bi-key text-gray-300 mt-1.5"></i>
                    </div>
                    <input id="password" class="w-full px-4 py-3 border-0 border-b-2 hover:border-b-blue-500 mt-2 bg-black text-white pl-10" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                </div>
        
                    <div class="text-right mt-2">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-gray-400 hover:text-white focus:text-white">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif    
                    
                        <button type="submit"  class="w-full mt-6 text-center px-4 py-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-[#0a174a] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('LOG IN') }}
                        </button>
                    </div>
                    <hr class="my-6 border-gray-300 w-full">

                    <p class="mt-auto text-gray-400">Don't have an account? <a href="{{ route('register') }}" class="text-gray-200 hover:text-white font-semibold">{{ __('Register') }}</a></p>
                
            
            </form>
        </div>
        </div>
    </section>

</x-guest-layout>

