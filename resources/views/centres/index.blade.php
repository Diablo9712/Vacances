
@extends('layout')

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste centres</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('centres.create') }}">
                            Nouveau centre
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
                          <th>Nom du centre</th>
                          <th>Adresse</th>
                          <th>Tel</th>
                          <th>Nom responsable</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($centres as $value)
                            <tr>
                                <td>{{$value->ville->libelle }}</td>
                                <td>{{$value->libelle }}</td>
                                <td>{{$value->adresse }}</td>
                                <td>{{$value->tel }}</td>
                                <td>{{$value->assistant }}</td>
                                <td>
                                    <a href="{{ route('centres.edit', ['id' => $value->id]) }}"
                                       class="btn btn-sm btn-primary"
                                    >
                                        <span class="fa fa-pencil-alt"></span>
                                    </a>

                                    <a href="{{ route('centres.delete', ['id' =>  $value->id]) }}"
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





