<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zeot</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900|Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        data-tag="font" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        data-tag="font" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ mix('../resources/css/app.css') }}">

</head>

<body>
    <header class="homepageheader">
        <nav x-data='{ open: false }' class="flex items-center justify-between flex-wrap p-6 relative">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <img class="max-sm:ml-6 ml-28 mt-5 relative" src="images/Zeot.png" alt="Zeot Logo" width="150" height="42.24">
                <ul class= "menu items-center mt-6 ml-36 space-x-14 font-[poppins] hidden lg:flex lg:items-center lg:w-auto">
                    <li class="mr-6">
                        <a href="#" class="text-lg font-medium text-white-800">Home</a>
                    </li>
                    <li class="mr-6">
                        <a href="{{ Auth::check() && Auth::user()->role == '1' ? route('product.adminProduct') : route('product.userProduct') }}"
                            class="text-lg font-medium  text-white text-opacity-50 hover:text-gray-100">Products</a>
                    </li>
                    <li>
                        <a href="#" class="text-lg font-medium text-white text-opacity-50 hover:text-gray-100">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="items-center">
                <div class="relative space-x-14 mr-8 mt-6 hidden lg:flex lg:items-center lg:w-auto">
                    <a href="" class="text-white">
                        <i class="bi bi-search" style="font-size: 1.3rem;"></i>
                    </a>
                    <a href="" class="text-white">
                        <i class="bi bi-cart" style="font-size: 1.3rem;"></i>
                    </a>
                    <a href="{{ Auth::check() && Auth::user()->role == '1' ? route('index') : route('profile.show') }}" class="text-white">
                        <i class="bi bi-person" style="font-size: 1.6rem;"></i>
                    </a>    
                </div>

                <div class="relative py-3 sm:max-w-xl mx-auto">
                    <button x-on:click="open = !open" class="z-10 menu-toggle block lg:hidden text-white w-10 h-10 py-6 relative focus:outline-none">
                        <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div aria-hidden="true" class="z-20 block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out" :class="{'rotate-45': open,' -translate-y-1.5': !open }"></div>
                            <div aria-hidden="true" class="z-20 block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out" :class="{'opacity-0': open } "></div>
                            <div aria-hidden="true" class="z-20 block absolute h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></div>
                        </div>
                    </button>
                    <div class="absolute top-0 lg:hidden w-full">
                        <ul class=" space-y-6 font-[poppins] absolute top-14 bg-black bg-opacity-90 text-center -translate-x-3/4" x-show="open" x-transition:enter="transition duration-300 ease-out transform" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition duration-200 ease-in transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" x-cloak>
                            <li>
                                <a href="#" class="block text-lg font-medium text-white hover:text-gray-100">Home</a>
                            </li>
                            <li>
                                <a href="{{ Auth::check() && Auth::user()->role == '1' ? route('product.adminProduct') : route('product.userProduct') }}"
                                    class="block text-lg font-medium  text-white text-opacity-50 hover:text-gray-100">Products</a>
                            </li>
                            <li>
                                <a href="#" class="block text-lg font-medium text-white text-opacity-50 hover:text-gray-100">Contact Us</a>
                            </li>
                            <li>
                                <hr class="my-2 border-gray-300">
                            </li>
                            <div class="flex space-x-12 ml-20 mr-20">
                            <li>
                                <a href="#" class="block text-white">
                                    <i class="bi bi-search" style="font-size: 1.3rem;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block text-white">
                                    <i class="bi bi-cart" style="font-size: 1.3rem;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ Auth::check() && Auth::user()->role == '1' ? route('index') : route('profile.show') }}" class="text-white">
                                    <i class="bi bi-person" style="font-size: 1.6rem;"></i>
                                </a> 
                            </li>
                        </div>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </nav>


        <div class="ml-36 mt-32 max-sm:ml-10 max-sm:mt-16">
            <span class="playfairdisplay text-white text-7xl max-sm:text-5xl font-normal">Timeless <br> Refinement</span><br><br>
            <span class="font-[poppins] text-white text-opacity-50 text-lg font-medium">Indulge in the timeless <br>
                elegance and exquisite <br> craftsmanship of luxury <br> watches</span>
            <br><br><br>
            <div class="">
                <a class="playfairdisplay text-white text-2xl border rounded-lg px-14 py-4 hover:bg-gray-800 transition ease-in-out delay-150"
                    href="{{ route('product.userProduct') }}">Shop now</a>
            </div>
        </div>
    </header>

    <br><br>

    <main>
        <div class="mx-32 max-md:mx-12 max-sm:mx-4">
            <section class="flex max-xl:flex-col">
                <div class="flex-1">
                    <img class="rounded-lg w-full" src="images/latest collection.jpg" alt="Elegant Collection">
                </div>
                <div class="flex-1 mt-12 max-md:mt-6">
                    <span class="font-[poppins] text-3xl font-bold tracking-wider ml-36 max-md:text-center max-sm:mx-6 max-sm:text-2xl">ELEGANT COLLECTION</span>
                    <br><br>
                    <div class="playfairdisplay bg-gray-200 pb-16 pt-6 rounded-md">
                        <p class="text-lg font-medium text-gray-700 ml-24 max-md:ml-4">
                            An elegant watch collection offers classic style with understated
                            sophistication. Clean lines, sleek cases, and delicate dials exude
                            luxury. Crafted from premium materials and designed with
                            precision, these versatile watches can be worn for any occasion.
                            Whether for a formal event or everyday wear, an elegant watch
                            collection offers a timeless and sophisticated addition to your
                            wardrobe.
                            <br><br>
                            <a class="border border-gray-500 rounded-md text-base px-5 py-2.5 hover:bg-gray-500 hover:text-white font-thin transition-all ease-in-out delay-100"
                                href="">VIEW COLLECTION</a>
                        </p>
                    </div>
                </div>
            </section>
            <br><br><br>
            <section class="flex max-lg:flex-col max-lg:text-center ">
                <div class="flex-1">
                    <span class="font-[poppins] font-bold text-3xl">BESTSELLERS</span>
                    <br><br>
                    <p class="font-[poppins] text-lg font-medium text-gray-500" >
                        Indulge in the timeless <br> elegance and exquisite <br> craftsmanship of
                        luxury <br> watches
                    </p>
                    <br>
                    <a href="{{ route('product.userProduct') }}"
                        class="border border-gray-500 rounded-md py-2 hover:bg-gray-500 hover:text-white transition-all ease-in-out delay-100 px-7" >
                        See more
                        <span class="arrow">&#8594;</span>
                    </a>
                </div>
                <br>
                <div class="flex-1">
                    <a href="#">
                        <img class="rounded-xl ease-in-out hover:opacity-80 delay-200 mx-auto" src="images/rolex 2.jpg" alt="rolex" style="width: 300px; height: 363px;">
                    </a>
                    <p class="font-[poppins] text-lg font-medium mt-2 ml-7 max-sm:ml-auto">Rolex</p>
                    <p class="font-[poppins] text-lg font-medium text-gray-500 mt-1 ml-7 max-sm:ml-auto">LKR 180,000</p>
                </div>
                <div class="flex-1">
                    <a href="#">
                        <img class="rounded-xl ease-in-out hover:opacity-80 delay-200 mx-auto" src="images/raymond weil.jpg" alt="rolex"
                            style="width: 300px; height: 363px;">
                    </a>
                    <p class="font-[poppins] text-lg font-medium mt-2 ml-7 max-sm:ml-auto">Raymond Weil</p>
                    <p class="font-[poppins] text-lg font-medium text-gray-500 mt-1 ml-7 max-sm:ml-auto">LKR 150,000</p>
                </div>
                <div class="flex-1">
                    <a href="#">
                        <img class="rounded-xl ease-in-out hover:opacity-80 delay-200 mx-auto" src="images/rolex 2.jpg" alt="rolex"
                            style="width: 300px; height: 363px;">
                    </a>
                    <p class="font-[poppins] text-lg font-medium mt-2 ml-7 max-sm:ml-auto">Rolex</p>
                    <p class="font-[poppins] text-lg font-medium text-gray-500 mt-1 ml-7 max-sm:ml-auto">LKR 180,000</p>
                </div>
            </section>
            <br><br><br>

            <p class="font-[poppins] text-3xl font-bold text-center">Categories</p>
            <p class="font-[poppins] text-lg font-medium text-center pt-2">Discover what you're looking</p>
            <br><br>

            <section class="flex max-lg:flex-col max-lg:text-center">
                <div class="flex-1 relative">
                    <a href="#">
                        <img class="rounded-lg brightness-75 h-80 max-lg:h-64" style="width: 669px" src="images/mens.jpg"
                            alt="mens watches">
                        <div class="image-text font-[poppins] text-3xl font-bold text-white">Men's Watches</div>
                    </a>
                </div>
                <br>
                <div class="flex-1 relative">
                    <a href="#">
                        <img class="rounded-lg brightness-75 h-80 max-lg:h-64 max-lg:pt-4" style="width: 669px" src="images/women watch.png" alt="womens watches">
                        <div class="image-text font-[poppins] text-3xl font-bold text-white">Women's Watches</div>
                    </a>
                </div>
            </section>
        </div>
    </main>
    <br><br>

    <footer class="bg-black bg-opacity-90">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0 mt-8">
                    <img src="images/Zeot.png" alt="Zeot Logo" width="88px" height="25px">
                    <span class="font-[poppins] text-lg font-medium text-white text-opacity-90">Timeless elegance, <br>
                        crafted to perfection.</span>
                    <br><br>
                    <div class="social-icons">
                        <a href="">
                            <i class="bi bi-facebook" style="font-size: 1.2rem;"></i>
                        </a>
                        <a href="">
                            <i class="bi bi-instagram" style="font-size: 1.2rem;"></i>
                        </a>
                        <a href="">
                            <i class="bi bi-twitter" style="font-size: 1.2rem;"></i>
                        </a>
                    </div>
                    <br><br>
                    <span class="font-[poppins] text-white text-opacity-90 text-lg font-medium">2023 all Right Reserved
                        Term of use ZEOT</span>
                </div>
                <div class="grid grid-cols-2 gap-8 space-x-12 sm:gap-6 sm:grid-cols-3 mt-8">
                    <div class="pr-4">
                        <h2 class="font-[poppins] text-white text-opacity-90 text-lg font-medium">Quick Links</h2>
                        <ul class="font-[poppins] text-white text-opacity-50 text-lg font-normal">
                            <li class="pt-6"><a href="">Home</a></li>
                            <li class="pt-6"><a href="">Products</a></li>
                            <li class="pt-6"><a href="">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="font-[poppins] text-white text-opacity-90 text-lg font-medium">Contact Us</h2>
                        <ul class="font-[poppins] text-white text-opacity-50 text-lg font-normal">
                            <li class="pt-6"><a href="">Email</a></li>
                            <li class="pt-6"><a href="">Phone</a></li>
                            <li class="pt-6"><a href="">Address</a></li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="font-[poppins] text-white text-opacity-90 text-lg font-medium">Legal</h2>
                        <ul class="font-[poppins] text-white text-opacity-50 text-lg font-normal">
                            <li class="pt-6"><a href="">Privacy Policy</a></li>
                            <li class="pt-6"><a href="">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>


</html>
