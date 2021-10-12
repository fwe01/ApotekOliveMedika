<li class="nav-item">
    <a href="{{route('admin.dashboard')}}"
       class="nav-link {{ route('admin.dashboard') == request()->url() ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p class="text">Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.accounts.index')}}"
       class="nav-link {{ route('admin.accounts.index') == request()->url() ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p class="text">Accounts</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.barangs.index')}}"
       class="nav-link {{ route('admin.barangs.index') == request()->url() ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p class="text">Barang</p>
    </a>
</li>
<li class="nav-item">
    <a href="javascript: logout()" class="nav-link ">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p class="text">Logout</p>
    </a>
    <form action="{{route('auth.logout')}}" method="post" name="logoutForm" class="d-none">
        @csrf
    </form>
    <script>
        function logout() {
            document.logoutForm.submit();
        }
    </script>
</li>