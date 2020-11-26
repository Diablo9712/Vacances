<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Collection;

use App\Agenda;
use App\Reservation;
use app\Priorite;

class AgendaController extends Controller
{

        public function fiche($id)
        {
            $data = Agenda::query()

            ->join('centres AS c', 'c.id', '=', 'agendas.id_centre')
            ->join('villes AS v', 'v.id', '=', 'c.ville_id')
            ->join('priorites AS p', 'p.id', '=', 'agendas.id_priorite')
            ->join('reservations AS r', 'r.id', '=', 'agendas.id_reservation')
            ->join('etat_reservation AS e', 'e.id', '=', 'r.id_Etat')

            ->select('agendas.*','p.date_debut','p.date_fin', 'c.*', 'e.libelle as l2','v.*','r.id_User as iduser', 'r.date_etat as date_etat')

            ->where('agendas.id', $id)

            ->get();
            //dd($data[0]->iduser);
            if(Auth::user()->id!=$data[0]->iduser){
                throw new \Exception("Khtina mnek");
            };
    //===============================================================================================

            return view('agenda.fiche', compact('data'));
        }



    public function nouveau_reservation()
    {

        return view('agenda.nouveau_reservation');


    }
    public function suivi_reservation()
    {
        //$priorite=new Priorite();
        $userId = Auth::user()->id;
        /*$data = Agenda::query()

        ->join('centres AS c', 'c.id', '=', 'agendas.id_centre')
        ->join('villes AS v', 'v.id', '=', 'c.ville_id')
        ->join('priorites AS p', 'p.id', '=', 'agendas.id_priorite')
        ->join('reservations AS r', 'r.id', '=', 'agendas.id_reservation')
        ->join('etat_reservation AS e', 'e.id', '=', 'r.id_Etat')
        ->select('agendas.*','p.date_debut','p.date_fin', 'c.*', 'v.*', 'e.libelle as l2','agendas.id as idagenda')

        ->where('r.id_User', $userId)
        
        ->get();*/
       // return view('agenda.suivi_reservation', compact('data'));


        $data=Reservation::query()
        ->join('etat_reservation AS e', 'e.id', '=', 'id_Etat')
        ->join('priorites AS p', 'p.id_Reservation', '=', 'reservations.id')
        ->join('villes AS v', 'v.id', '=', 'p.id_Ville')
        ->select('reservations.*','reservations.id as idr','p.date_debut','p.date_fin', 'v.*', 'e.libelle as l2','p.id as idp')
        ->where('id_User', $userId)
        ->orderBy('reservations.id', 'asc')
        ->get();
      
        $reservations=new Reservation();
        $agenda=new Agenda();
        $agendas=new Collection($agenda);
        $reservations=new Collection($reservations);
        foreach($data as $objet){
        if($objet->id_Etat==2||$objet->id_Etat==3 ){
            $requet=Agenda::query()

            ->where('id_reservation','=', $objet->idr)
            ->where('id_priorite','=', $objet->idp)
            ->get();
            $agendas->push($requet);
                if($requet->count()>0){
                    $reservations->push($objet);   
                }
            }
            else{
                $reservations->push($objet) ;
            }
        }
        return view('agenda.suivi_reservation', compact('reservations'));

    }

    
    public function reclamation()
    {

        return view('agenda.reclamation');


    }
    public function annuler($id)
    {
        $startDate = (new \DateTime('now'));

        $data = Agenda::query()

        ->join('centres AS c', 'c.id', '=', 'agendas.id_centre')
        ->join('villes AS v', 'v.id', '=', 'c.ville_id')
        ->join('priorites AS p', 'p.id', '=', 'agendas.id_priorite')
        ->join('reservations AS r', 'r.id', '=', 'agendas.id_reservation')
        ->join('etat_reservation AS e', 'e.id', '=', 'r.id_Etat')

        ->select('agendas.*','p.date_debut','p.date_fin', 'c.*', 'v.*', 'e.libelle as l2','agendas.id as idagenda','r.id as idreservation','e.id as etatid')
        
        ->where('agendas.id_reservation', $id)

        ->first();
        $d1= date_create_from_format('Y-m-d', $data->date_debut);
        $d2= date_create_from_format('Y-m-d', $data->date_fin);

        $difreservation=(int)$d1->diff($d2)->format("%r%a");
        $difDat =(int)$startDate->diff($d1)->format("%r%a");

        if( $data->etatid!=3){
        $resrvation=Reservation::find($data->idreservation);
        $agenda=Agenda::find($data->idagenda);
            $resrvation->id_Etat=3;
            $resrvation->date_etat=$startDate;
            $montant=0;


            if ($difDat<20 && $difDat>=0){

                $penalite=$data->montant_reservation*0.1;

                $agenda->montant_penalite= $penalite;

            }
            elseif($difDat<0){
                $montantJ= $data->montant_reservation/$difreservation;

                $newMontant=$difDat*-1*$montantJ;

                $penalite=$montantJ*($difreservation+$difDat)*0.2;
                $agenda->montant_penalite= $penalite;
                $montant= $newMontant;
            }
            $agenda->montant_reservation=$montant;

            $agenda->save();

            $resrvation->save();
        }

        else{
            throw new \Exception("deja annulé");
        };

        return redirect()->route('agenda.suivi_reservation');


    }
    public function avis()
    {

        return view('agenda.avis');


    }
}
