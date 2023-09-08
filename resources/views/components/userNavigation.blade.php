<nav x-data='{ open: false }' class="lg:flex items-center justify-between flex-wrap p-6 relative">
    <div class="flex items-center flex-shrink-0  mr-6">
        <img class="lg:ml-28 mt-5 relative" src="../../images/Zeot.png" alt="Zeot Logo" width="150"
            height="42.24">
        <ul class="menu items-center mt-6 ml-36 space-x-14 font-[poppins] hidden lg:flex lg:items-center lg:w-auto">
            <li class="mr-6">
                <a href="{{ route('home') }}" class="text-lg font-medium -800">Home</a>
            </li>
            <li class="mr-6">
                <a href="{{ Auth::check() ? route('product.userProduct') : route('login') }}"
                    class="text-lg font-medium   text-opacity-50 hover:text-gray-100">Products</a>
            </li>
            <li>
                <a href="#" class="text-lg font-medium  text-opacity-50 hover:text-gray-100">Contact
                    Us</a>
            </li>
            <li>
                @auth
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-lg font-medium text-black hover:text-gray-600">
                        Logout
                    </button>
                </form>
                
                @else
                    <a href="{{ route('login') }}" class="text-lg font-medium text-black hover:text-gray-600">Login</a>
                @endauth
            </li>
        </ul>
    </div>
    <div class="items-center">
        <div class="relative space-x-14 mr-8 mt-6 hidden lg:flex lg:items-center lg:w-auto">
            <a href="" class="">
                <i class="bi bi-search" style="font-size: 1.3rem;"></i>
            </a>
            @livewire('cart-icon')
            <a href="{{ Auth::check() ? route('users.userProfile') : route('login') }}" class="text-black">
                <i class="bi bi-person" style="font-size: 1.6rem;"></i>
            </a>
        </div>

        <div class="relative py-3 mx-auto">
            <button x-on:click="open = !open"
                class="z-10 menu-toggle block lg:hidden  w-10 h-10 py-6 relative focus:outline-none">
                <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div aria-hidden="true"
                        class="z-20 block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                        :class="{ 'rotate-45': open, ' -translate-y-1.5': !open }"></div>
                    <div aria-hidden="true"
                        class="z-20 block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                        :class="{ 'opacity-0': open }"></div>
                    <div aria-hidden="true"
                        class="z-20 block absolute h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out"
                        :class="{ '-rotate-45': open, ' translate-y-1.5': !open }"></div>
                </div>
            </button>
            <div class="top-0 lg:hidden w-full fixed">
                <ul class="space-y-6 font-[poppins] absolute top-14 bg-gray-300 text-center"
                    x-show="open" x-transition:enter="transition duration-300 ease-out transform"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition duration-200 ease-in transform"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    x-cloak>
                    <li>
                        <a href="#" class="block text-lg font-medium  hover:text-gray-100">Home</a>
                    </li>
                    <li>
                        <a href="{{ Auth::check() ? route('product.userProduct') : route('login') }}"
                            class="block text-lg font-medium  text-opacity-50 hover:text-gray-100">Products</a>
                    </li>
                    <li>
                        <a href="#" class="block text-lg font-medium  text-opacity-50 hover:text-gray-100">Contact
                            Us</a>
                    </li>
                    <li>
                        @auth
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-lg font-medium text-black hover:text-gray-600">
                                Logout
                            </button>
                        </form>
                        
                        @else
                            <a href="{{ route('login') }}" class="text-lg font-medium text-black hover:text-gray-600">Login</a>
                        @endauth
                    </li>
                    <li>
                        <hr class="my-2 border-gray-300">
                    </li>
                    <div class="flex space-x-12 ml-20 mr-20">
                        <li>
                            <a href="#" class="block ">
                                <i class="bi bi-search" style="font-size: 1.3rem;"></i>
                            </a>
                        </li>
                        <li>
                            @livewire('cart-icon')
                        </li>
                        <li>
                            <a href="{{ Auth::check() ? route('users.userProfile') : route('login') }}"
                                class="text-black">
                                <i class="bi bi-person" style="font-size: 1.6rem;"></i>
                            </a>
                        </li>
                    </div>
                </ul>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const logoutForm = document.getElementById('logout-form');
                    
                    logoutForm.addEventListener('submit', function (e) {
                        e.preventDefault(); 
                        
                        const confirmLogout = confirm('Are you sure you want to log out? 😞😞');
                        
                        if (confirmLogout) {
                            this.submit(); 
                        }
                    });
                });
            </script>
        </div>
    </div>
</nav>
