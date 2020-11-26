
   @extends('layout')

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste Etats de reservation</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('etatreservations.create') }}">
                            Nouvelle etat de reservation
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Etat de reservation</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($etatres as $value)
                            <tr>
                                <td>{{$value->libelle }}</td>
                                <td>
                                    <a href="{{ route('etatreservations.edit', ['id' => $value->id]) }}"
                                       class="btn btn-sm btn-primary"
                                    >
                                        <span class="fa fa-pencil-alt"></span>
                                    </a>

                                    <a href="{{ route('etatreservations.delete', ['id' =>  $value->id]) }}"
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


                               


