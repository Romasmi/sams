<header class="header">
  <nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
      <div class="top-left-part">
        <a class="logo" href="{{route('dashboard')}}">
          <b>
          <img src="/image/sams_logo.png" alt="SAMS"/>
          </b>
          <span class="hidden-xs">
            <img src="/image/sams_text.png" alt="SAMS" />
          </span>
        </a>
      </div>
      <!-- /Logo -->
      <ul class="nav navbar-top-links navbar-right pull-right">
        <li>
          <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg"
             href="javascript:void(0)"><i class="fa fa-bars"></i></a>
        </li>
        <li>
          <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
            <input type="text" placeholder="Поиск..." class="form-control"> <a href=""><i
                      class="fa fa-search"></i></a></form>
        </li>
        <li>
          <a class="profile-pic" href="#">
            <b class="hidden-xs">{{ Auth::user()->name }}</b>
            <span class="fa fa-angle-down"></span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>
