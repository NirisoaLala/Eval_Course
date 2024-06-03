<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH. 'controllers/Base_CTL.php');

class CTL_Categorie extends Base_CTL {
    public function __construct(){
        parent::__construct();
    }

	public function index(){
        $this->vueAdmin('/admin_form_categorie', array());
    }	

    public function genererCategorie(){
        $this->MDL_Categorie->generateCoureurCategorie();
        redirect('CTL_Categorie/');
    }
}
