<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

     @if (Auth::user()->roles == 'ADMIN')
     <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.dashboard.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.customer.index') }}">
          <i class="bi bi-people-fill"></i>
          <span>Data Customer</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.paket-travel.index') }}">
          <i class="bi bi-geo-fill"></i>
          <span>Data Paket Travel</span>
        </a>
      </li>
       {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-geo-fill"></i><span>Data Paket Travel</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.paket-travel.index') }}">
              <i class="bi bi-circle"></i><span>Master Paket Travel</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Travel</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav --> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.transaksi.index') }}">
          <i class="bi bi-receipt"></i>
          <span>Data Transaksi</span>
        </a>
      </li>



      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.tour-guide.index') }}">
          <i class="bi bi-person-fill"></i>
          <span>Data Tour Guide</span>
        </a>
      </li>

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      --}}
      @else
      <li class="nav-item">
        <a class="nav-link " href="{{ route('tour.guide.dashboard.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
     @endif

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-left"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Blank Page Nav -->

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </ul>

  </aside><!-- End Sidebar-->
