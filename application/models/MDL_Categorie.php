<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Categorie extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->model('MDL_Coureur');
    }

    public function saveCoureurCategorie($idcoureur, $idcategorie){
        $data = array(
            'idcoureur' => $idcoureur,
            'idcategorie' => $idcategorie
        );
        $this->db->insert('coureur_categorie', $data);
    }

    public function generateCoureurCategorie(){
        $coureurlist = $this->MDL_Coureur->getAll();
        for ($i=0; $i < count($coureurlist); $i++) { 
            $now = new Datetime();
            $dtn = new DateTime($coureurlist[$i]->dtn);
            $age = $now->diff($dtn)->y;
            if ($coureurlist[$i]->genre == 1) {
                $this->saveCoureurCategorie($coureurlist[$i]->id, 1);
            }
            if ($coureurlist[$i]->genre == 2) {
                $this->saveCoureurCategorie($coureurlist[$i]->id, 2);
            }
            if ($age < 18) {
                $this->saveCoureurCategorie($coureurlist[$i]->id, 3);
            }
        }
    }

}
?>