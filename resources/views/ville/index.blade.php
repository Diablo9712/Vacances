@extends('layout')

  @section('body')

      <div class="row">
          <div class="col-lg-12">
              <div class="card">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message')}}</div>
                @endif
                  <div class="card-header">
                      <h3 class="card-title">Liste des villes
                      </h3>
                      <div class="card-tools">
                          <a class="btn btn-primary" href="{{ url('ville/create') }}">
                              Nouvelle ville
                              <i class="fa fa-plus"></i>
                          </a>
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table class="table table-bordered">
                          <thead>
                          <tr>
                              <th>Ville</th>
                              <th>Actions</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach ($villes as $ville)
                              <tr>
                                  <td>{{$ville->libelle  }}</td>
                                  <td>
                                      <a href="{{ url('ville/'.$ville->id.'/edit') }}"
                                         class="btn btn-sm btn-primary"
                                      >
                                          <span class="fa fa-pencil-alt"></span>
                                      </a>



                                     <a href="{{ route('ville.destroy', ['id' =>  $ville->id]) }}"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Confirmation de suppression')"
                                     >
                                         <span class="fa fa-trash"></span>
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








