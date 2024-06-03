<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH. 'controllers/Base_CTL.php');

class CTL_Equipe extends Base_CTL {
    public function __construct(){
        parent::__construct();
    }

	public function index(){
        $this->load->view('login_equipe');
	}	
	
	public function login(){
		$email = $this->input->post('pseudo');
        $mdp = $this->input->post('mdp');
        $user = $this->MDL_Equipe->login($email, $mdp);
        
        if ($user){
            $this->session->set_userdata('equipe', $user);
            redirect('CTL_Etape/coureurEtapeByEquipe');
            return;
        }
        else{
            $this->session->set_flashdata('error', 'Pseudo ou mot de passe incorrect');
            $this->load->view('login_equipe');
        }
	}

	public function deconnexion()	{
        $this->session->unset_userdata('equipe');
        redirect('CTL_Equipe/index');
    }
}
