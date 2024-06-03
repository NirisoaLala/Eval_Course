<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH. 'controllers/Base_CTL.php');

class CTL_Admin extends Base_CTL {
    public function __construct(){
        parent::__construct();
    }

	public function index(){
        $this->load->view('login_admin');
	}	
	
	public function login(){
		$email = $this->input->post('email');
        $mdp = $this->input->post('mdp');
        $user = $this->MDL_Admin->login($email, $mdp);
        
        if ($user){
            $this->session->set_userdata('admin', $user);
            redirect('CTL_Etape/etapeList');
            return;
        }
        else{
            $this->session->set_flashdata('error', 'Email ou mot de passe incorrect');
            $this->load->view('login_admin');
        }
	}

	public function deconnexion()	{
        $this->session->unset_userdata('admin');
        redirect('CTL_Admin/index');
    }

    public function reinitForm() {
        $this->vueAdmin('/admin_form_reinit', array());
	}

    public function reinit() {
        $this->MDL_Admin->truncate();
		redirect('CTL_Admin/reinitForm');
	}
}
