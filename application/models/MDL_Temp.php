<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Temp extends CI_Model {
    public function savePoints($classement, $points){
        $data = array(
            'classement' => $classement,
            'points' => $points
        );
        $this->db->insert('temp_points', $data);
    }

    // function saveEtape($etape, $longueur, $nbre_coureur, $rang, $date_depart, $heure_depart) {
    //     $sql = "insert into temp_etape(etape, longueur, nbre_coureur, rang, date_depart, heure_depart)  values (%s, %s, %s, %s, %s, %s) ";
    //     $sql = sprintf($sql,$this->db->escape($etape), $this->db->escape($longueur), $this->db->escape($nbre_coureur), $this->db->escape($rang),$this->db->escape($date_depart), $this->db->escape($heure_depart));
    //     $this->db->query($sql);
    // }

    public function saveEtape($etape, $longueur, $nbre_coureur, $rang, $date_depart, $heure_depart){
        $data = array(
            'etape' => $etape,
            'longueur' => $longueur,
            'nbre_coureur' => $nbre_coureur,
            'rang' => $rang,
            'date_depart' => $date_depart,
            'heure_depart' => $heure_depart
        );
        $this->db->insert('temp_etape', $data);
    }

    public function saveResultat($etape_rang, $num_dossard, $nom, $genre, $dtn, $equipe, $arrivee){
        $data = array(
            'etape_rang' => $etape_rang,
            'num_dossard' => $num_dossard,
            'nom' => $nom,
            'genre' => $genre,
            'dtn' => $dtn,
            'equipe' => $equipe,
            'arrivee' => $arrivee
        );
        $this->db->insert('resultat', $data);
    }

    public function savePointEtapeTable(){
        $this->db->query('
            insert into point_etape(rang, point)
            select classement, points
            from temp_points;
        ');
    }

    public function saveEtapeTable(){
        $this->db->query('
            insert into etape(nom, longueur, nbre_coureur, rang, date_course, heure_depart)
            select etape, longueur, nbre_coureur, rang, date_depart, heure_depart
            from temp_etape;
        ');
    }

    public function saveEquipeTable(){
        $this->db->query('
            insert into equipe(nom, pseudo)
            select distinct equipe, equipe as pseudo
            from resultat;
        ');
    }

    public function saveCoureurTable(){
        $this->db->query('
            insert into coureur(nom, num_dossard, genre, dtn, idequipe)
            select distinct r.nom, r.num_dossard, g.id as idgenre, r.dtn, e.id as idequipe
            from resultat r
            join genre g on r.genre = g.nom
            join equipe e on r.equipe = e.nom;
        ');
    }

    public function saveCoureurEtapeTable(){
        $this->db->query("
            insert into coureur_etape(idetape, idcoureur, heure_depart, heure_arrivee)
            select e.id as idetape, c.id as idcoureur, to_timestamp(e.date_course || ' ' || e.heure_depart, 'YYYY-MM-DD HH24:MI:SS') AS depart, r.arrivee
            from resultat r
            join etape e on r.etape_rang = e.rang
            join coureur c on r.nom = c.nom;
        ");
    }
}
?>