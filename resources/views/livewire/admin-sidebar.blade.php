<div x-data='{ open: false }'>
    <div class="hidden lg:block bg-[#252e3e] h-screen top-0 left-0 border-r overflow-y-auto">
        <ul class="py-4 space-y-1">
            <img class="max-sm:ml-6 ml-4 mt-5 mb-4 relative" src="../images/Zeot.png" alt="Zeot Logo" width="150"
                height="42.24">
            <li>
                <a href="{{ route('index') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Customers</span>
                </a>
            </li>
            <li>
                <a href="{{ route('product.adminProduct') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Manage Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.adminOrder') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Manage Orders</span>
                </a>
            </li>

            <li class="px-5">
                <div class="flex flex-row items-center h-8">
                    <div class="text-sm font-light tracking-wide text-gray-100">Settings</div>
                </div>
            </li>
            <li>
                <a href="{{ route('profile.show') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Profile</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#"
                        class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="ml-4 fa fa-sign-out text-white" style="font-size:20px"></i>
                        <span class="ml-4 text-sm truncate text-white">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
    <div x-data="{ open: false }" class=" bg-[#252e3e] top-0 left-0 border-r overflow-y-auto"">
        <button x-on:click="open = !open"
            class="z-10 menu-toggle block lg:hidden text-white w-10 h-10 py-6 relative focus:outline-none">
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

        <ul class="py-4 space-y-1 lg:hidden bg-[#252e3e] top-0 left-0 border-r overflow-y-auto" x-show="open"
            x-transition:enter="transition duration-300 ease-out transform"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-200 ease-in transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" x-cloak>
            <img class="max-sm:ml-6 ml-4 mt-5 mb-4 relative" src="../images/Zeot.png" alt="Zeot Logo" width="150"
                height="42.24">
            <li>
                <a href="{{ route('index') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Customers</span>
                </a>
            </li>
            <li>
                <a href="{{ route('product.adminProduct') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Manage Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.adminOrder') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Manage Orders</span>
                </a>
            </li>

            <li class="px-5">
                <div class="flex flex-row items-center h-8">
                    <div class="text-sm font-light tracking-wide text-gray-100">Settings</div>
                </div>
            </li>
            <li>
                <a href="{{ route('profile.show') }}"
                    class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <svg class="w-6 h-6 ml-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="ml-4 text-sm truncate text-white">Profile</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#"
                        class="flex items-center h-11 hover:bg-gray-500 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="ml-4 fa fa-sign-out text-white" style="font-size:20px"></i>
                        <span class="ml-4 text-sm truncate text-white">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
