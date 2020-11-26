@extends('layout')

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des utlisateurs</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('user.new') }}">
                            Nouveau utilisateur
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Email d'utilisateur</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->nom }}</td>
                                <td>
                                    <a href="{{ route('user.profile.edit', ['user' => $user]) }}"
                                       class="btn btn-sm btn-primary"
                                    >
                                        <span class="fa fa-pencil-alt"></span>
                                    </a>

                                    <a href="{{ route('user.profile.delete', ['user' => $user]) }}"
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
                <!-- /.card-body -->
                {{--                <div class="card-footer clearfix">--}}
                {{--                    <ul class="pagination pagination-sm m-0 float-right">--}}
                {{--                        <li class="page-item"><a class="page-link" href="#">«</a></li>--}}
                {{--                        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
                {{--                        <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                {{--                        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                {{--                        <li class="page-item"><a class="page-link" href="#">»</a></li>--}}
                {{--                    </ul>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>

@endsection
