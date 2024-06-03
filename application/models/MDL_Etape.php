<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Etape extends CI_Model {
    public function getAll(){
        $this->db->select('*');
        $this->db->from('etape');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getOne($id){
        $this->db->where('id', $id);
        $query = $this->db->get('etape'); 
        return $query->row();
    }

    public function getClassementEtape(){
        $this->db->select('*');
        $this->db->from('v_etape_classement_point');
        $query = $this->db->get();
        // $result = $query->result();

        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->idetape]['idetape'] = $row->idetape;
            $result[$row->idetape]['etape'] = $row->etape;
            $result[$row->idetape]['rang_etape'] = $row->rang_etape;
            $result[$row->idetape]['details'][] = array(
                'equipe' => $row->equipe,
                'nom' => $row->nom,
                'nomgenre' => $row->nomgenre,
                'duree' => $row->duree,
                'rang' => $row->rang,
                'point' => $row->point
            );
        }
        return $result;
    }

    public function getCoureurEtapeByEquipe($idequipe){
        $this->db->select('*');
        $this->db->from('v_coureur_etape');
        $this->db->where('idequipe', $idequipe);
        $query = $this->db->get();
        // $result = $query->result();

        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->idetape]['idetape'] = $row->idetape;
            $result[$row->idetape]['etape'] = $row->etape;
            $result[$row->idetape]['rang_etape'] = $row->rang_etape;
            $result[$row->idetape]['longueur'] = $row->longueur;
            $result[$row->idetape]['nbre_coureur'] = $row->nbre_coureur;
            $result[$row->idetape]['details'][] = array(
                'equipe' => $row->equipe,
                'nom' => $row->nom,
                'nomgenre' => $row->nomgenre,
                'num_dossard' => $row->num_dossard,
                'duree' => $row->duree
            );
        }
        return $result;
    }

    public function getCountCoureurEtape($idequipe, $idetape){
        $this->db->select('*');
        $this->db->from('v_count_coureur_etape');
        $this->db->where('idequipe', $idequipe);
        $this->db->where('idetape', $idetape);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

}
?>