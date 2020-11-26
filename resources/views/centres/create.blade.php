

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
                    <h3 class="card-title">Ajouter un nouveau centre</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">





                  <form role="form"  action="{{ route('centres.insert') }}" method="post">
                    {{csrf_field()}}
                    <div class="card-body">
                      <div class="form-group">
                        <label >Ville</label>
                        <select name="id_ville" id="id_ville" class="form-control">


                          <option value="">Veuillez choisir la ville </option>
                          @foreach ($villes as $ville)
                               <option value="{{$ville->id}}">{{$ville->libelle  }}</option>
                          @endforeach

                        </select>
                      </div>
                      <div class="form-group">
                        <label >Nom centre</label>
                        <input type="text" name="libelle" class="form-control">
                      </div>
                      <div class="form-group">
                        <label >Adresse</label>
                        <input type="text" name="adresse" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label >Tel</label>
                        <input type="text" name="tel" class="form-control">
                      </div>
                      <div class="form-group">
                        <label >Nom responsable</label>
                        <input type="text" name="assistant" class="form-control" >
                      </div>


                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>

                  </form>





                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
@endsection

