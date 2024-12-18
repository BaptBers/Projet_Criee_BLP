<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_criee extends CI_Model
{
 public function __construct()
 {
	parent::__construct();
 }

 public function setUtilisateur($login,$pwd,$raisonSocialeEntreprise,$adresse,$ville,$cp,$numHabilitation)
 {
	 $search = "INSERT INTO acheteur(login,pwd,raisonSocialeEntreprise,adresse,ville,codePostal,numHabilitation) VALUES(:login,:pwd,:raisonSocialeEntreprise,:adresse,:ville,:cp,:numHabilitation);";
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

 public function getLotsOuvert()
 {
	 $search = "SELECT * FROM lot, bateau, espece, taille, bac, qualite, image, presentation WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND bac.IdBac = lot.IdBac AND qualite.IdQualite = lot.IdQualite AND image.IdImage = lot.idImage AND presentation.IdPresentation = lot.IdPresentation AND codeEtat = 'Enchère ouverte'";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	// $this->db = null ;
	 return $query_result; 
 }

 public function getLotsFermes()
 {
	 $search = "SELECT * FROM lot, bateau, espece, taille, bac, qualite, image, presentation WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND bac.IdBac = lot.IdBac AND qualite.IdQualite = lot.IdQualite AND image.IdImage = lot.idImage AND presentation.IdPresentation = lot.IdPresentation AND codeEtat = 'Enchère fermée'";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	// $this->db = null ;
	 return $query_result; 
 }
 
 public function verifyLogin($login, $pwd) {
    $query = $this->db->get_where('acheteur', ['login' => $login, 'pwd' => $pwd]);
    return $query->row_array(); // Retourne la ligne correspondante ou NULL
}

public function getLotById($idLot) {
    $sql = "SELECT * FROM lot, bateau, espece, taille, bac, qualite, image, presentation WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND bac.IdBac = lot.IdBac AND qualite.IdQualite = lot.IdQualite AND image.IdImage = lot.idImage AND presentation.IdPresentation = lot.IdPresentation AND IdLot = ?";
    $query = $this->db->query($sql, [$idLot]);
    return $query->row_array();
}

}
?>