<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH. 'controllers/Base_CTL.php');

class CTL_Etape extends Base_CTL {
    public function __construct(){
        parent::__construct();
    }

    // Equipe
	public function index(){
        $data['etapelist'] = $this->MDL_Etape->getAll();
        $this->vueEquipe('/equipe_list_etape', $data);
	}	

    public function affectationCoureurForm(){
        $idequipe = $_SESSION['equipe']['id'];
        $idetape = $this->input->get('idetape');
        $nombre = $this->MDL_Etape->getCountCoureurEtape($idequipe, $idetape);
        if ($nombre->coureur < $nombre->nbre_coureur) {
            $data['idetape'] = $idetape;
            $data['coureurlist'] = $this->MDL_Coureur->getAllByEquipe($idequipe);
            $this->vueEquipe('/equipe_form_affectation', $data);
        } else {
            $error = "Ajout de coureur impossible (".$nombre->coureur."/".$nombre->nbre_coureur." coureur(s))";
            redirect('CTL_Etape/coureurEtapeByEquipe?error='.$error);
        }
    }

    public function saveCoureurEtape(){
        $idequipe = $_SESSION['equipe']['id'];
        $idetape = $this->input->post('idetape');
        $coureurs = $this->input->post('coureur');
        $nombre = $this->MDL_Etape->getCountCoureurEtape($idequipe, $idetape);
        $etape = $this->MDL_Etape->getOne($idetape);
        $heure_depart = $etape->date_course." ".$etape->heure_depart;
        if (count($coureurs) <= ($nombre->nbre_coureur - $nombre->coureur)) {
            foreach ($coureurs as $coureur) {
                $this->MDL_Coureur->saveCoureurEtape($idetape, $coureur, $heure_depart);
            }
            redirect('CTL_Etape/coureurEtapeByEquipe');
        } else {
            $error = "Le nombre de joueur selectionné n'est pas ".($nombre->nbre_coureur - $nombre->coureur);
            redirect('CTL_Etape/affectationCoureurForm?idetape='.$idetape.'&&error='.$error);
        }
    }

    public function classementEtape(){
        $data['classementlist'] = $this->MDL_Etape->getClassementEtape();
        if (isset($_SESSION['equipe'])) {
            // $this->vueEquipe('/equipe_list_classement_etape', $data);
            $this->vueEquipe('/admin_list_classement_etape', $data);
        } elseif (isset($_SESSION['admin'])) {
            // $this->vueAdmin('/equipe_list_classement_etape', $data);
            $this->vueAdmin('/admin_list_classement_etape', $data);
        }
    }

    public function classementEquipe(){
        $data['classementlist'] = $this->MDL_Equipe->getClassementEquipe();
        $data['categorielist'] = $this->MDL_Equipe->getClassementEquipeByCategorie();
        if (isset($_SESSION['equipe'])) {
            $this->vueEquipe('/equipe_list_classement_equipe', $data);
        } elseif (isset($_SESSION['admin'])) {
            $this->vueAdmin('/equipe_list_classement_equipe', $data);
        }
    }

    public function coureurEtapeByEquipe(){
        $idequipe = $_SESSION['equipe']['id'];
        $data['coureurlist'] = $this->MDL_Etape->getCoureurEtapeByEquipe($idequipe);
        $this->vueEquipe('/equipe_list_coureur_etape', $data);
    }

    // Admin
    public function etapeList(){
        $data['etapelist'] = $this->MDL_Etape->getAll();
        $this->vueAdmin('/admin_list_etape', $data);
	}

    public function coureurEtapeList(){
        $idetape = $this->input->get('idetape');
        $data['coureurlist'] = $this->MDL_Coureur->getAllByEtape($idetape);
        $this->vueAdmin('/admin_list_coureur_etape', $data);
    }

    public function affectationTemps(){
        $idetape = $this->input->post('idetape');
        $idcoureur = $this->input->post('idcoureur');
        $heure_arrivee = $this->input->post('heure_arrivee');
        $this->MDL_Coureur->updateTemps($idetape, $idcoureur, $heure_arrivee);
        redirect('CTL_Etape/coureurEtapeList?idetape='.$idetape);
    }
	
}
