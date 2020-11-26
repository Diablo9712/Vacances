<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Etatcentre;


class EtatcentreController extends Controller
{
    public function index()
    {

       $etatres=DB::table('etat_centres')->get();
        return view('etatcentres.index',compact('etatres'));
     

    }
    public function insert(request $req)
    {

       $libelle=$req->input('libelle');
       $data=array('libelle'=>$libelle);
       DB::table('etat_centres')->insert($data);
       return redirect()->route('etatcentres.index');
    }
    public function create( )
    {

        return view('etatcentres.create');

    }
    
    public function edit( $id)
    {
        $value=DB::table('etat_centres')->find($id);
        return view('etatcentres.edit',compact('value'));
        
  
    }
    public function update(request $req)
    {
        $id=$req->input('id');
        $libelle=$req->input('libelle');
        $data=array('libelle'=>$libelle);
        DB::table('etat_centres')->where('id',$id)->update($data); 
        return redirect()->route('etatcentres.index');
  
    }
    public function delete($id)
    {

        DB::table('etat_centres')->where('id',$id)->delete();      
        return back();
  
    }
}
