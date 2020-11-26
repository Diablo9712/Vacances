@extends('layout')

             @section('body')
             @if(isset($controle) && $controle!=false)
             @php
             $t=\Carbon\Carbon::parse($controle->date_debut)->format('d/m/Y');
             $t2=\Carbon\Carbon::parse($controle->date_fin)->format('d/m/Y');
             @endphp
            
             <div class="card">
              <div class="ribbon bg-danger text-xl">
                Nouveau
              </div>
              <div class="card-body">

                <p class="card-text">
              

                  les demandes de réservation de haute saison de {{$t }} a {{$t2 }}  sont ouvertes! Soyez tenté la chance pour un congé magnifique.
             
                </p>
              </div>
            </div>
          
                @endif
               
                @if(($reservation->count()!=0 && $reservation[0]->id_Etat==2) || ($reservation->count()>=4))
                @php
                $message='';
                $reservation1=$reservation[0];
                @endphp
                
                @if($reservation1->id_Etat==2)
                @php
                $message='Vous avez deja une reservation Valide';
                @endphp
                @elseif($reservation->count()==4){
                    @php
                $message='Vous avez deja 4 Priorites';
                @endphp
@endif
                <div class="alert alert-info alert-dismissible">
                  <h5><i class="icon fas fa-info"></i> Alert!</h5>
                 {{$message}}.
                </div>
                @endif
                
                
    <!-- ///============================================================= -->
    <div id="msg" class="alert alert-danger alert-dismissible" style="display:none;">
                  <button type="button" class="close"  id="close">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  KHTAR CHI DATE M9ADA

                </div>
    <!-- ///============================================================= -->
    <div class="row">
        <div id="resultat">
            <!-- Nous allons afficher un retour en jQuery au visiteur -->
        </div>

        <!-- left column -->
        <div class="col-md-7">
            <!-- general form elements -->
            <div class="card card-primary villes">
                <div class="card-header">
                    <h3 class="card-title">Resrvation</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <form id="form">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group">
                                <label>ville</label>
                                <select class="form-control" name="ville" id="ville">
                                    @if(isset($ville))
                                        @foreach($ville as $value)
                                            <option value="{{$value->id}}"> {{$value->libelle }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Date Début</label>
                                <input type="date" name="debut" id="debut" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Date Fin</label>
                                <input type="date" name="fin" id="fin" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer">
                        @if ($reservation->count()==0 || ($reservation[0]->id_Etat==1 && $reservation->priorites->count()<=3 ) )
                            <button type="button" id="submit" class="btn btn-info">Valider</button>
                        @endif
                            <button type="reset" class="btn btn-default float-right">Cancel</button>
                        </div>
                    </form>
                    <div class="form-group table">
                        <table class="table table-bordered table" id="table">
                            <thead>
                            <tr>
                                <th>Villes</th>
                                <th>debut</th>
                                <th>fin</th>
                            
                            </tr>
                            </thead>
                            
                            @if ($reservation->count() > 0)
                                @foreach ($reservation->priorites as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>{{ $item->libelle }}</td>
                                        <td>{{ $item->date_debut }}</td>
                                        <td>{{ $item->date_fin }}</td>
                                      
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>

        <div class="col-md-5">
            <div class="card card-success dates">
                <div class="card-header">
                    <h3 class="card-title">Dates Disponibles</h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="available-dates">

                    <table width="100%"></table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        @endsection

        @section('javascripts')
            <script>

                $(document).ready(function () {

                    const $ville = $('#ville');
                    setTimeout(() => {
                        $ville.change();
                    }, 1)


                    $ville.change(function (event) {
                        event.preventDefault();
                        getAvailableDates(event.target.value);
                    })

                    setRemoveButtonsEvent();

                    $("#submit").click(function (e) {
                        e.preventDefault();
                        var ville = $("#ville option:selected");
                        var debut = $("#debut").val();
                        var fin = $("#fin").val();
                        var today = new Date();

                        var difDat = myFunction(debut, fin);
                        var difDatValid = myFunction(today,fin);
                        //alert(difDat);
                        function myFunction(d1, d2) {
                            var d1=new Date(debut);
                            var d2=new Date(fin);
                            d1 = d1.getTime() / 86400000;
                          d2 = d2.getTime() / 86400000;
                          return new Number(d2 - d1).toFixed(0);
                        }

                        var _token = $("input[name='_token']").val();

                        const url = "{{ route('reservations.store2') }}";
                        const data = {
                            ville: ville.val(),
                            debut,
                            fin
                        };

                  if((difDatValid>=0 && difDatValid<93) && (difDat>2 && difDat<16)){
                    $.ajax({
                        url,
                        method: 'POST',
                        data,
                        success: function (data) {                          
                           // window.location.href = "agenda/"+data['id']+"/fiche";
                            var table = $("<tr data-id='" + data.id + "'> <td>" + ville.text() + "</td> <td>" + debut + "</td> <td>" + fin + "</td>  </tr>");
                            $("#table").append(table);
                            const id = table.data('id');
                            setEventHandlerOnClickAndRemove(table, id);
                        },
                        error: function (data) {
                            document.getElementById('msg').style.display = "block";
                        }
                    })
                  }
                  else{

                      document.getElementById('msg').style.display = "block";
                  }
               });
                    $("#close").click(function (e) {
                        document.getElementById('msg').style.display = "none";
                    });

                    function setEventHandlerOnClickAndRemove(item, id) {
                        $(item).unbind();
                        $(item).on('click', function (event) {
                            if (!confirm("Confirmation du suppression")) return false;
                            let item = $(this);
                            event.preventDefault();
                            var url = "{{ route("reservations.delete") }}";

                            url = new URL(url);
                            url.searchParams.append('id', id);
                            $.ajax({
                                url,
                                method: "DELETE",
                                success: function (data) {
                                    if (data === true) {
                                        item
                                            .closest('tr')
                                            .animate({width: 0, opacity: 0}, 'slow', function () {
                                                $(this).remove();
                                            });
                                    }
                                },
                                error: function (error) {
                                    alert(error.responseText)
                                }
                            })
                        });
                    }

                    function setRemoveButtonsEvent() {
                        $('.delete-button').each(function (index, item) {
                            setEventHandlerOnClickAndRemove(item, $(item).parents('tr').data('id'));
                        })
                    }

                    function getAvailableDates(id) {
                        const cardDates = $('.card.dates');
                        const cardVilles = $('.card.villes');
                        toggleLoading(cardDates);
                        toggleLoading(cardVilles);
                        let url = "{{ route('reservations.available_dates') }}"

                        $.ajax({
                            url: `${url}/${id}`,
                            method: "GET",
                            success: function (data) {

                                let $body = $('#available-dates table');
                                $body.empty();
                                let template = ``;

                                if (!data.length) {
                                    template = 'Tous les dates disponibles.';
                                } else {

                                    for (let item in data) {
                                        template += ``;
                                        template += `<tr>
                                       <td>
                                            ${new Date(data[item].debut).toLocaleDateString()}
                                       </td>
                                       <td>
                                            ${new Date(data[item].fin).toLocaleDateString()}
                                       </td>
                                    </tr>
                                    `;
                                    }
                                }
                                $body.html(template);
                                toggleLoading(cardDates);
                                toggleLoading(cardVilles);
                            },
                            error: function (error) {
                                alert(error)
                            }
                        })
                    }

                    function toggleLoading($el) {

                        if ($el.find('.overlay').length) {
                            $el.find('.overlay').fadeOut("slow", function () {
                                $(this).remove()
                            });
                            return;
                        }
                        let $loader = `<div class="overlay dark" style=""><i class="fas fa-3x fa-sync-alt fa-spin"></i></div>`;

                        $el.append($loader)
                    }
                });
            </script>
@endsection
