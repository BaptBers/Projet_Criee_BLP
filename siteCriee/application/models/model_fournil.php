<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_fournil extends CI_Model
{
 public function __construct()
 {
	parent::__construct();
 }
 public function getPains()
 {
	 $search = "SELECT * FROM produit WHERE refProduit LIKE 'P%'";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	// $this->db = null ;
	 return $query_result; 
 }
 
  public function getViennoiseries()
 {
	 $search = "SELECT * FROM produit WHERE refProduit LIKE 'V%'";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	// $this->db = null ;
	 return $query_result; 
 }
 
  public function getSpecialites()
 {
	 $search = "SELECT * FROM produit WHERE refProduit LIKE 'S%'";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	// $this->db = null ;
	 return $query_result; 
 }
 
 public function setUtilisateur($nom,$prenom,$email,$motdepasse)
 {
	 $search = "INSERT INTO utilisateurs(nom,prenom,email,password) VALUES(:nom,:prenom,:email,:motdepasse);";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':nom', $nom, PDO::PARAM_STR);
	 $result->bindParam(':prenom', $prenom, PDO::PARAM_STR);
	 $result->bindParam(':email', $email, PDO::PARAM_STR);
	 $result->bindParam(':motdepasse', $motdepasse, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 //$this->db = null ;
	 return $query_result; 
 }
 
 public function getConn($email,$motdepasse)
 {
	 $search = "SELECT id, nom, prenom, password FROM utilisateurs WHERE email = :email2";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':email2', $email, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 //$this->db = null ;
	 return $query_result; 
 }
 
 // public function envoieCommande($quantite_baguette, $quantite_campagne, $quantite_cereales, $quantite_croissant, $quantite_chocolat, $quantite_chausson, $quantite_fougasse, $quantite_epices, $quantite_galette)
 // {
	 // $search = "INSERT INTO COMMANDE(idCommande,idUtilisateur,dateCommande) VALUES(:qbaguette,:qcampagne,:qcereales,:qcroissant);";
	 // $result = $this->db->conn_id->prepare($search);
	 // $result->bindParam(':qbaguette', $quantite_baguette, PDO::PARAM_STR);
	 // $result->bindParam(':qcampagne', $quantite_campagne, PDO::PARAM_STR);
	 // $result->bindParam(':qcereales', $quantite_cereales, PDO::PARAM_STR);
	 // $result->bindParam(':qcroissant', $quantite_croissant, PDO::PARAM_STR);
	 // $result->bindParam(':qchocolat', $quantite_chocolat, PDO::PARAM_STR);
	 // $result->bindParam(':qchausson', $quantite_chausson, PDO::PARAM_STR);
	 // $result->bindParam(':qfougasse', $quantite_fougasse, PDO::PARAM_STR);
	 // $result->bindParam(':qepices', $quantite_epices, PDO::PARAM_STR);
	 // $result->bindParam(':qgalette', $quantite_galette, PDO::PARAM_STR);
	 // $result->execute();
	 // $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 // //$this->db = null ;
	 // return $query_result; 
 // }
 
public function envoieCommande($idUtilisateur, $quantite_baguette, $quantite_campagne, $quantite_cereales, $quantite_croissant, $quantite_chocolat, $quantite_chausson, $quantite_fougasse, $quantite_epices, $quantite_galette)
{    
    $searchCommande = "INSERT INTO COMMANDE (idUtilisateur, dateCommande) VALUES (:idUtilisateur, NOW())";
    $resultCommande = $this->db->conn_id->prepare($searchCommande);
    $resultCommande->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    $resultCommande->execute();
    
    $idCommande = $this->db->conn_id->lastInsertId();
   
    $produits = [
        ['refProduit' => 'P001', 'quantite' => $quantite_baguette],
        ['refProduit' => 'P002', 'quantite' => $quantite_campagne],
        ['refProduit' => 'P003', 'quantite' => $quantite_cereales],
        ['refProduit' => 'V001', 'quantite' => $quantite_croissant],
        ['refProduit' => 'V002', 'quantite' => $quantite_chocolat],
        ['refProduit' => 'V003', 'quantite' => $quantite_chausson],
        ['refProduit' => 'S001', 'quantite' => $quantite_fougasse],
        ['refProduit' => 'S002', 'quantite' => $quantite_epices],
        ['refProduit' => 'S003', 'quantite' => $quantite_galette],
    ];

    $searchSousCommande = "INSERT INTO SOUS_COMMANDE (idCommande, refProduit, quantite) VALUES (:idCommande, :refProduit, :quantite)";
    $resultSousCommande = $this->db->conn_id->prepare($searchSousCommande);
    
    foreach ($produits as $produit) {
        if ($produit['quantite'] > 0) { // Insérer seulement si la quantité est supérieure à 0
            $resultSousCommande->bindParam(':idCommande', $idCommande, PDO::PARAM_INT);
            $resultSousCommande->bindParam(':refProduit', $produit['refProduit'], PDO::PARAM_STR);
            $resultSousCommande->bindParam(':quantite', $produit['quantite'], PDO::PARAM_INT);
            $resultSousCommande->execute();
        }
    }
    
    return true; 
}

}
?>