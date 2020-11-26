@extends('layout')
@section('body')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
<div class="card">

              <div class="card-header">
                <h3 class="card-title">Tarifs</h3>


              <ul class="pagination pagination-sm m-0 float-right">
              <a href="{{ url('tarifs/create') }}" class="btn btn-sm btn-primary">
                 <span class="fas fa-plus"></span>
                </a>
                                </ul>
            </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Villes</th>
                      <th>Haute saison</th>
                      <th>Bas saison</th>
                      <th style="width: 40px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($tarifVMs as $value)
                    <tr>
                      <td>{{$value->ville }}</td>
                      <td>{{$value->mhs }}</td>

                      <td>{{$value->mbs}}</td>

                      <td> <a href="{{ url('tarifs/edite',$value->id_v) }}" class="btn btn-sm btn-warning">
                 <span class="fa fa-pencil-alt"></span>
                </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>-->

            </div>
</div>
</div>
</div>
</section>
@endsection
