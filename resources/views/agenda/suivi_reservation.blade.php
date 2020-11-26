
   @extends('layout')

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">suivi reservation</h3>
                    
                </div>
                <!-- /.card-header -->
                <div class="card">
            <div class="card-header">
             
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>ville</th>
                  <th>Date Debut</th>
                  <th>Date Fin</th>
                  <th>Etat</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reservations as $fiche)
                          
                          <?php $debut = $fiche->date_debut;
                          $fin = $fiche->date_fin;
 
                          $datetime1 = new DateTime($debut);
                          $datetime2 = new DateTime($fin);
                          $interval = $datetime1->diff($datetime2);
                          $days = $interval->format('%d');
                          ?>
                <tr>
                  <td>{{$fiche->id }}</td>
                  <td>{{$fiche->libelle }}
                  </td>
                  <td>{{$fiche->date_debut }}</td>
                  <td> {{$fiche->date_fin }}</td>
                  <td>{{$fiche->l2 }}</td>
                
                  <td>
                  @if ($fiche->id_Etat != 1 )
                  <a href="{{route('agenda.fiche',['id'=>$fiche->idr])}}" 
                    class="btn btn-sm btn-primary" ><span class="fa fa-search"></span> Details </a>
                    @endif
                    @php
                      $now = new DateTime();
                      $fin = date_create_from_format('Y-m-d', $fiche->date_fin);

                      $diff = (int)$now->diff($fin)->format("%r%a");
 

                    @endphp
                    @if ($fiche->l2 != 'Annuler' && $fiche->id_Etat != 1 && $diff > 0)
                      <a href="{{route('agenda.annuler',['id'=>$fiche->id])}}"  
                      class="btn btn-sm btn-danger" ><span class="fa fa-trash"></span> Annuler </a>
                    @endif
                    @if (  $fiche->id_Etat == 1)
                      <a href="{{route('reservations.delete',['id'=>$fiche->idp])}}"  
                      class="btn btn-sm btn-danger" ><span class="fa fa-trash"></span> Annuler </a>
                    @endif
                  </td>
                </tr>
                @endforeach
         
           
                </tbody>
                <tfoot>
                <tr>
                  <th>id</th>
                  <th>ville</th>
                  <th>Date Debut</th>
                  <th>Date Fin</th>
                  <th>Etat</th>
                  <th>Details</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>

@endsection


                               


