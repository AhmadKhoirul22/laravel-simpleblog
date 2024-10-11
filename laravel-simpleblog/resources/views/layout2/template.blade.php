<!DOCTYPE html>
<html lang="en">
    <head>
    @include('layout2._css')
    </head>
    <body>
        <!-- Navbar start -->
     @include('layout2._navbar')
        <!-- Navbar End -->
        <!-- Hero Start -->
    @include('layout2._hero')
        <!-- Hero End -->
        <!-- Featurs Section Start -->
    {{-- @include('layout2._features') --}}
        <!-- Featurs Section End -->
        <!-- Fruits Shop Start-->
        @yield('content')
        <!-- Footer Start -->
        @include('layout2._footer')
        <!-- Footer End -->
        <!-- Back to Top -->
        @include('layout2._js')
    </body>

</html>
