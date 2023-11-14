<?php

function calculConges($dateDebut, $dateFin, $soldeConges) {
    $timestampDebut = strtotime($dateDebut);
    $timestampFin = strtotime($dateFin);

    $joursOuvres = 0;

    while ($timestampDebut <= $timestampFin) {
        $jourSemaine = date("N", $timestampDebut);

        // Vérifier si le jour est un jour ouvré (lundi à vendredi)
        if ($jourSemaine >= 1 && $jourSemaine <= 5) {
            // Vérifier si le jour n'est pas un jour férié (sauf fêtes religieuses)
            if (!isholiday($timestampDebut)) {
                $joursOuvres++;
            }
        }

        // Passer au jour suivant
        $timestampDebut = strtotime("+1 day", $timestampDebut);
    }

    // Vérifier si l'employé a assez de solde de congés
    if ($joursOuvres <= $soldeConges) {
        return $joursOuvres . " jours de congés";
    } else {
        $joursManquants = $joursOuvres - $soldeConges;
        return "L'employé n'a pas assez de solde de congés. Il manque " . $joursManquants . " jours.";
    }
}

// Exemples de test
echo calculConges("2023-03-20", "2023-03-24", 5) . PHP_EOL;
echo calculConges("2023-04-01", "2023-04-11", 5) . PHP_EOL;
echo calculConges("2023-07-12", "2023-07-19", 5) . PHP_EOL;

function isholiday($timestamp) {
    $jour = date("d", $timestamp);
    $mois = date("m", $timestamp);
    $EstFerie = 0;

    // Dates fériées fixes
    $ferieFixe = [
        "01-01", // 1er janvier
        "05-01", // 1er mai
        "05-08", // 8 mai
        "07-14", // 14 juillet
        "08-15", // 15 août
        "11-01", // 1 novembre
        "11-11", // 11 novembre
        "12-25", // 25 décembre
    ];

    // Vérifier si le jour est une fête religieuse (Pâques)
    if (isholidayReligieuse($timestamp)) {
        $EstFerie = 1;
    }

    // Vérifier si le jour est une date fixe
    if (in_array($mois . "-" . $jour, $ferieFixe)) {
        $EstFerie = 1;
    }

    return $EstFerie;
}

// Algorythme de Gauss, je n'ai pas très bien compris 
//comment faire cette partie je me suis donc aidé de chatgpt mais l'algorithme est compliqué a comprendre je trouve.
function isholidayReligieuse($timestamp) {
    $annee = date("Y", $timestamp);
    $mois = date("m", $timestamp);
    $jour = date("d", $timestamp);

    $a = $annee % 19;
    $b = floor($annee / 100);
    $c = $annee % 100;
    $d = floor($b / 4);
    $e = $b % 4;
    $f = floor(($b + 8) / 25);
    $g = floor(($b - $f + 1) / 3);
    $h = (19 * $a + $b - $d - $g + 15) % 30;
    $i = floor($c / 4);
    $k = $c % 4;
    $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
    $m = floor(($a + 11 * $h + 22 * $l) / 451);
    $n = floor(($h + $l - 7 * $m + 114) / 31);
    $p = ($h + $l - 7 * $m + 114) % 31;

    $datePaques = mktime(0, 0, 0, $n, $p + 1, $annee);

    return ($mois == date("m", $datePaques)) && ($jour == date("d", $datePaques));
}


?>
