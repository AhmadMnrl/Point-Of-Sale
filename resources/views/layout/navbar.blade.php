<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
      </ul>
  </form>
  <ul class="navbar-nav navbar-right">
      @if(auth()->user()->level === 'admin')
      <!-- Notification Icon -->
      <li class="nav-item dropdown">
          <a href="#" class="nav-link nav-link-lg" data-toggle="dropdown">
              <i class="fas fa-bell"></i>
              @if(isset($pendingRequests) && $pendingRequests > 0)
              <span class="badge badge-warning">{{ $pendingRequests }}</span>
              @endif
          </a>
          <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-header">Notifications</div>
              @if(isset($pendingRequests) && $pendingRequests > 0)
              <a href="/requests" class="dropdown-item has-icon">
                  <i class="fas fa-envelope"></i> {{ $pendingRequests }} New Requests
              </a>
              @else
              <a href="#" class="dropdown-item has-icon">
                  <i class="fas fa-envelope"></i> No New Requests
              </a>
              @endif
          </div>
      </li>
      @endif

      <li class="dropdown">
          <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->nama }}</div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
              <a href="/{{ auth()->user()->level }}/profile/{{ auth()->user()->id }}" class="dropdown-item has-icon">
                  <i class="fas fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="/logout" class="dropdown-item has-icon text-danger">
                  <i class="fas fa-sign-out-alt"></i> Logout
              </a>
          </div>
      </li>
  </ul>
</nav>
