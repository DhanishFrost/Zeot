@php
    $isHomePage = request()->is('home');
    $isStartPage = request()->is('/');
    $isRedirect = request()->is('redirects')
@endphp

<div>
    <a href="{{ route('users.cart') }}">
        @if ($isHomePage || $isStartPage || $isRedirect)
            <i class="bi bi-cart text-white" style="font-size: 1.3rem;"></i>
        @else
            <i class="bi bi-cart" style="font-size: 1.3rem;"></i>
        @endif
        @if ($cartCount > 0)
            <span
                class="bg-red-500 text-white rounded-full px-2 py-1 text-xs absolute md:-top-1">{{ $cartCount }}</span>
        @endif
    </a>
</div>
