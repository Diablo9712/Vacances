<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Centre;
use App\Ville;
use DB;

class CentreController extends Controller
{
    public function index()
    {
        //$villes = DB::table('villes')->get();
        $centres = Centre::all();
        return view('centres.index', compact('centres'));
    }

    public function create()
    {
        $villes = DB::table('villes')->get();
        return view('centres.create', compact('villes'));
    }

    public function insert(request $req)
    {
        $centre = new Centre();
        $centre->ville_id = $req->get('id_ville');
        $centre->fill($req->all())->save();

        return redirect()->route('centres.index')->with('success', 'Bien ajoute');
    }

    public function edit($id)
    {
        $villes = DB::table('villes')->get();
        $value = Centre::find($id);
        return view('centres.edit', compact('value'), compact('villes'));


    }

    public function update(request $req)
    {
        $id_ville = $req->input('id_ville');
        $id = $req->input('id');
        $libelle = $req->input('libelle');
        $adresse = $req->input('adresse');
        $tel = $req->input('tel');
        $nom_responsable = $req->input('nom_responsable');
        $data = array('id_ville' => $id_ville, 'libelle' => $libelle, 'adresse' => $adresse, 'tel' => $tel, 'nom_responsable' => $nom_responsable);
        DB::table('centre')->where('id', $id)->update($data);
        return redirect()->route('centres.index');

    }

    public function delete($id)
    {

        DB::table('centre')->where('id', $id)->delete();
        return back();

    }
}
