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
	 $result->bindParam(':login', $nom, PDO::PARAM_STR);
	 $result->bindParam(':pwd', $prenom, PDO::PARAM_STR);
	 $result->bindParam(':raisonSocialeEntreprise', $email, PDO::PARAM_STR);
	 $result->bindParam(':adresse', $motdepasse, PDO::PARAM_STR);
     $result->bindParam(':ville', $motdepasse, PDO::PARAM_STR);
     $result->bindParam(':cp', $motdepasse, PDO::PARAM_STR);
     $result->bindParam(':numHabilitation', $motdepasse, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 //$this->db = null ;
	 return $query_result; 
 }
}
?>