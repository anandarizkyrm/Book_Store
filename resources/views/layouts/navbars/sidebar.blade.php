<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
    ADMIN ILKIYA 
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'product' || $activePage == 'add-product') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse"  href="#product" aria-expanded="true">
        <i class="material-icons">content_paste</i>
          <p>{{ __('Produk') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="product">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'product' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('product.index') }}">
                <span class="sidebar-mini"> LP </span>
                <span class="sidebar-normal">{{ __('List Product') }}  </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'add-product' ? ' active' : '' }}">
              {{-- <a class="nav-link" href="{{ route('add-product') }}">
                <span class="sidebar-mini"> TP </span>
                <span class="sidebar-normal"> {{ __('Tambah Produk') }} </span>
              </a> --}}
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'category' || $activePage == 'add-category') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse"  href="#category" aria-expanded="true">
        <i class="material-icons">content_paste</i>
          <p>{{ __('Kategori') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="category">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'category' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('category.index') }}">
                <span class="sidebar-mini"> LK </span>
                <span class="sidebar-normal">{{ __('List Kategori') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'category' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('category.store') }}">
                <span class="sidebar-mini"> TK </span>
                <span class="sidebar-normal"> {{ __('Tambah Kategori') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'theme' || $activePage == 'add-theme') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse"  href="#theme" aria-expanded="true">
        <i class="material-icons">content_paste</i>
          <p>{{ __('Tema') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="theme">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'theme' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('tema.index') }}">
                <span class="sidebar-mini"> LT </span>
                <span class="sidebar-normal">{{ __('List Tema') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'add-theme' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('tema.store') }}">
                <span class="sidebar-mini"> TT </span>
                <span class="sidebar-normal"> {{ __('Tambah Tema') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Pengguna') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Pesanan') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">book</i>
          <p>{{ __('Laporan') }}</p>
        </a>
      </li>
   
    </ul> 
  </div>
</div>
