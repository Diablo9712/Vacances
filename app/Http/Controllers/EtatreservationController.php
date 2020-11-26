<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Etatreservation;


class EtatreservationController extends Controller
{
    public function index()
    {

       $etatres=DB::table('etat_reservation')->get();
        return view('etatreservations.index',compact('etatres'));
     

    }
    public function insert(request $req)
    {

       $libelle=$req->input('libelle');
       $data=array('libelle'=>$libelle);
       DB::table('etat_reservation')->insert($data);
       return redirect()->route('etatreservations.index');
    }
    public function create( )
    {

        return view('etatreservations.create');

    }
    
    public function edit( $id)
    {
        $value=DB::table('etat_reservation')->find($id);
        return view('etatreservations.edit',compact('value'));
        
  
    }
    public function update(request $req)
    {
        $id=$req->input('id');
        $libelle=$req->input('libelle');
        $data=array('libelle'=>$libelle);
        DB::table('etat_reservation')->where('id',$id)->update($data); 
        return redirect()->route('etatreservations.index');
  
    }
    public function delete($id)
    {

        DB::table('etat_reservation')->where('id',$id)->delete();      
        return back();
  
    }
}
