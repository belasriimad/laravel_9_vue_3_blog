<nav class="navbar navbar-expand-lg bg-white rounded shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('admin.index')}}">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('admin.index')}}">
                <i class="fas fa-home"></i> 
                @if(session()->get('lang') === 'fr')
                    Accueil
                    @else
                    Home
                @endif
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="fas fa-users"></i> 
                Account
            </a>
            <ul class="dropdown-menu">
                @if(auth()->guard('admin')->check())
                    <li><a class="dropdown-item" href="#">{{auth()->guard('admin')->user()->name}}</a></li>
                    <li>
                        <a class="dropdown-item" href="#" 
                            onclick="document.getElementById('adminLogout').submit();"><i class="fas fa-sign-out"></i> 
                            Logout
                        </a>
                    </li>   
                    <form id="adminLogout" action="{{route('admin.logout')}}" method="POST">
                    @csrf
                    </form>
                @endauth
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>
