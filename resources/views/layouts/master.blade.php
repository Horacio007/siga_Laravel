<!doctype html>
<html lang="en">
  @include('layouts.partials.header')
  <body>
    <header>
        @include('layouts.partials.menu.navbar')
    </header>
    <div>
      <main>
        @include('layouts.partials.messages')
      </main>
      @yield('content')
      
      @include('layouts.partials.scripts')
    </div>
  </body> 
</html>