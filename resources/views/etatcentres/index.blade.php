
   @extends('layout')

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste Etats du centre</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('etatcentres.create') }}">
                            Nouvelle etat du centre
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Etat du centre</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($etatres as $value)
                            <tr>
                                <td>{{$value->libelle }}</td>
                                <td>
                                    <a href="{{ route('etatcentres.edit', ['id' => $value->id]) }}"
                                       class="btn btn-sm btn-primary"
                                    >
                                        <span class="fa fa-pencil-alt"></span>
                                    </a>

                                    <a href="{{ route('etatcentres.delete', ['id' =>  $value->id]) }}"
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


                               


