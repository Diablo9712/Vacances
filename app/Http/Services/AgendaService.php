<?php


namespace App\Http\Services;


use App\Agenda;
use Illuminate\Support\Facades\DB;

class AgendaService
{
    /**
     * @param int $villeId
     * @param \DateTimeInterface $startDate
     * @return array
     * @throws \Exception
     */
    public function getAvailableDates(int $villeId, \DateTimeInterface $startDate = null)
    {
        if (!$startDate) {
            $startDate = (new \DateTime('now'));
        }
        // // SELECT * FROM `agendas` a inner join centres c ON a.id_centre = c.id inner join villes v ON v.id = c.ville_id WHERE a.id_etat_centre = 1 AND v.id = 1

        DB::enableQueryLog();
        $endDate = (clone($startDate))->modify('+3 months');
        $result = Agenda::query()
            ->select('agendas.*', 'c.*', 'v.*')
            ->join('centres AS c', 'c.id', '=', 'agendas.id_centre')
            ->join('villes AS v', 'v.id', '=', 'c.ville_id')
            ->join('priorites AS p', 'p.id', '=', 'agendas.id_priorite')
            ->where('v.id', '=', $villeId)
            // ->where('agendas.id_etat_centre', '=', 1)
            ->where('p.date_debut', '>=', $startDate)
            ->where('p.date_debut', '<=', $endDate)
            ->get();

        // Get an array of dates where the key is the centre.id
        $centres = [];
        /** @var Agenda $item */
        foreach ($result as $item) {
            $centres[$item->centre->id][] = [
                'debut' => $item->priorite->date_debut,
                'fin' => $item->priorite->date_fin
            ];
        }
        // check if interval between dates is less than 3 days
        // if the date is less than three days then just glue both dates together ?!
        // contains the occupied dates
        foreach ($centres as $k => $centre) {
            for ($i = 0; $i < count($centre); $i++) {
                if (!isset($centre[$i + 1])) break;
                $dateFin = new \DateTime($centre[$i]["fin"]);
                $dateDebut = new \DateTime($centre[$i + 1]["debut"]);

                if ($dateFin->diff($dateDebut)->days < 3) {
                    $centres[$k][$i]["fin"] = $centre[$i + 1]["fin"];
                    unset($centres[$k][$i + 1]);
                }
            }
        }
        // from the occupied dates get the available dates
        $availableDates = [];
        foreach ($centres as $k => $centre) {
            // if we have a single date then it's easy
            if (count($centre) === 1) {
                $availableDates[$k][] = [
                    "debut" => $startDate->format('c'),
                    "fin" => (new \DateTime($centre[0]["debut"]))->format('c')
                ];
                $availableDates[$k][] = [
                    "debut" => (new \DateTime($centre[0]["fin"]))->format('c'),
                    "fin" => $endDate->format('c')
                ];
                continue;
            }
            for ($i = 0; $i < count($centre); $i++) {
                // multiple dates with gapes between

                // if start day is the same as end then do nothing

                if (
                    !isset($availableDates[$k]) &&
                    $startDate->diff(new \DateTime($centre[$i]["debut"]))->days >= 3
                ) {
                    $availableDates[$k][] = [
                        "debut" => $startDate->format('c'),
                        "fin" => (new \DateTime($centre[$i]["debut"]))->format('c')
                    ];
                }
                if (isset($centre[$i + 1])) {
                    $availableDates[$k][] = [
                        "debut" => (new \DateTime($centre[$i]["fin"]))->format('c'),
                        "fin" => (new \DateTime($centre[$i + 1]["debut"]))->format('c')
                    ];
                } else {
                    $availableDates[$k][] = [
                        "debut" => (new \DateTime($centre[$i]["fin"]))->format('c'),
                        "fin" => $endDate->format('c')
                    ];
                }

            }
        }

        // get first item in each centre and find the largest duration there
        // that value represent the empty range, because all other durations that are less than this
        // are within the same range, so we just pick the largest
        // same thing is done for the last element in each centre

        // START AND END
        $maxDurationStart = [
            "centreId" => 0,
            "max" => 0
        ];
        $maxDurationEnd = [
            "centreId" => 0,
            "max" => 0
        ];

        foreach ($availableDates as $k => $centre) {
            if (isset($centre[0])) {
                $temp = (new \DateTime($centre[0]["debut"]))
                    ->diff(new \DateTime($centre[0]["fin"]))->days;
                if ($temp > $maxDurationStart["max"]) {
                    $maxDurationStart["max"] = $temp;
                    $maxDurationStart["centreId"] = $k;
                    $maxDurationStart["debut"] = $centre[0]["debut"];
                    $maxDurationStart["fin"] = $centre[0]["fin"];
                }

            }

            if (count($centre) > 1) {
                $index = count($centre) - 1;
                $temp = (new \DateTime($centre[$index]["debut"]))
                    ->diff(new \DateTime($centre[$index]["fin"]))->days;
                if ($temp > $maxDurationEnd["max"]) {
                    $maxDurationEnd["max"] = $temp;
                    $maxDurationEnd["centreId"] = $k;
                    $maxDurationEnd["debut"] = $centre[$index]["debut"];
                    $maxDurationEnd["fin"] = $centre[$index]["fin"];
                }
            }
        }

        // get all the days between in each center
        // This code will check if the center date is between either the maxStartDuration or
        // the maxEndDuration, if does belong to one of them then it's not worh saving and it's just
        // another regular date, because we're only taking the max period in both the beginning and end
        // but if it's outside the bound of those two dates, that means it's in between the dates
        // and i need to check them as well, to add them as available dates, otherwise they will be wasted
        // TODO: Read the note above after one week and see if it makes sense, i bet it wont
        $result = [];
        foreach ($availableDates as $k => $centre) {
            for ($i = 0; $i < count($centre); $i++) {
                if (
                    !(
                        (
                            $centre[$i]["debut"] >= $maxDurationStart["debut"] &&
                            $centre[$i]["fin"] <= $maxDurationStart["fin"]
                        ) || (
                            $centre[$i]["debut"] >= $maxDurationEnd["debut"] &&
                            $centre[$i]["fin"] <= $maxDurationEnd["fin"]
                        )
                    )
                ) {
                    $result[$k][] = $centre[$i];
                }
            }
        }

        // Preparing the final array
        if (isset($maxDurationStart['debut']) && isset($maxDurationStart['fin'])) {
            $result[] = [
                "centreId" => $maxDurationStart["centreId"],
                "debut" => $maxDurationStart["debut"],
                "fin" => $maxDurationStart["fin"],
            ];
        }
        if (isset($maxDurationEnd['debut']) && isset($maxDurationEnd['fin'])) {
            $result[] = [
                "centreId" => $maxDurationEnd["centreId"],
                "debut" => $maxDurationEnd["debut"],
                "fin" => $maxDurationEnd["fin"],
            ];
        }

        // Flatenning the array
        foreach ($result as $k => $item) {
            if (isset($item[0]) && is_array($item[0])) {
                $result[$k] = $item[0];
            }
        }

        usort($result, function ($a, $b) {
            return $a["debut"] >= $b["debut"];
        });



        return $result;
    }

}
