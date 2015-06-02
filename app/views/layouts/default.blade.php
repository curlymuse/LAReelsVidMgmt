<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.head')
  </head>
  <body>
    <header class="header">
      @include('includes.header')
    </header><!-- / End header -->
  
    <main role="main">
      @yield('content')
    </main>
  
    <footer>
      @include('includes.footer')
    </footer>
  
    @include('includes.app-footer')
  
  </body>
</html>
