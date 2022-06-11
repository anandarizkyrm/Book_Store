<div class="wrapper ">
    @include('user-dashboard.layouts.sidebar')
  <div class="main-panel">
    @include('user-dashboard.layouts.navbars.navs.auth')
    @yield('content')

  </div>
</div>