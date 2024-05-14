<div class="sidebar-menu">
    <ul class="menu">
      <li class="sidebar-title">Menu</li>
  
      <li class="sidebar-item ">
        <a href="{{ route('dashboard') }}" class="sidebar-link">
          <i class="bi bi-grid-fill"></i>
          <span>Beranda</span>
        </a>
      </li>
  
      <li class="sidebar-title">Data Master</li>
      <li class="sidebar-item">
        <a href="{{ route('administrator-commodity') }}" class="sidebar-link">
          <i class="bi bi-collection-fill"></i>
          <span>Komoditas</span>
        </a>
      </li>
  
      <li class="sidebar-item">
        <a href="{{ route('administrator-programstudy') }}" class="sidebar-link">
          <i class="bi bi-bookmarks-fill"></i>
          <span>Program Studi</span>
        </a>
      </li>
  
      <li class="sidebar-item">
        <a href="{{ route('administrator-class') }}" class="sidebar-link">
          <i class="bi bi-building-fill"></i>
          <span>Kelas</span>
        </a>
      </li>
  
      <li class="sidebar-item">
        <a href="{{ route('administrator-subject') }}" class="sidebar-link">
          <i class="bi bi-book-half"></i>
          <span>Mata Kuliah</span>
        </a>
      </li>
  
      <li class="sidebar-item has-sub">
        <a href="#" class="sidebar-link">
          <i class="bi bi-stack"></i>
          <span>Peminjaman</span>
        </a>
        <ul class="submenu">
          <li class="submenu-item">
            <a href="{{ route('administrator-main') }}">Peminjaman Hari Ini</a>
          </li>
          <li class="submenu-item">
            <a href="{{ route('administrator-history') }}">Riwayat Peminjaman</a>
          </li>
        </ul>
      </li>
  
      <li class="sidebar-title">Manajemen Akun</li>
  
      <li class="sidebar-item">
        <a href="{{ route('administrator-student') }}" class="sidebar-link">
          <i class="bi bi-people-fill"></i>
          <span>Mahasiswa</span>
        </a>
      </li>
  
      <li class="sidebar-item">
        <a href="{{ route('administrator-admin') }}" class="sidebar-link">
          <i class="bi bi-person-badge-fill"></i>
          <span>Administrator</span>
        </a>
      </li>
  
      <li class="sidebar-title"></li>
  
      <li class="sidebar-item">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <a href="{{ route('logout') }}" class="sidebar-link" id="logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Keluar</span>
          </a>
        </form>
      </li>
    </ul>
  </div>
  