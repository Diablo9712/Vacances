          
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
                    <h3 class="card-title">Modifier une etat du centre</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                   



                  <form role="form"  action="{{ route('etatcentres.update') }}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="id" class="form-control" value="{{ $value->id }}">
        
                    <div class="card-body">
                      <div class="form-group">
                        <label >Etat centre</label>
                        <input type="text" name="libelle" class="form-control" value="{{ $value->libelle }}">
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

