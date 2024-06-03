<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Coureur extends CI_Model {
    public function getAll(){
        $this->db->select('*');
        $this->db->from('coureur');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getAllByEquipe($idequipe){
        $this->db->select('*');
        $this->db->from('coureur');
        $this->db->where('idequipe', $idequipe);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function saveCoureurEtape($idetape, $idcoureur, $heure_depart){
        $data = array(
            'idetape' => $idetape,
            'idcoureur' => $idcoureur,
            'heure_depart' => $heure_depart,
            'heure_arrivee' => $heure_depart
        );
        $this->db->insert('coureur_etape', $data);
    }

    public function getAllByEtape($idetape){
        $this->db->select('*');
        $this->db->from('v_coureur_etape');
        $this->db->where('idetape', $idetape);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function updateTemps($idetape, $idcoureur, $heure_arrivee) {
        $sql = "update coureur_etape set heure_arrivee = %s where idetape = %s and idcoureur = %s ";
        $sql = sprintf($sql,$this->db->escape($heure_arrivee),$this->db->escape($idetape), $this->db->escape($idcoureur));
        $this->db->query($sql);
    }
}
?>