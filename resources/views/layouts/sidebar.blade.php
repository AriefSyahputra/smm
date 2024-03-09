<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('departement') || request()->is('departement/*') ? '' : ' collapsed' }}" href="{{ url('departement') }}">
                <i class="bi bi-building"></i>
                <span>Departement</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('employee') || request()->is('employee/*') ? '' : ' collapsed' }}" href="{{ url('employee') }}">
                <i class="bi bi-people"></i>
                <span>Employee</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('product') || request()->is('product/*') ? '' : ' collapsed' }}" href="{{ url('product') }}">
                <i class="bi bi-tags"></i>
                <span>Product</span>
            </a>
        </li>
        <li class="nav-heading">Transaction</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('purchase') || request()->is('purchase/*') ? '' : ' collapsed' }}" href="{{ url('purchase') }}">
                <i class="bi bi-bag-plus"></i>
                <span>Purchase</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('order') || request()->is('order/*') ? '' : ' collapsed' }}" href="{{ url('order') }}">
                <i class="bi bi-cart-check"></i>
                <span>Order</span>
            </a>
        </li>
        <li class="nav-heading">Settings</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('my-profile') || request()->is('my-profile/*') ? '' : ' collapsed' }}" href="{{ url('my-profile') }}">
                <i class="bi bi-person-circle"></i>
                <span>My Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</aside>
