<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_criee extends CI_Model
{
 public function __construct()
 {
	parent::__construct();
 }

 public function setUtilisateur($nom,$prenom,$email,$motdepasse)
 {
	 $search = "INSERT INTO acheteur(login,pwd,raisonSocialeEntreprise,adresse,ville,codePostal,numHabilitation) VALUES(:login,:prenom,:pwd,:raisonSocialeEntreprise,:adresse,:ville,:cp,:numHabilitation);";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':login', $login, PDO::PARAM_STR);
	 $result->bindParam(':pwd', $pwd, PDO::PARAM_STR);
	 $result->bindParam(':raisonSocialeEntreprise', $raisonSocialeEntreprise, PDO::PARAM_STR);
	 $result->bindParam(':adresse', $adresse, PDO::PARAM_STR);
     $result->bindParam(':ville', $ville, PDO::PARAM_STR);
     $result->bindParam(':cp', $cp, PDO::PARAM_STR);
     $result->bindParam(':numHabilitation', $numHabilitation, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 //$this->db = null ;
	 return $query_result; 
 }
}
?>