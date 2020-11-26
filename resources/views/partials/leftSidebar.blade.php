<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ URL::asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">E-Vacances</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ URL::asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('user.profile.edit', ['user' => Auth::user()->id]) }}" class="d-block">{{ Auth::user()->nom }}</a>
        </div>
      </div>


 <!-- Sidebar Menu Utilisateurs   -->
 <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview">
      <a href="{{ route('user.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-calendar"></i>
        <p>
          Reservations
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>

      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('reservations.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Nouveau reservation </p>
          </a>
        </li>
      </ul>

      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('agenda.suivi_reservation') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Suivi reservation</p>
          </a>
        </li>
      </ul>

      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('agenda.reclamation') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Reclamation</p>
          </a>
        </li>
      </ul>

      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('agenda.avis') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Avis</p>
          </a>
        </li>
      </ul>

    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->


      <!-- Sidebar Menu Utilisateurs   -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ route('user.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Utilisateurs
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->


       <!-- Sidebar Menu  Etat reservation -->
       <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ route('etatreservations.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Etats reservation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('etatreservations.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

       <!-- Sidebar Menu  Etat centre -->
       <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ route('etatcentres.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Etats centre
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('etatcentres.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
       <!-- Sidebar Menu Centres -->
       <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ route('centres.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
               Centres
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('centres.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

       <!-- Sidebar Menu villes -->
       <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ route('ville.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
               Villes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ville.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

         <!-- Sidebar Menu Saison -->
         <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="{{ route('saison.index') }}" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Saisons
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('saison.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Liste</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->

          <!-- Sidebar Menu Tarif -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview">
                <a href="{{ route('tarifs.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Tarifs
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('tarifs.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Liste</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
  </aside>
