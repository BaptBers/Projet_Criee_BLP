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

    public function setLot($IdBateau, $datePeche, $IdEspece, $IdTaille, $IdPresentation, $IdBac, $IdQualite, $PoidsBrutLot, $prixDepart, $prixEnchereActuelle, $dateOuverture, $dateFin, $heureOuverture, $heureFin, $idAdmin)
    {
        $search = "INSERT INTO lot (
            IdBateau, datePeche, IdEspece, IdTaille, IdPresentation, IdBac, IdQualite, IdImage, 
            poidsBrutLot, prixDepart, prixEnchereActuelle, dateOuverture, dateFin, 
            heureOuverture, heureFin, idAdmin
        ) VALUES (
            :IdBateau, :datePeche, :IdEspece, :IdTaille, :IdPresentation, :IdBac, :IdQualite, :IdImage, 
            :PoidsBrutLot, :prixDepart, :prixEnchereActuelle, :dateOuverture, :dateFin, 
            :heureOuverture, :heureFin, :idAdmin
        )";
    
        $result = $this->db->conn_id->prepare($search);
        $result->bindParam(':IdBateau', $IdBateau, PDO::PARAM_INT);
        $result->bindParam(':datePeche', $datePeche, PDO::PARAM_STR);
        $result->bindParam(':IdEspece', $IdEspece, PDO::PARAM_INT);     
        $result->bindParam(':IdTaille', $IdTaille, PDO::PARAM_INT);
        $result->bindParam(':IdPresentation', $IdPresentation, PDO::PARAM_INT);
        $result->bindParam(':IdBac', $IdBac, PDO::PARAM_INT);
        $result->bindParam(':IdQualite', $IdQualite, PDO::PARAM_INT);
        $result->bindParam(':IdImage', $IdEspece, PDO::PARAM_INT); 
        $result->bindParam(':PoidsBrutLot', $PoidsBrutLot, PDO::PARAM_STR);
        $result->bindParam(':prixDepart', $prixDepart, PDO::PARAM_STR);
        $result->bindParam(':prixEnchereActuelle', $prixEnchereActuelle, PDO::PARAM_STR);
        $result->bindParam(':dateOuverture', $dateOuverture, PDO::PARAM_STR);
        $result->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
        $result->bindParam(':heureOuverture', $heureOuverture, PDO::PARAM_STR);
        $result->bindParam(':heureFin', $heureFin, PDO::PARAM_STR);
        $result->bindParam(':idAdmin', $idAdmin, PDO::PARAM_INT);
    
        $result->execute();
    }    

    public function setPeche($idBateau, $datePeche)
    {
        $query = "INSERT INTO peche (IdBateau, datePeche) VALUES (:idBateau, :datePeche)";
        $stmt = $this->db->conn_id->prepare($query);
        $stmt->bindParam(':idBateau', $idBateau, PDO::PARAM_INT);
        $stmt->bindParam(':datePeche', $datePeche, PDO::PARAM_STR);
        $stmt->execute();
    }
    
    public function setFactureEntete($dateCommande, $heureCommande, $montantTotal, $idAcheteur) {
        $sql = "INSERT INTO facture (dateCommande, heureCommande, montantTotal, IdAcheteur)
                VALUES (:dateCommande, :heureCommande, :montantTotal, :idAcheteur)";
        
        try {
            // Préparation de la requête
            $stmt = $this->db->conn_id->prepare($sql);
    
            // Bind des paramètres
            $stmt->bindParam(':dateCommande', $dateCommande, PDO::PARAM_STR);
            $stmt->bindParam(':heureCommande', $heureCommande, PDO::PARAM_STR);
            $stmt->bindParam(':montantTotal', $montantTotal, PDO::PARAM_STR);
            $stmt->bindParam(':idAcheteur', $idAcheteur, PDO::PARAM_INT);
            
            // Exécution de la requête
            if ($stmt->execute()) {
                // Retourne l'ID de la facture insérée
                return $this->db->conn_id->lastInsertId(); 
            } else {
                // Si une erreur se produit
                $error = $stmt->errorInfo();
                log_message('error', 'Erreur lors de l\'insertion de la facture : ' . $error[2]);
                return false;
            }
        } catch (Exception $e) {
            // Gérer les exceptions
            log_message('error', 'Exception lors de l\'insertion de la facture : ' . $e->getMessage());
            return false;
        }
    }
    
    public function insertFactureDetail($idFacture, $idLot, $montant) {
        $sql = "INSERT INTO facture_details (IdFacture, IdLot, montant)
                VALUES (:idFacture, :idLot, :montant)";
        
        $stmt = $this->db->conn_id->prepare($sql);
    
        $stmt->bindParam(':idFacture', $idFacture, PDO::PARAM_INT);
        $stmt->bindParam(':idLot', $idLot, PDO::PARAM_INT);
        $stmt->bindParam(':montant', $montant, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            return true; // Retourne true si l'insertion a réussi
        } else {
            $error = $stmt->errorInfo();
            log_message('error', 'Erreur lors de l\'insertion dans facture_details : ' . $error[2]);
            return false; // Retourne false en cas d'échec
        }
    }

    public function getToutesFactures($idAcheteur) {
        $sql = "SELECT * FROM facture WHERE IdAcheteur = :idAcheteur ORDER BY dateCommande DESC";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(':idAcheteur', $idAcheteur, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
     
    public function getFactureDetails($idFacture) {
        $sql = "SELECT f.IdLot, f.montant FROM facture_details f WHERE f.IdFacture = :idFacture";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(':idFacture', $idFacture, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMontantEnchereParLot($idLot) {
        $sql = "SELECT montantEnchere FROM panier WHERE IdLot = :idLot";
        
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(':idLot', $idLot, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['montantEnchere'] : 0;
    }

    public function supprimerDuPanier($idLot) {
        $sql = "DELETE FROM panier WHERE IdLot = :idLot";

        $stmt = $this->db->conn_id->prepare($sql);

        $stmt->bindParam(':idLot', $idLot, PDO::PARAM_STR);


        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            return "Erreur de supression : " . $error[2];
        }
    }

    public function getLotsOuvert()
    {
        $search = "SELECT * FROM lot, bateau, espece, taille, bac, qualite, image, presentation WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND bac.IdBac = lot.IdBac AND qualite.IdQualite = lot.IdQualite AND image.IdImage = lot.idImage AND presentation.IdPresentation = lot.IdPresentation AND statut = 'ouverte'";
        $result = $this->db->conn_id->prepare($search);
        $result->execute();
        $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
        //$this->db = null ;
        return $query_result; 
    }

    public function getLotsFutures()
    {
        $search = "SELECT * FROM lot, bateau, espece, taille, bac, qualite, image , presentation WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND bac.IdBac = lot.IdBac AND qualite.IdQualite = lot.IdQualite AND image.IdImage = lot.idImage AND presentation.IdPresentation = lot.IdPresentation AND statut = 'future'";
        $result = $this->db->conn_id->prepare($search);
        $result->execute();
        $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
        //$this->db = null ;
        return $query_result; 
    }
 
    public function verifyLogin($login, $pwd) {
        $query = $this->db->get_where('acheteur', ['login' => $login, 'pwd' => $pwd]);
        return $query->row_array(); // Retourne la ligne correspondante ou NULL
    }

    public function verifyAdmin($login, $pwd) {
        $query = $this->db->get_where('administrateur', ['loginAdmin' => $login, 'pwdAdmin' => $pwd]);
        return $query->row_array(); // Retourne la ligne correspondante ou NULL
    }

    public function getLotById($idLot) {
        $sql = "SELECT * FROM lot, bateau, espece, taille, bac, qualite, image, presentation WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND bac.IdBac = lot.IdBac AND qualite.IdQualite = lot.IdQualite AND image.IdImage = lot.idImage AND presentation.IdPresentation = lot.IdPresentation AND IdLot = ?";
        $query = $this->db->query($sql, [$idLot]);
        return $query->row_array();
    }

    public function getAcheteur($idLot) {
        $sql = "SELECT historique_encheres.IdAcheteur, acheteur.login FROM lot, bateau, espece, taille, bac, qualite, image, presentation, historique_encheres, acheteur WHERE historique_encheres.IdAcheteur = acheteur.IdAcheteur AND lot.IdLot = historique_encheres.IdLot AND bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND bac.IdBac = lot.IdBac AND qualite.IdQualite = lot.IdQualite AND image.IdImage = lot.idImage AND presentation.IdPresentation = lot.IdPresentation AND lot.IdLot = ? ORDER BY historique_encheres.montantEnchere DESC";
        $query = $this->db->query($sql, [$idLot]);
        return $query->row_array();
    }

    public function updateEncheresOuvertes() {
        $sql = "UPDATE lot 
                SET statut = 'ouverte' 
                WHERE statut = 'future' 
                AND TIMESTAMP(dateOuverture, heureOuverture) <= NOW()";
        $this->db->query($sql);
    }
      
    public function updateEncheresExpirees() {
        $sql = "UPDATE lot 
                SET statut = 'fermee' 
                WHERE statut = 'ouverte' 
                AND TIMESTAMP(dateFin, heureFin) <= NOW()";
        $this->db->query($sql);
    }    
       
    public function getLotsFermes()
    {
        $search = "SELECT * FROM lot, bateau, espece, taille, bac, qualite, image, presentation WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND bac.IdBac = lot.IdBac AND qualite.IdQualite = lot.IdQualite AND image.IdImage = lot.idImage AND presentation.IdPresentation = lot.IdPresentation AND statut = 'fermee'";
        $result = $this->db->conn_id->prepare($search);
        $result->execute();
        $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
    // $this->db = null ;
        return $query_result; 
    }

    public function enregistreEnchere($idLot, $idAcheteur, $montantEnchere) {
        // Vérifier si l'enchère est encore ouverte et pas expirée
        $sql = "SELECT prixEnchereActuelle, statut, TIMESTAMP(dateFin, heureFin) AS finEnchere
                FROM lot 
                WHERE IdLot = ?";
        $query = $this->db->query($sql, [$idLot]);
        $lotDetails = $query->row_array();
    
        if ($lotDetails) {
            // Vérifier si l'enchère est encore ouverte
            if ($lotDetails['statut'] != 'ouverte') {
                return false; 
            }
    
            // Vérifier si la fin est dépassée
            if (strtotime($lotDetails['finEnchere']) <= time()) {
                return false;
            }
    
            // Vérifier que le montant est supérieur à l'enchère actuelle
            if ($lotDetails['prixEnchereActuelle'] < $montantEnchere) {
                // Mise à jour du prix et insertion dans l'historique
                $updateSql = "UPDATE lot SET prixEnchereActuelle = ? WHERE IdLot = ?";
                $this->db->query($updateSql, [$montantEnchere, $idLot]);
    
                $insertSql = "INSERT INTO historique_encheres (IdLot, IdAcheteur, montantEnchere, dateEnchere) 
                              VALUES (?, ?, ?, NOW())";
                $this->db->query($insertSql, [$idLot, $idAcheteur, $montantEnchere]);
    
                return true;
            } else {
                return false; // Montant trop bas
            }
        } else {
            return false; // Lot non trouvé
        }
    }
    

    public function getInfosPanier($idAcheteur){
        // Définir la requête SQL pour récupérer les informations du panier de l'acheteur
        $sql = "SELECT panier.IdLot, panier.IdAcheteur, panier.montantEnchere
        FROM panier, lot
        WHERE lot.IdLot = panier.IdLot 
        AND panier.IdAcheteur = ?";

        // Exécution de la requête
        $query = $this->db->query($sql, [$idAcheteur]);

        // Retourner les résultats sous forme de tableau associatif
        return $query->result_array();
    }

    public function getTotalPanier($idAcheteur) {
        // Appeler la fonction stockée pour récupérer le total du panier
        $sql = "SELECT calculer_total_panier(?) AS total_panier";
        $query = $this->db->query($sql, array($idAcheteur));
    
        // Retourner le résultat
        return $query->row()->total_panier;
    }

    public function getPoidsNet($idLot) {
        // Appeler la fonction stockée pour récupérer le total du panier
        $sql = "SELECT calcul_poids_net(?) AS poidsNet";
        $query = $this->db->query($sql, array($idLot));
    
        // Retourner le résultat
        return $query->row()->poidsNet;
    }

    public function getNomScientifiques() {
        $sql = "SELECT IdEspece, nomScientifique FROM espece"; // Table ESPECE
        $result = $this->db->query($sql); // Exécution de la requête avec CodeIgniter DB
    
        // Remplacez fetchAll() par result_array() pour obtenir les résultats sous forme de tableau
        return $result->result_array();
    }

    // Fonction pour récupérer les noms communs (de la table ESPECE)
    public function getNomCommuns() {
        $sql = "SELECT IdEspece, nomCommun FROM espece"; // Table ESPECE
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    // Fonction pour récupérer les noms de bateaux (de la table BATEAU)
    public function getNomBateaux() {
        $sql = "SELECT IdBateau, nomBateau FROM bateau"; // Table BATEAU
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function getDescription() {
        $sql = "SELECT IdPresentation, descriptionPresentation FROM presentation"; // Table presentation
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function getQualité() {
        $sql = "SELECT  IdQualite, descriptionQualite FROM qualite"; // Table qualité
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function getTaille() {
        $sql = "SELECT IdTaille FROM taille"; // Table taille
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function getTare() {
        $sql = "SELECT IdBac, designationTaille FROM bac"; // Table bac
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function utilisateurADesFactures($idAcheteur) {
        $sql = "SELECT COUNT(*) as total FROM facture WHERE IdAcheteur = :idAcheteur";
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam(':idAcheteur', $idAcheteur, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }
    
}
?>