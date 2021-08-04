<!doctype html>
<html lang="en">
  @include('layouts.partials.header')
  <body>
    <header>
        
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