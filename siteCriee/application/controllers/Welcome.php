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
			$this->load->view('encheresencours',$data); // Créer une vue nommée formulaire.php dans VIEWS		
		}

		if($id=="FuturesEncheres")
		{
			$data['labelFuturesEncheres']= $this->requetes->getLotsFutures();
			$this->load->view('futuresencheres',$data); // Créer une vue nommée formulaire.php dans VIEWS		
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
			$this->load->view('ajoutLots');
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

	public function valider()
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
