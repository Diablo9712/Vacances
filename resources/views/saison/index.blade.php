
  @extends('layout')

  @section('body')
  
      <div class="row">
          <div class="col-lg-12">
              <div class="card">

                @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message')}}</div>
            @endif



                  <div class="card-header">
                      <h3 class="card-title">Liste des saisons
                      </h3>
                      <div class="card-tools">
                          <a class="btn btn-primary" href="{{ url('saison/create') }}">
                              Nouvelle saison
                              <i class="fa fa-plus"></i>
                          </a>
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table class="table table-bordered">
                          <thead>
                          <tr>
                              <th>Date Début</th>
                            <th>Date Fin</th>
                              <th>Actions</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach ($saisons as $saison)
                              <tr>
                                <td>{{ $saison->date_debut }}</td>
                                <td>{{ $saison->date_fin  }}</td>
                                  <td>
                                      <a href="{{ url('saison/'.$saison->id.'/edit') }}"
                                         class="btn btn-sm btn-primary"
                                      >
                                          <span class="fa fa-pencil-alt"></span>
                                      </a>
  
                                  
                     
                                    


                                     
                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>
                
              </div>
          </div>
      </div>
  
  @endsection
  
  
                                 
  
  



  