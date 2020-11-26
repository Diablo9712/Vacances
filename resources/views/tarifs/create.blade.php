@extends('layout')
@section('body')

@php 
$name='Ajouter';
$valu1='';
$valu2='';
$action=url('tarifs/insert');
@endphp
@if(isset($tarif))
@php 
$name='Modifier';
$valu1=$tarif->mhs;
$valu2=$tarif->mbs;
$action=url('tarifs/updat');
@endphp
@endif

<div class="card card-info">
              <div class="card-header">
                 
                 <h3 class="card-title">Tarif/{{$name}}</h3>
               
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" class="form-horizontal"  action="{{ $action}}" method="POST">
              {{csrf_field()}}
                <div class="card-body">
               
                      <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ville</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="ville" id="ville">
                        @if(isset($ville))
                    @foreach($ville as $value)
                          <option value="{{$value->id}}"> {{$value->libelle }} </option>
                         
                          @endforeach
                          @else
                          <option value="{{$tarif->id_ville}}"> {{$tarif->ville }} </option>
@endif
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Haute saison</label>
                    <div class="col-sm-10">
                      <input type="number" step="0.01" name="1" class="form-control" id="inpuths" placeholder="00.00"  value="{{$valu1}}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Bas Saison</label>
                    <div class="col-sm-10">
                      <input type="number" step="0.01" name="2" class="form-control" id="inputbs" placeholder="00.00" value="{{$valu2}}">
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Valider</button>
                  <button type="reset" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
         
@endsection
