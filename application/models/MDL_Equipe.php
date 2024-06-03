<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Equipe extends CI_Model {
    function login($pseudo, $mdp) {
        $query = $this->db->get_where('equipe', array('pseudo' => $pseudo, 'mdp' => $mdp));
        $user = $query->row_array();
        return $user;
    }

    public function getClassementEquipe(){
        $this->db->select('*');
        $this->db->from('v_equipe_classement');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getClassementEquipeByCategorie(){
        $this->db->select('*');
        $this->db->from('v_equipe_classement_categorie');
        $query = $this->db->get();
        // $result = $query->result();

        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->idcategorie]['idcategorie'] = $row->idcategorie;
            $result[$row->idcategorie]['categorie'] = $row->categorie;
            $result[$row->idcategorie]['details'][] = array(
                'idequipe' => $row->idequipe,
                'equipe' => $row->equipe,
                'totalpoint' => $row->totalpoint,
                'rang' => $row->rang
            );
        }
        return $result;
    }
}
?>