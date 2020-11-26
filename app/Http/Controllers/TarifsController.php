<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\VilleRequest;
use App\Ville;
use App\Tarif;


use App\Http\VMs\tarifVM;
use DB;

class TarifsController extends Controller
{
    public function index()
    {
     $tarifes=Tarif::orderBy('ville_id', 'asc')
        ->orderBy('saison_details_id', 'asc')
        ->get()
     ;

        $tarifVM=new tarifVM;
        $tarifVMs=new Collection();
//        $tarifVMs->add($tarifVM);

        foreach ($tarifes as $value){
            $ville = Ville::find($value->ville_id);
            if($value->saison_details_id==1) {
                $tarifVM=new tarifVM;
                $tarifVM->ville=$ville->libelle;
                $tarifVM->id_v=$ville->id;
                $tarifVM->mhs=$value->montant;
            }
           else{
            $tarifVM->mbs=$value->montant;
            $tarifVMs->push($tarifVM);
           }

       }
        //$tarifVM->mhs=$value->montant;
       // @endforeach

        return view('tarifs.index',compact('tarifVMs'));

    }
    //====================================================================
    public function create( )
    {
        $ville =Ville::select('villes.id','libelle')
        ->leftJoin('tarifs','tarifs.ville_id','=','villes.id')
        ->whereNull('tarifs.ville_id')
        ->get();
        return view('tarifs.create',compact('ville'));

    }
    //========================================================================
    public function edite( $getid )
    {

        $tarifs= Tarif::where('ville_id',$getid)
        ->get();

        $tarif=new tarifVM;
        $tarifVMs=collect($tarif);


        foreach ($tarifs as $value){

            if($value->saison_details_id==1){
                $ville = Ville::find($value->ville_id);

                $tarif->ville=$ville->libelle;
                $tarif->id_ville=$ville->id;
                $tarif->id_tarif1=$value->id;
                $tarif->mhs=$value->montant;
            }
           else{
            $tarif->id_tarif2=$value->id;
            $tarif->mbs=$value->montant;
            $tarifVMs->push($tarif);
           }
        }

        return view('tarifs.create',compact('tarif'));

    }
    //======================================================================
    public function insert(Request $request)
    {
      $tarif = new Tarif();

      $tarif->ville_id = $request->input('ville');
      $tarif->saison_details_id = 1;
      $tarif->montant = $request->input('1');
      $tarif->save();
      //=========================================
      $tarif = new Tarif();
      $tarif->ville_id = $request->input('ville');
      $tarif->saison_details_id = 2;
      $tarif->montant = $request->input('2');
      $tarif->save();
      return redirect('tarifs');
    }
//========================================================================
public function updat(Request $request)
{

  $tarifs= Tarif::where('ville_id',$request->input('ville'))
        ->get();
        foreach ($tarifs as $tarif){

            if($tarif->saison_details_id==1){
                $tarif->montant=$request->input('1');
                $tarif->save();
            }
           else{
            $tarif->montant=$request->input('2');
            $tarif->save();           }
        }
  //=========================================

  return redirect('tarifs');
}

}
