<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard') }}" class="brand-link">
          <img src="{{ asset('asset/dist/img/AdminLTELogo.png') }}" alt="CodeSprintX Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">CodeSprintX</span>
      </a>


      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  @if(Auth::user()->profile_picture)
                      <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="img-circle elevation-2"
                          alt="User Image" style="width: 34px; height: 34px; object-fit: cover;">
                  @else
                      <img src="{{ asset('asset/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                          alt="User Image">
                  @endif
              </div>
              <div class="info">
                  <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
              </div>
          </div>


          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">


                  <li class="nav-item">
                      <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                              {{-- <span class="right badge badge-danger">New</span> --}}
                          </p>
                      </a>
                  </li>

                  {{-- Single Menu --}}
                  <li class="nav-item">
                      <a href="{{ route('courses.index') }}" class="nav-link {{ request()->is('courses*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-suitcase"></i>
                          <p>
                              Courses
                          </p>
                      </a>
                  </li>

                  {{-- Testimonials Menu --}}
                  <li class="nav-item">
                      <a href="{{ route('testimonials.index') }}" class="nav-link {{ request()->is('testimonials*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-comments"></i>
                          <p>
                              Testimonials
                          </p>
                      </a>
                  </li>

                  {{-- Profile Menu --}}
                  <li class="nav-item">
                      <a href="{{ route('profile.show') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              My Profile
                          </p>
                      </a>
                  </li>

                  {{-- Logout Menu --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>

                  {{-- Multiple Menu(Submenu) --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                              Tables
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="pages/tables/simple.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Simple Tables</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/tables/data.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>DataTables</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/tables/jsgrid.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>jsGrid</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  {{-- <li class="nav-header">EXAMPLES</li> --}}


              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
