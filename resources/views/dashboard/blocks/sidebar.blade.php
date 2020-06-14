<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav slimscrollsidebar">
    <div class="sidebar-head">
      <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span
                class="hide-menu">Navigation</span></h3>
    </div>
    <ul class="nav" id="side-menu">
      <li  style="padding: 70px 0 0;">
        <a href="{{ route('dashboard') }}" class="waves-effect">
          <i class="fa fa-table fa-fw" aria-hidden="true"></i>
          Список сайтов
        </a>
      </li>
      <li>
        <a href="fontawesome.html" class="waves-effect"><i class="fa fa-area-chart fa-fw"
                                                           aria-hidden="true"></i>Статистика</a>
      </li>
      <li>
        <a href="dashboard.html" class="waves-effect"><i class="fa fa-clock-o fa-fw"
                                                         aria-hidden="true"></i>Уведомления</a>
      </li>
      <li>
        <a href="profile.html" class="waves-effect"><i class="fa fa-user fa-fw"
                                                       aria-hidden="true"></i>Profile</a>
      </li>
      <li>
        <a href="fontawesome.html" class="waves-effect"><i class="fa fa-font fa-fw"
                                                           aria-hidden="true"></i>Icons</a>
      </li>
      <li>
        <a href="map-google.html" class="waves-effect"><i class="fa fa-globe fa-fw"
                                                          aria-hidden="true"></i>Google Map</a>
      </li>
      <li>
        <a href="blank.html" class="waves-effect"><i class="fa fa-columns fa-fw"
                                                     aria-hidden="true"></i>Blank Page</a>
      </li>
      <li>
        <a href="404.html" class="waves-effect"><i class="fa fa-info-circle fa-fw"
                                                   aria-hidden="true"></i>Error 404</a>
      </li>
    </ul>
    <div class="center p-20">
      <a href="{{ route('addSite') }}" class="btn btn-danger btn-block waves-effect waves-light">Добавить сайт</a>
    </div>
  </div>
</div>
