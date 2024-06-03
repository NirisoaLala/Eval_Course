<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_CTL extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct()
    {
         parent::__construct();
         $this->load->model('MDL_Admin');
         $this->load->model('MDL_Equipe');
         $this->load->model('MDL_Etape');
         $this->load->model('MDL_Coureur');
         $this->load->model('MDL_Temp');
         $this->load->model('MDL_Categorie');
         $this->load->library('session');
    }

    // Admin
    public function vueAdmin($page, $data){
        if (isset($_SESSION['admin'])) {
            $content = array('page' => $page, 'data' => $data);
            $this->load->view('inc/page_admin', $content);
        } else {
            redirect('welcome');
        }
    }

    // Client
    public function vueEquipe($page, $data){
        if (isset($_SESSION['equipe'])) {
            $content = array('page' => $page, 'data' => $data);
            $this->load->view('inc/page_equipe', $content);
        } else {
            redirect('welcome');
        }
    }
	 
		
}
