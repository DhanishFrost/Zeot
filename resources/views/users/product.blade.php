<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
<body class="">
  <header class="shadow">
    <nav x-data='{ open: false }' class="flex items-center justify-between flex-wrap p-6 relative">
      <div class="flex items-center flex-shrink-0  mr-6">
          <img class="max-sm:ml-6 ml-28 mt-5 relative" src="../images/Zeot.png" alt="Zeot Logo" width="150" height="42.24">
          <ul class= "menu items-center mt-6 ml-36 space-x-14 font-[poppins] hidden lg:flex lg:items-center lg:w-auto">
              <li class="mr-6">
                  <a href="{{ route('home') }}" class="text-lg font-medium -800">Home</a>
              </li>
              <li class="mr-6">
                  <a href="{{ Auth::check() && Auth::user()->role == '1' ? route('product.adminProduct') : route('product.userProduct') }}"
                      class="text-lg font-medium   text-opacity-50 hover:text-gray-100">Products</a>
              </li>
              <li>
                  <a href="#" class="text-lg font-medium  text-opacity-50 hover:text-gray-100">Contact Us</a>
              </li>
          </ul>
      </div>
      <div class="items-center">
          <div class="relative space-x-14 mr-8 mt-6 hidden lg:flex lg:items-center lg:w-auto">
              <a href="" class="">
                  <i class="bi bi-search" style="font-size: 1.3rem;"></i>
              </a>
              <a href="" class="">
                  <i class="bi bi-cart" style="font-size: 1.3rem;"></i>
              </a>
              <a href="{{ Auth::check() && Auth::user()->role == '1' ? route('index') : route('profile.show') }}" class="">
                  <i class="bi bi-person" style="font-size: 1.6rem;"></i>
              </a>    
          </div>

          <div class="relative py-3 sm:max-w-xl mx-auto">
              <button x-on:click="open = !open" class="z-10 menu-toggle block lg:hidden  w-10 h-10 py-6 relative focus:outline-none">
                  <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                      <div aria-hidden="true" class="z-20 block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out" :class="{'rotate-45': open,' -translate-y-1.5': !open }"></div>
                      <div aria-hidden="true" class="z-20 block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out" :class="{'opacity-0': open } "></div>
                      <div aria-hidden="true" class="z-20 block absolute h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></div>
                  </div>
              </button>
              <div class="absolute top-0 lg:hidden w-full">
                  <ul class=" space-y-6 font-[poppins] absolute top-14 bg-gray-300 bg-opacity-90 text-center -translate-x-3/4" x-show="open" x-transition:enter="transition duration-300 ease-out transform" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition duration-200 ease-in transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" x-cloak>
                      <li>
                          <a href="#" class="block text-lg font-medium  hover:text-gray-100">Home</a>
                      </li>
                      <li>
                          <a href="#" class="block text-lg font-medium  text-opacity-50 hover:text-gray-100">Products</a>
                      </li>
                      <li>
                          <a href="#" class="block text-lg font-medium  text-opacity-50 hover:text-gray-100">Contact Us</a>
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
                          <a href="#" class="block ">
                              <i class="bi bi-cart" style="font-size: 1.3rem;"></i>
                          </a>
                      </li>
                      <li>
                          <a href="{{ Auth::check() && Auth::user()->role == '1' ? route('index') : route('profile.show') }}" class="">
                              <i class="bi bi-person" style="font-size: 1.6rem;"></i>
                          </a> 
                      </li>
                  </div>
                  </ul>
              </div>
              
          </div>
      </div>
  </nav>
  </header>

  <br><br>

  <main class="mx-20 max-lg:ml-8">
    <div class="grid grid-cols-4 gap-4 max-lg:grid-cols-1">
      <section class=" shadow rounded-lg px-8"><br><br>
          <h1 class="font-[poppins] text-lg font-bold">FILTER</h1>
          <div class="pb-16 pt-4 pl-7 mt-2">
              <h1 class="font-[poppins] font-semibold text-md mb-2">Search</h1>
              <input type="text" class="border border-gray-300 px-4 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 w-10/12" placeholder="Search...">
              <br><br>
                  <div class="inline-block relative" x-data="{open: false}">
                    <button @click="open = !open" class="focus:outline-none cursor-pointer font-[poppins] text-md font-semibold" :class="{ : open}">
                      Categories
                      <svg viewBox="0 0 24 24" :class="{'rotate-180': open}" class="ml-1 transform duration-300 inline-block w-6 h-6"><path fill-rule="evenodd" d="M15.3 10.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z"/></svg>
                    </button>   
                    <ul x-show="open" class="bg-white absolute left-0 w-48 origin-top "
                      x-transition:enter="transition ease-out duration-200"
                      x-transition:enter-start="opacity-0 transform scale-y-50"
                      x-transition:enter-end="opacity-100 transform scale-y-100"
                      x-transition:leave="transition ease-in duration-300"
                      x-transition:leave-end="opacity-0 transform scale-y-50"
                    >
                      <li><a href="#" class="font-[poppins] font-normal py-1 pl-5 block ">Men's Watches</a></li>
                      <li><a href="#" class="font-[poppins] font-normal py-1 pl-5 block ">Women's Watches</a></li>
                    </ul>
                  </div> 
            
              
          </div>
      </section>
  
      <section class="col-span-3 max-lg:col-span-1">
          <h1 class="font-[poppins] tracking-wider font-semibold text-3xl text-center">Products</h1><br>

          <div class="grid grid-cols-3 gap-4 max-lg:grid-cols-1">
              @foreach ($products as $product)
                  <div class="p-4">
                      @if ($product->image)
                          <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" class="rounded-md ease-in-out hover:opacity-80 delay-200 h-96 w-80 object-cover">
                      @endif
                      <div>
                          <p class="font-[poppins] text-lg font-medium mt-2 max-sm:ml-auto">{{ $product->name }}</p>
                          <p class="font-[poppins] text-lg font-medium text-gray-500 mt-1 max-sm:ml-auto">LKR {{ $product->price }}</p>
                      </div>
                  </div>
              @endforeach
          </div>
      </section>
  </div>

  




  </main>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>