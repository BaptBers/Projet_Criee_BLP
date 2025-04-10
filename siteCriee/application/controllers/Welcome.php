<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 public function __construct() {
		parent::__construct();
		$this->load->database();	// Chargement du fichier de configuration database lors du démarrage de codeIgniter 
		$this->load->helper('url_helper');// Charger des fonctions de bases pour gérer les URL
		$this->load->model('model_criee','requetes');	// Chargement du modèle modele_criee.php associé au label requête
		$this->load->library('form_validation'); // Charger la validation des formulaires
		$this->load->helper('form');
		$this->load->library('session');
		// Réglage du fuseau horaire
        date_default_timezone_set('Europe/Paris');
	}
	
	public function index()
	{
		$this->load->view('enTete'); // créer un fichier enTete.php dans le répertoire views
		$this->load->view('accueil'); // créer accueil.php dans le répertoire views
		$this->load->view('piedPage'); // Vue piedPage à créer dans le dossier VIEWS
	}
	
	public function contenu($id)
	{
		$this->load->view('enTete');
		//$this->load->view('menu');
	
		// Met à jour les enchères avant d'afficher les pages
		$this->requetes->updateEncheresOuvertes();  // Pour ouvrir les enchères futures
		$this->requetes->updateEncheresExpirees();  // Pour fermer les enchères ouvertes expirées

		if($id=="EncheresEnCours")
		{
			$data['labelEncheresEnCours']= $this->requetes->getLotsOuvert();
			$data['currentTime'] = date('Y-m-d H:i:s'); // Ajoute l'heure actuelle pour le calcul côté vue
			$this->load->view('encheresencours',$data); // Créer une vue nommée encheresencours.php dans VIEWS		
		}

		if($id == "confirmationPaiement") {
			$idAcheteur = $this->session->userdata('user_id');
		
			// Charger le modèle de requêtes
			$this->load->model('requetes');
		
			// Récupérer la dernière facture liée à cet acheteur
			$facture = $this->requetes->getDerniereFacture($idAcheteur);
		
			if ($facture) {
				// Récupérer les détails de la facture (lots, montant total, etc.)
				$factureDetails = $this->requetes->getFactureDetails($facture['IdFacture']);
		
				// Passer les données à la vue
				$data['facture'] = $facture;
				$data['factureDetails'] = $factureDetails;
		
				// Vérifier si l'heure de la commande existe et est bien formatée
				$heureCommande = isset($facture['heureCommande']) ? $facture['heureCommande'] : null;
				if ($heureCommande) {
					// Formater l'heure (au cas où elle est dans un format non standard)
					$data['heureCommande'] = date('H:i:s', strtotime($heureCommande));
				} else {
					// Si l'heure est absente, afficher une valeur par défaut
					$data['heureCommande'] = 'Heure inconnue';
				}
		
				// Formater la date de la commande
				$data['dateCommande'] = date('d/m/Y', strtotime($facture['dateCommande']));
		
				// Charger la vue avec les données
				$this->load->view('confirmationPaiement', $data);
			} else {
				// Si aucune facture n'est trouvée pour cet acheteur, rediriger vers une page d'erreur
				redirect('welcome/erreur');
			}
		}
		if($id=="FuturesEncheres")
		{
			$data['labelFuturesEncheres']= $this->requetes->getLotsFutures();
			$this->load->view('futuresencheres',$data); 		
		}

		if($id=="Panier")
		{
			if ($this->session->userdata('is_logged_in')) {
				$idAcheteur = $this->session->userdata('user_id');
				$panier = $this->requetes->getInfosPanier($idAcheteur);
				$total = $this->requetes->getTotalPanier($idAcheteur);


				$data = [
					'panier' => $panier,
					'total' => $total
				];
				
				// Charger la vue avec les données du panier
				$this->load->view('panier', $data);
			} else { 
				// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
				redirect('welcome/contenu/Connexion');
			} 
		}
		
		if($id=="Accueil") {
			$this->load->view('accueil');
		}
		
		if ($id == "EnchereOuverte") {
			// Récupérer l'ID du lot depuis la requête POST
			$idLot = $this->input->post('idLot');	

			// Si un idLot a été envoyé
			if ($idLot) {
				// Récupérer les détails du lot
				$lotDetails = $this->requetes->getLotById($idLot);
				if ($lotDetails) {
					// Passer les détails du lot à la vue 'enchere'
					$acheteur = $this->requetes->getAcheteur($idLot);
					$data['acheteur'] = $acheteur;	
					$total = $this->requetes->getPoidsNet($idLot);
					$data['poidsNet'] = $total;		
					$data['lotDetails'] = $lotDetails;
                	$data['dateFin'] = $lotDetails['dateFin'] . ' ' . $lotDetails['heureFin']; // Date et heure de fin
					$this->load->view('enchere',$data);
				} else {
					// Si aucun lot trouvé
					echo "Aucun détail trouvé pour ce lot.";
				}
			} else {
				// Si l'idLot est manquant
				echo "ID du lot manquant.";
			}
		}

		if($id=="ConfirmationEnchere") {
			$this->load->view('confirmation');
		}
		
		if($id=="EchecEnchere") {
			$this->load->view('echec');
		}

		if($id=="ErreurConn") {
			$this->load->view('afficheConnexion');
		}

		if($id=="Connexion") {
			$this->load->view('connexion');
		}
		
		if($id=="Inscription") {
			$this->load->view('inscription');
		}
		
		 if($id=="Ajout") {
			// Charger les données nécessaires pour le formulaire (noms scientifiques, communs, bateaux)
            $data['nomsScientifiques'] = $this->requetes->getNomScientifiques();
            $data['nomsCommuns'] = $this->requetes->getNomCommuns();
            $data['nomsBateaux'] = $this->requetes->getNomBateaux();
			$data['descriptionPresentation'] = $this->requetes->getDescription();
			$data['qualites'] = $this->requetes->getQualité();  // Liste des qualités
    		$data['tailles'] = $this->requetes->getTaille();  // Liste des tailles
    		$data['tares'] = $this->requetes->getTare();  // Liste des tares
		 	$this->load->view('ajoutLots',$data);
			
		 }

		if($id=="MentionsLegales") {
			$this->load->view('mentionslegales');
		}
		
		if($id=="Contacts") {
			$this->load->view('contacts');
		}
		
		if($id=="Deconnexion"){
			$this->session->sess_destroy();
			redirect('welcome/contenu/Accueil');
		}
		
		$this->load->view('piedPage',NULL); // Vue piedPage à créer dans le dossier VIEWS 
		
	}

	

	public function validerInscription()
	{
	// validité du formulaire
	$this->form_validation->set_rules('login', 'login', 'required');
	$this->form_validation->set_rules('raisonSocialeEntreprise', 'raisonSocialeEntreprise', 'required');
	$this->form_validation->set_rules('numHabilitation', 'numHabilitation', 'required');
	$this->form_validation->set_rules('adresse', 'adresse', 'required');
	$this->form_validation->set_rules('ville', 'ville', 'required');
	$this->form_validation->set_rules('cp', 'cp', 'required');
	$this->form_validation->set_rules('pwd', 'pwd', 'required');
	// est-ce que c'est un retour du formulaire et est-il valide ?
		if ($this->form_validation->run() === FALSE) {
			// pas de formulaire ou champs invalides => réafficher le formulaire
			return $this->index();
			
		} else {
			// retour des données
			$this->load->view('enTete');
			//$this->load->view('menu');
			$this->load->view('afficheInscription', $_POST); // valeurs saisies
			$data['utilisateurs']= $this->requetes->setUtilisateur($_POST['login'],$_POST['pwd'],$_POST['raisonSocialeEntreprise'],$_POST['adresse'],$_POST['ville'],$_POST['cp'],$_POST['numHabilitation']); 
			$this->load->view('piedPage',$data); // Vue piedPage à créer dans le dossier VIEWS
		}
	}

	public function validerAjoutLot() 
	{
	// validité du formulaire
	$this->form_validation->set_rules('datePeche', 'Date de pêche', 'required');
	$this->form_validation->set_rules('IdBateau', 'Nom du bateau', 'required');
	$this->form_validation->set_rules('IdEspece', 'Nom commun', 'required');
	$this->form_validation->set_rules('dateOuverture', 'Date d\'ouverture', 'required');
	$this->form_validation->set_rules('heureOuverture', 'Heure d\'ouverture', 'required');
	$this->form_validation->set_rules('dateFermeture', 'Date de fermeture', 'required');
	$this->form_validation->set_rules('heureFermeture', 'Heure de fermeture', 'required');
	$this->form_validation->set_rules('prixDepart', 'Prix de départ', 'required');
	$this->form_validation->set_rules('PoidsBrut', 'Poids brut', 'required');
	$this->form_validation->set_rules('IdQualite', 'Qualité', 'required');
	$this->form_validation->set_rules('taille', 'Taille', 'required');
	$this->form_validation->set_rules('IdBac', 'Tare', 'required');
	$this->form_validation->set_rules('IdPresentation', 'Description', 'required');
	
	if ($this->form_validation->run() === FALSE) {
		// Si la validation échoue, afficher à nouveau le formulaire
		$this->load->view('ajoutLots');
	} else {
			// Récupération des données du formulaire
			$lotData = [
				'IdBateau' => $this->input->post('IdBateau'),
				'datePeche' => $this->input->post('datePeche'),
				'IdEspece' => $this->input->post('IdEspece'), 
				'IdTaille' => $this->input->post('taille'),
				'IdPresentation' => $this->input->post('IdPresentation'),
				'IdBac' => $this->input->post('IdBac'),
				'IdQualite' => $this->input->post('IdQualite'),
				'poidsBrutLot' => $this->input->post('PoidsBrut'),
				'prixDepart' => $this->input->post('prixDepart'),
				'prixEnchereActuelle' => $this->input->post('prixDepart'), 
				'dateOuverture' => $this->input->post('dateOuverture'),
				'dateFin' => $this->input->post('dateFermeture'), 
				'heureOuverture' => $this->input->post('heureOuverture'),
				'heureFin' => $this->input->post('heureFermeture'), 
				'IdAdmin' => $this->session->userdata('user_id') 
			];
		
			// Appel au modèle pour insérer le lot dans la base de données
			$this->requetes->setLot(
				$lotData['IdBateau'],
				$lotData['IdEspece'],
				$lotData['datePeche'],
				$lotData['IdTaille'],
				$lotData['IdPresentation'],
				$lotData['IdBac'],
				$lotData['IdQualite'],
				$lotData['poidsBrutLot'],
				$lotData['prixDepart'],
				$lotData['prixEnchereActuelle'],
				$lotData['dateOuverture'],
				$lotData['dateFin'],
				$lotData['heureOuverture'],
				$lotData['heureFin'],
				$lotData['IdAdmin']
			);

			// Appel au modèle pour insérer peche dans la base de données
			$this->requetes->setPeche(
				$lotData['IdBateau'],
				$lotData['datePeche']
			);
		
			// Rediriger après insertion
			redirect('welcome/contenu/Accueil');
		}
	}

	public function login() {
		$this->form_validation->set_rules('login', 'Login', 'required');
		$this->form_validation->set_rules('pwd', 'Password', 'required');
	
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('connexion'); // Réaffiche la vue de connexion si validation échoue
		} else {
			$login = $this->input->post('login');
			$pwd = $this->input->post('pwd');
			
			$result = $this->requetes->verifyAdmin($login, $pwd);
			if (!empty($result)) {
				// Stocker les informations utilisateur dans la session
				$this->session->set_userdata([
					'user_id' => $result['IdAdmin'],
					'user_login' => $result['loginAdmin'],
					'is_logged_in' => TRUE,
					'is_admin' => TRUE,
				]);
	
				// Redirection vers une page après connexion
				redirect('welcome/contenu/EncheresEnCours');
			} else {
				// Vérifiez les informations dans la base de données
				$result = $this->requetes->verifyLogin($login, $pwd);	
				if (!empty($result)) {
					// Stocker les informations utilisateur dans la session
					$this->session->set_userdata([
						'user_id' => $result['IdAcheteur'],
						'user_login' => $result['login'],
						'is_logged_in' => TRUE,
					]);
		
					// Redirection vers une page après connexion
					redirect('welcome/contenu/EncheresEnCours');
				} else {
					redirect('welcome/contenu/ErreurConn');
				}
			}
		}
	}

	public function insererFacture() {
		$this->load->model('requetes');
	
		$idAcheteur = $this->session->userdata('user_id');
		$lots = $this->input->post('idLot'); 
		$total = $this->input->post('montantTotal'); // total du panier
		$heureCommande = date('Y-m-d H:i:s');
	
		//Insérer l'entête de facture
		$idFacture = $this->requetes->setFactureEntete(date('Y-m-d'),$heureCommande , $total, $idAcheteur);
	
		//Insérer chaque ligne dans facture_details
		if (is_array($lots)) {
			foreach ($lots as $idLot) {
				$montant = $this->requetes->getMontantEnchereParLot($idLot);
				$this->requetes->insertFactureDetail($idFacture, $idLot, $montant);
				$this->requetes->supprimerDuPanier($idLot);
			}
		}
		redirect('welcome/contenu/confirmationPaiement');
	}

	public function placerEnchere() {
		if ($this->session->userdata('is_logged_in')) {
			$idLot = $this->input->post('IdLot');
			$montantEnchere = $this->input->post('montantEnchere');
			$idAcheteur = $this->session->userdata('user_id'); // Récupérer l'ID de l'acheteur à partir de la session
			
			// Vérifiez si le montant de l'enchère est valide
			if ($this->requetes->enregistreEnchere($idLot, $idAcheteur, $montantEnchere)) {
				// Redirigez l'utilisateur vers une page de confirmation après l'enchère
				redirect('welcome/contenu/ConfirmationEnchere');
			} else {
				redirect('welcome/contenu/EchecEnchere');
			}
			
		} else {
			// Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
			$this->session->set_flashdata('error', 'Vous devez être connecté pour enchérir.');
			redirect('welcome/contenu/Connexion');
		}
	}

	public function afficherPanier() {
        // Récupérer l'ID de l'acheteur à partir de la session
        $userId = $this->session->userdata('user_id');
        
        // Si l'utilisateur est connecté, récupérer les informations du panier
        if ($userId) {
            $data['panier'] = $this->requetes->getInfosPanier($userId);
            
            // Charger la vue avec les données du panier
            $this->load->view('panier', $data);
        } else {
            // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
            redirect('welcome/contenu/Connexion');
        }
    }

}
