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
                    <h3 class="card-title">Ajouter une nouvelle etat du centre</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                   




                  <form role="form"  action="{{ route('etatcentres.insert') }}" method="post">
                    {{csrf_field()}}
                    <div class="card-body">
                      <div class="form-group">
                        <label >Etat de centre</label>
                        <input type="text" name="libelle" class="form-control" >
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

