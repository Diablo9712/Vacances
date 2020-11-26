<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::any('/user/profile/{user}/edit', 'ProfileController@update')->name('user.profile.edit');
    Route::any('/user/profile/{user}/delete', 'ProfileController@delete')->name('user.profile.delete');
    Route::any('/users', 'ProfileController@index')->name('user.index');
    Route::match(['GET', 'POST'], '/user/new', 'ProfileController@new')->name('user.new');

    Route::get('etatreservations', 'EtatreservationController@index')->name('etatreservations.index');
    Route::get('etatreservations/create', 'EtatreservationController@create')->name('etatreservations.create');
    Route::get('etatreservations/edit/{id}', 'EtatreservationController@edit')->name('etatreservations.edit');
    Route::post('etatreservations/insert', 'EtatreservationController@insert')->name('etatreservations.insert');
    Route::get('etatreservations/delete/{id}', 'EtatreservationController@delete')->name('etatreservations.delete');
    Route::post('etatreservations/update', 'EtatreservationController@update')->name('etatreservations.update');


    Route::get('centres', 'CentreController@index')->name('centres.index');
    Route::get('centres/create', 'CentreController@create')->name('centres.create');
    Route::get('centres/edit/{id}', 'CentreController@edit')->name('centres.edit');
    Route::post('centres/insert', 'CentreController@insert')->name('centres.insert');
    Route::get('centres/delete/{id}', 'CentreController@delete')->name('centres.delete');
    Route::post('centres/update', 'CentreController@update')->name('centres.update');


//     Route::get('ville','VilleController@index');
//     Route::get('ville/create','VilleController@create');
//     Route::post('ville','VilleController@store');
//     Route::get('ville/{id}/edit','VilleController@edit');
//     Route::put('ville/{id}','VilleController@update');
//     Route::post('ville/{id}','VilleController@destroy');

//     Route::get('saison','SaisonController@index');
//     Route::get('saison/create','SaisonController@create');
//     Route::post('saison','SaisonController@store');
//     Route::get('saison/{id}/edit','SaisonController@edit');
//     Route::put('saison/{id}','SaisonController@update');
//     Route::post('saison/{id}','SaisonController@destroy');
//==============================tarifs============================
    Route::get('tarifs','TarifsController@index')->name('tarifs.index');
    Route::get('tarifs/create','TarifsController@create')->name('tarifs.create');
    Route::post('tarifs/insert', 'TarifsController@insert')->name('tarifs.insert');
    Route::get('tarifs/edite/{id}', 'TarifsController@edite')->name('tarifs.edite');
    Route::post('tarifs/updat', 'tarifsController@updat')->name('tarifs.updat');

    Route::get('ville','VilleController@index')->name('ville.index');
    Route::get('ville/create','VilleController@create')->name('ville.create');
    Route::post('ville','VilleController@store')->name('ville.store');
    Route::get('ville/{id}/edit','VilleController@edit')->name('ville.edit');
    Route::put('ville/{id}','VilleController@update')->name('ville.update');
    Route::get('ville/{id}','VilleController@destroy')->name('ville.destroy');

    Route::get('saison','SaisonController@index')->name('saison.index');
    Route::get('saison/create','SaisonController@create')->name('saison.create');
    Route::post('saison','SaisonController@store')->name('saison.store');
    Route::get('saison/{id}/edit','SaisonController@edit')->name('saison.edit');
    Route::put('saison/{id}','SaisonController@update')->name('saison.update');
    Route::get('saison/{id}','SaisonController@destroy')->name('saison.destroy');


    Route::get('etatcentres', 'EtatcentreController@index')->name('etatcentres.index');
    Route::get('etatcentres/create', 'EtatcentreController@create')->name('etatcentres.create');
    Route::get('etatcentres/edit/{id}', 'EtatcentreController@edit')->name('etatcentres.edit');
    Route::post('etatcentres/insert', 'EtatcentreController@insert')->name('etatcentres.insert');
    Route::get('etatcentres/delete/{id}', 'EtatcentreController@delete')->name('etatcentres.delete');
    Route::post('etatcentres/update', 'EtatcentreController@update')->name('etatcentres.update');


    Route::get('agenda', 'AgendaController@index')->name('agenda.index');
    Route::get('agenda/nouveau_reservation', 'AgendaController@nouveau_reservation')->name('agenda.nouveau_reservation');
    Route::get('agenda/suivi_reservation', 'AgendaController@suivi_reservation')->name('agenda.suivi_reservation');
    Route::get('agenda/reclamation', 'AgendaController@reclamation')->name('agenda.reclamation');
    Route::get('agenda/avis', 'AgendaController@avis')->name('agenda.avis');
    Route::get('agenda/{id}/annuler', 'AgendaController@annuler')->name('agenda.annuler');
    Route::get('agenda/{id}/fiche', 'AgendaController@fiche')->name('agenda.fiche');
//=========================================================================================================================
    Route::get('reservations','ResrvationController@index')->name('reservations.index');
    Route::POST('reservations','ResrvationController@store')->name('reservations.store');
    Route::POST('reservations','ResrvationController@store2')->name('reservations.store2');
//=================================================================================================================
    Route::DELETE('reservations','ResrvationController@delete')->name('reservations.delete');
    Route::GET('availabledates/{id?}','ResrvationController@getAvailableDates')->name('reservations.available_dates');
});

