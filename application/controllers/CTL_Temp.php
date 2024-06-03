<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH. 'controllers/Base_CTL.php');

class CTL_Temp extends Base_CTL {
    public function __construct(){
        parent::__construct();
    }

    public function importPointsForm(){
        $this->vueAdmin('/admin_form_import_points', array());
    }

	public function importPoints(){
        if(isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $file_path = $_FILES['file']['tmp_name'];
            if (($handle = fopen($file_path, 'r')) !== FALSE) {
                $est1er = true;
                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    if ($est1er) {
                        $est1er = false;
                        continue;
                    }
                    $this->MDL_Temp->savePoints($data[0], $data[1]);
                }
                $this->MDL_Temp->savePointEtapeTable();

                fclose($handle);
                redirect('CTL_Temp/importPointsForm');
            } else {
                echo 'Erreur lors de l\'ouverture du fichier CSV.';
            }
        } else {
            echo 'Aucun fichier à importer ou erreur lors du téléchargement.';
        }
    }

    public function importDonneesForm(){
        $this->vueAdmin('/admin_form_import_donnees', array());
    }

	public function importDonnees(){
        if(isset($_FILES['file1']) && $_FILES['file1']['error'] == UPLOAD_ERR_OK && isset($_FILES['file2']) && $_FILES['file2']['error'] == UPLOAD_ERR_OK) {
            $file1_path = $_FILES['file1']['tmp_name'];
            $file2_path = $_FILES['file2']['tmp_name'];
            if (($handle1 = fopen($file1_path, 'r')) !== FALSE && ($handle2 = fopen($file2_path, 'r')) !== FALSE) {
                $est1er = true;
                $ligne = 1;
                while (($data = fgetcsv($handle1, 1000, ',')) !== FALSE) {
                    if ($est1er) {
                        $est1er = false;
                        continue;
                    }
                    $dates = explode("/", $data[4]); 
                    $longueur = str_replace(",", ".", $data[1]);
                    if ($longueur < 0) {
                        $error = "Longueur negative à la ligne ".$ligne;
                        redirect('CTL_Temp/importDonneesForm?error='.$error);
                    } elseif ($data[2] < 0) {
                        $error = "Nombre de coureur negative à la ligne ".$ligne;
                        redirect('CTL_Temp/importDonneesForm?error='.$error);
                    } elseif (!checkdate(intval($dates[1]), intval($dates[0]), intval($dates[2]))) {
                        $error = "Date invalide à la ligne ".$ligne;
                        redirect('CTL_Temp/importDonneesForm?error='.$error);
                    } else {
                        $this->MDL_Temp->saveEtape($data[0], $longueur, $data[2], $data[3], $data[4], $data[5]);
                    }
                    $ligne++;
                }
                $this->MDL_Temp->saveEtapeTable();

                $est1ere = true;
                while (($data = fgetcsv($handle2, 1000, ',')) !== FALSE) {
                    if ($est1ere) {
                        $est1ere = false;
                        continue;
                    }
                    $this->MDL_Temp->saveResultat($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
                }
                $this->MDL_Temp->saveEquipeTable();
                $this->MDL_Temp->saveCoureurTable();
                $this->MDL_Temp->saveCoureurEtapeTable();

                fclose($handle);
                redirect('CTL_Temp/importDonneesForm');
            } else {
                echo 'Erreur lors de l\'ouverture du fichier CSV.';
            }
        } else {
            echo 'Aucun fichier à importer ou erreur lors du téléchargement.';
        }
    }
}
