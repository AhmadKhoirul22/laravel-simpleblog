<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item {{ Request::is('kategori') ? 'active' : '' }}">
            <a href="{{ route('kategori') }}" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Kategori</span>
            </a>
        </li>

        <li class="sidebar-item {{ Request::is('content') ? 'active' : '' }}">
            <a href="{{ route('content') }}" class='sidebar-link'>
                <i class="bi bi-collection-fill"></i>
                <span>Content</span>
            </a>
        </li>

        <li class="sidebar-item {{ Request::is('user') ? 'active' : '' }}">
            <a href="{{ route('user') }}" class='sidebar-link'>
                <i class="bi bi-person-circle"></i>
                <span>User</span>
            </a>
        </li>

        <li class="sidebar-title">Forms &amp; Tables</li>

        <li class="sidebar-item">

            <form action="{{ route('logout') }}" method="post"  >
                @csrf
                <button class="sidebar-link" onclick="return confirm('yakin logout?')" type="submit" ><i class="bi bi-hexagon-fill"></i>
                <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>
