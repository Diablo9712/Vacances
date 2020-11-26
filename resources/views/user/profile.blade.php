@extends('layout')

@section('title')
    Profile de {{ $user->name }}
@endsection

@section('body')
    <div class="row">
        <!-- left column -->
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Mon profile</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    {!! form_start($form) !!}
                        {!! form_row($form->email) !!}
                        {!! form_row($form->password) !!}
                        {!! form_row($form->nom) !!}
                        {!! form_row($form->numero) !!}
                        {!! form_row($form->cin) !!}
                        {!! form_row($form->address) !!}
                        {!! form_row($form->tel) !!}
                        {!! form_row($form->user_details->matricule) !!}
                        {!! form_row($form->user_details->date_embauche) !!}
                        {!! form_row($form->user_details->situation) !!}
                        {!! form_row($form->user_details->nbr_enfants) !!}
                        <h3>Fonctions d'utilisateurs</h3>
                        <hr>
                        <div class="collection-container"
                             data-prototype="{{ form_row($form->user_details->user_fonctions->prototype()) }}">
                            {!! form_row($form->user_details->user_fonctions) !!}
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-info pull-right add-to-collection">
                                    Ajouter fonction
                                    <span class="fa fa-plus"></span>
                                </button>
                            </div>
                        </div>
                        {!! form_row($form->submit) !!}

                    {!! form_end($form) !!}

                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
@endsection

@section('javascripts')
    <script>
        $(document).ready(function() {
            // add remove buttons to each one of the collection, don't know how to do it in PHP
            let $container = $('.collection-container');
            $container.find('label').each(function (e) {
                $el = $(
                    `<a class="btn btn-sm btn-danger pull-right">
                    <span class="fa fa-times" style="color: white"></span>
                </a>`
                );
                // add event listener
                $el.click(function (e) {
                    e.preventDefault();
                    let that = $(this)
                    that.parent('.form-group').parent('.form-group').fadeOut("fast", function () {
                        $(this).remove()
                    });
                });

                $el.insertAfter($(this))
            });

            $('.add-to-collection').on('click', function(e) {
                e.preventDefault();
                var container = $container;
                var count = container.children().length;
                var proto = container.data('prototype').replace(/__NAME__/g, ++count);
                container.append(proto);
                // debugger
            });
        });
    </script>
@endsection
