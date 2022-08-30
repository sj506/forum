<style>
    a {color: black; text-decoration: none}
</style>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('forum') }}">Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/category">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/write">Write</a>
        </li>
      </ul>
    </div>
      @auth
      
    <div class="dropdown-center">
      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ Auth::user()->name }}
      </button>
      <ul class="dropdown-menu">
        <li>       
          <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link class="w-25" :href="route('logout')"
              onclick="event.preventDefault();
              this.closest('form').submit();">
              {{ __('Log Out') }}
              </x-dropdown-link>
          </form>
        </li>
      </ul>
    </div>
      @endauth
  </div>
</nav>
