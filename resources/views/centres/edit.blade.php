

@extends('layout')

@section('title')


@endsection

@section('body')
    <div class="row">
        <!-- left column -->
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modifier un centre</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">





                  <form role="form"  action="{{ route('centres.update') }}" method="post">
                    {{csrf_field()}}
                      <div class="card-body">

                 <input type="hidden" name="id" class="form-control" value="{{ $value->id }}">

                 <div class="form-group">
                     <label >Ville</label>
                     <label >Ville</label>
                        <select name="id_ville" id="id_ville" class="form-control">


                          <option value="">Veuillez choisir la ville </option>
                          @foreach ($villes as $ville)

                               @if ($ville->id==$value->ville_id)
                                       <option selected value="{{$ville->id  }}">{{$ville->libelle  }}</option>
                               @else
                                       <option value="{{$ville->id }}">{{$ville->libelle  }}</option>
                               @endif


                          @endforeach

                        </select>

                  </div>

                  <div class="form-group">
                    <label >Nom centre</label>
                    <input type="text" name="libelle" class="form-control" value="{{ $value->libelle }}">
                  </div>
                  <div class="form-group">
                    <label >Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="{{ $value->adresse }}">
                  </div>
                  <div class="form-group">
                    <label >Tel</label>
                    <input type="text" name="tel" class="form-control" value="{{ $value->tel }}">
                  </div>
                  <div class="form-group">
                    <label >Nom responsable</label>
                    <input type="text" name="nom_responsable" class="form-control" value="{{ $value->assistant }}">
                  </div>


                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>

                  </form>





                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
@endsection






