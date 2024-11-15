<nav class="navbar fixed-top">
    <div class="container-fluid">
    <a class="navbar-brand ms-5" href="#">
        <img src="img/National Geographic Logo and symbol, meaning, history, PNG, brand.jpeg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        Nature
    </a>
    <a href=""></a>
    <button class="navbar-toggler mx-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">How?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-li'[nk active" aria-current="page" href="{{route('home')}}" style="text-decoration: none;">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('about')}}">About</a>
            </li>
            <li>
              <a class="nav-link" href="{{route('contact')}}">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>