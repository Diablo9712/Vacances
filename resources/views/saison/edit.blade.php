

          
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
                    <h3 class="card-title">Modifier une saison</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                   



                  <form role="form"  action="{{ url('saison/'.$saison->id) }}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">

                    <div class="card-body">
                     
                      <div class="form-group">
                        <label >Date Début</label>
                        <input type="date" name="debut" class="form-control" value="{{ $saison->date_debut }}">
                      </div>
                      <div class="form-group">
                        <label >Date Fin</label>
                        <input type="date" name="fin" class="form-control" value="{{ $saison->date_fin }}">
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

