<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="#">{{ $titlePage }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navbarText">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarText">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">dashboard</i>
            <p class="d-lg-none d-md-block">
              {{ __('Stats') }}
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.show', auth()->user()->id) }}" id="navbarDropdownProfile">
            <i class="material-icons">person</i>
            <!--<p class="d-lg d-md-block">
              Salir
            </p>-->
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" id="navbarDropdownProfile" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i>Salir</i>
            <!--<i class="material-icons">person</i>
            <p class="d-lg d-md-block">
              Salir
            </p>-->
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>