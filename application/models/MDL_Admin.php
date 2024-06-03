<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Admin extends CI_Model {
    function login($email, $mdp) {
        $query = $this->db->get_where('admin', array('email' => $email, 'mdp' => $mdp));
        $user = $query->row_array();
        return $user;
    }

    public function truncate(){
        $this->db->query('TRUNCATE TABLE temp_points RESTART IDENTITY CASCADE');     
        $this->db->query('TRUNCATE TABLE resultat RESTART IDENTITY CASCADE'); 
        $this->db->query('TRUNCATE TABLE temp_etape RESTART IDENTITY CASCADE');  
        $this->db->query('TRUNCATE TABLE point_etape RESTART IDENTITY CASCADE');     
        $this->db->query('TRUNCATE TABLE coureur_etape RESTART IDENTITY CASCADE'); 
        $this->db->query('TRUNCATE TABLE coureur_categorie RESTART IDENTITY CASCADE');           
        $this->db->query('TRUNCATE TABLE coureur RESTART IDENTITY CASCADE');
        // $this->db->query('TRUNCATE TABLE categorie RESTART IDENTITY CASCADE');
        $this->db->query('TRUNCATE TABLE etape RESTART IDENTITY CASCADE');     
        $this->db->query('TRUNCATE TABLE equipe RESTART IDENTITY CASCADE');       
    }

}
?>