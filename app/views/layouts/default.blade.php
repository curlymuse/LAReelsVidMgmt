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

      @if (Session::has('error'))
      <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        {{ Session::get('error') }}
      </div>
      @endif


      @yield('content')
    </main>
  
    <footer>
      @include('includes.footer')
    </footer>

  </body>
</html>
