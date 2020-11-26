@extends('layout')

  @section('body')

  <h3 class="mt-4 mb-4">Reservations</h3>
  @foreach ($data as $fiche)

                          <?php $debut = $fiche->date_debut;
                          $fin = $fiche->date_fin;

                          $datetime1 = new DateTime($debut);
                          $datetime2 = new DateTime($fin);
                          $interval = $datetime1->diff($datetime2);
                          $days = $interval->format('%d');
                          ?>

<div class="row">
  <div class="col-md-4">
    <!-- Widget: user widget style 2 -->
    <div class="card card-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-warning">
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username">Reservation </h3>
        <h5 class="widget-user-desc">Information:</h5>
      </div>
      <div class="card-footer p-0">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a href="#" class="nav-link">
              Reference <span class="float-right badge bg-primary">{{$fiche->id_reservation }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              Ville <span class="float-right badge bg-info">{{$fiche->libelle }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              Date Debut <span class="float-right badge bg-success">{{$fiche->date_debut }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              Date Fin <span class="float-right badge bg-danger">{{$fiche->date_fin }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              Etat <span class="float-right badge bg-primary">{{$fiche->l2 }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              Date etat <span class="float-right badge bg-primary">{{ date('d-m-Y', strtotime($fiche->date_etat)) }}</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- /.widget-user -->
  </div>

  <!-- /.col -->
  <div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-info">
        <h3 class="widget-user-username">Centre</h3>
        <h5 class="widget-user-desc">Information:</h5>
      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">Adresse</h5>
              <span class="description-text">{{$fiche->adresse }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">Assistant</h5>
              <span class="description-text">{{$fiche->assistant }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">Telephone</h5>
              <span class="description-text">{{$fiche->tel }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  <!-- /.col -->
  <div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-info">
        <h3 class="widget-user-username">Tarif</h3>
        <h5 class="widget-user-desc">Information:</h5>
      </div>
      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">Nombre Jours</h5>
              <span class="description-text"><?php echo $days;?></span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->

          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">Penalite</h5>
              <span class="description-text">{{$fiche->montant_penalite}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->

          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">Totale</h5>
              <span class="description-text">{{$fiche->montant_reservation + $fiche->montant_penalite}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  <!-- /.col -->
</div>
@endforeach


  @endsection








