<?php

namespace App\Http\Controllers;

use App\Etatreservation;
use App\Http\Services\AgendaService;
use App\Priorite;
use App\Reservation;
use App\Centre;
use App\Agenda;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Ville;
use App\Tarif;
use App\Saison;
use DB;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ResrvationController extends Controller
{
    /**
     * @var AgendaService
     */
    private $service;

    public function __construct(AgendaService $service)
    {
        $this->service = $service;
    }

    //
    public function index()
    {
        //$this->controleDate();
        // etat en attente
        // check if we have reservation first
        $startDate = (new \DateTime('now'));
        $controle=$this->controleDate();
        $data = Reservation::where('id_Etat','<>', 3)
        ->join('priorites AS p', 'p.id_Reservation', '=', 'reservations.id')
        ->join('villes AS v', 'v.id', '=', 'p.id_ville')
        ->where('p.date_debut','>',$startDate )
        ->where('id_User', Auth::user()->id)
        ->select('reservations.id as idr','reservations.id_Etat','p.id as id','p.*','v.libelle as libelle')
        ->get();
        $reservations=new Reservation();
       
        
        $reservation=new Collection($reservations);
foreach($data as $objet){
if($objet->id_Etat==2){
   
$requet=Agenda::query()

->where('id_reservation','=', $objet->idr)
->where('id_priorite','=', $objet->id)
->get();
if($requet->count()>0){
   
    $reservation->push($objet);   
}
}
else{
    $reservation->push($objet) ;
}
}
     
        $ville = Ville::select('villes.id', 'libelle')
            ->get();

        return view('reservations.index', compact('ville', 'reservation','controle'));
    }

    public function store(Request $request)
    {
      
        // check if we already have a reservation
        // TODO: add user ID
        $reservation = Reservation::where('id_Etat', 1)->where('id_User', Auth::user()->id)->get();

        if ($reservation && isset($reservation[0])) {
            $reservation = $reservation[0];
            $count = $reservation->priorites()->count();
            if ($count >= 4) {
                throw new Exception("You have exceeded your options, Contact Mourad Makrouf for further information");
            }
        }

        if (!$reservation) {
            $userId = Auth::user()->id;
            $etat = Etatreservation::findOrFail(1);

            $reservation = new Reservation();
            $reservation->id_Etat = $etat->id;
            $reservation->id_User = $userId;
            $reservation->date_etat = new \DateTime();
            $reservation->save();
        }
        // TODO: do not choose the same city twice ?
        $priorite = new Priorite();
        $priorite->id_Ville = $request->get('ville', null);
        $priorite->id_Reservation = $reservation->id;
        $priorite->classement = 1;
        $priorite->date_debut = date_create_from_format('Y-m-d', $request->get('debut'));
        $priorite->date_fin = date_create_from_format('Y-m-d', $request->get('fin'));

        $priorite->save();

        return response()->json($priorite);
    }
    //==============================Basse saison=========================
    public function controleDate(){
        $startDate = (new \DateTime('now'));
        $result=Saison::orderBy('date_debut')->where('date_debut',">=",$startDate)->first();
        $test=false;
        if ($result) {
            $date = (new \DateTime($result->date_debut))->modify('-1 month');
            $datefin = (new \DateTime($result->date_debut))->modify('-10 days');
            if($startDate>= $date && $startDate<= $datefin){
                $test=$result;
            }
        }

return $test;
        
    }
    public function controleDate2($d1,$d2){
        $startDate = (new \DateTime('now'));
       // dd($startDate);
        $result=Saison::orderBy('date_debut')
        ->where('date_fin','>=', $d1)
        ->where('date_debut','<=', $d2)
        ->first();
        $test=false;
        if ($result) {
           
                $test=$result;
                
            }
            $vqr  = true;
       
        
return $test;
         }
    //=============================================================================
    public function store2(Request $request)
    {
        // check if we already have a reservation
        $startDate = (new \DateTime('now'));
        $d1= date_create_from_format('Y-m-d', $request->get('debut'));
        $d2= date_create_from_format('Y-m-d', $request->get('fin'));

        $difDat =(int)$d1->diff($d2)->format("%r%a");
        $difDatValid =(int)$startDate->diff($d1)->format("%r%a");
      
        //========================================================================
        $agendaexiste1 = Agenda::query()
        ->join('priorites AS p', 'p.id', '=', 'agendas.id_priorite')
        ->join('reservations as r','r.id','=','p.id_Reservation')
        ->where('p.date_fin','>', $startDate)
        ->where('r.id_Etat','=', 2)
        ->get();
        $idreservation=0;
        $classement=0;
        ////////////////////////////////////////////////////////
if( ($difDatValid>=7 && $difDatValid<93) && ($difDat>2 && $difDat<16) && $agendaexiste1->count()!=0){
    $controle=$this->controleDate();
    $controle2=$this->controleDate2($request->get('debut'),$request->get('fin'));
    $idetat=2;
   
    //================================================================================
    if($controle2!=false  ){
        $date_fin=new \DateTime($controle2->date_fin);
        if($controle!=false && $controle->id!=$controle2->id){
            throw new \Exception("nta 7chay   ".$controle2->date_fin);
        }
        elseif($controle==false){
            throw new \Exception("fout had date  ".$controle2->date_fin);
        }
       
    }
if($controle!=false){
    
    $ddebut= new \DateTime($controle->date_debut);
$dfin= new \DateTime($controle->date_fin);
    //$ddebut=date_create_from_format('Y-m-d', $controle->date_debut);
    //$dfin=date_create_from_format('Y-m-d', $controle->date_fin);
    //dd($d1,$d2,$dfin,$ddebut);
    if( ($d1<$dfin) &&($d1>=$ddebut)&& ($d2<=$dfin) &&($d2>$ddebut)){

        $priorite = Priorite::query()
        ->join('reservations as r','r.id','=','id_Reservation')
        ->where('r.id_Etat','=', 1)
        ->get();
        
        if( $priorite->count()<4)
        {
            $priorite=$priorite->first();
            //dd($priorite->id_Reservation);
            $idreservation=$priorite->id_Reservation;
            
            $classement=$priorite->count();
           
        }
        else{
            throw new \Exception("deja 3andak 4 baraka 3lik");

        }
    $idetat=1;
}
    else{
        throw new \Exception("nta maktfhamch wa9ila ");
    }
}
    $userId = Auth::user()->id;
    $etat = Etatreservation::findOrFail( $idetat);
    $reservation = new Reservation();
    $priorite = new Priorite();

if($idreservation==0){
    $reservation->id_Etat = $etat->id;
    $reservation->id_User = $userId;
    $reservation->date_etat = new \DateTime();
}
else{
    

    $priorite->id_Reservation=$idreservation;
   
}
   

// TODO: do not choose the same city twice ?

$priorite->id_Ville = $request->get('ville', null);

$priorite->classement = $classement+1;
$priorite->date_debut = date_create_from_format('Y-m-d', $request->get('debut'));
$priorite->date_fin = date_create_from_format('Y-m-d', $request->get('fin'));
if($etat->id==1){
    

if($priorite->id_Reservation==null){
    dd($priorite->id_Reservation);
    $reservation->save();
    $priorite->id_Reservation = $reservation->id;
    $priorite->save();
}
else{
    $priorite->save();
}
}

//$dateDebut= new \DateTime($priorite->date_debut);
//$dateFin= new \DateTime($priorite->date_fin);
if($reservation->id==null && $etat->id==2){
    $tarif=Tarif::where('ville_id',$priorite->id_Ville)
    ->where('saison_details_id',$idetat)->get();
    $montant=$difDat*($tarif[0]->montant);
    $centres = Centre::where('ville_id',$priorite->id_Ville)
            ->get();
            if ($centres) {
                foreach($centres as $item){
            
                    $agendaexiste3 = Agenda::query()
                    ->join('priorites AS p', 'p.id', '=', 'agendas.id_priorite')
                    ->join('reservations as r','r.id','=','p.id_Reservation')
                    ->where('p.date_fin','>=', $d1)
                    ->where('p.date_debut','<=', $d2)
                    ->where('r.id_Etat','=', 2)
                    ->where('id_centre', $item->id)
                    ->get();
                   if($agendaexiste3->count()==0){
                 
                    $reservation->save();
                    $priorite->id_Reservation = $reservation->id;
                    $priorite->save();
                    $agenda = new Agenda();
                    $agenda->id_reservation = $reservation->id;
                    $agenda->id_centre = $item->id;
                    $agenda->id_priorite = $priorite->id;
                    $agenda->montant_reservation=$montant;
                    $agenda->montant_penalite=0;
                    $agenda->save();
                    
                    return response()->json($agenda);
                   break;
                }
            }
            if($agenda->id==0){
                throw new \Exception("ma3ndk zhar ville 3amra");
            }
            }
}

}
else{
    throw new \Exception("Rah Galna lik Dir date m9ada/awla 3andk deja chi reservation valide");
}
  
}


 

    //---------------------------------------------------------------------
public function insertAgenda(Resrvation $reservation){

}
    //==========================================================================
    public function getcentrevalide($id,$dateDebut,$dateFin){
      
           return true;
            
        }

    public function delete(Request $request)
    {
        // check if the user owns this before removing
        $id = $request->get('id', null);
        if (!$id) {
            throw new Exception("ID must be provided");
        }
        /** @var Priorite $priorite */
        $priorite = Priorite::findOrFail($id);

        if (Auth::user()->id !== $priorite->reservation->user->id)
            throw new Exception("You're not allowed to perform this action!");
        $priorite->delete();

        return response()->json(true);
    }

    /**
     * @param int $villeId
     * @return JsonResponse
     * @throws Exception
     */
    public function getAvailableDates(int $villeId)
    {
        if (is_null($villeId))
            throw new Exception("Ville ID is required!");
        $dates = $this->service->getAvailableDates($villeId, (new \DateTime('2020-5-1')));

        return response()->json($dates);
    }



}

