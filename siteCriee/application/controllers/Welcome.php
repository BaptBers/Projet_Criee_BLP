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
	}
	
	public function index()
	{
		$this->load->view('enTete'); // créer un fichier enTete.php dans le répertoire views
		//$this->load->view('menu'); // créer un fichier menu.php dans le répertoire views
		$this->load->view('accueil'); // créer affichage.php dans le répertoire views

		
		
		$this->load->view('piedPage'); // Vue piedPage à créer dans le dossier VIEWS
		//$this->load->view('piedPage',NULL); // Vue piedPage à créer dans le dossier VIEWS 
	}
	
	public function contenu($id)
	{
		$this->load->view('enTete');
		//$this->load->view('menu');
	
		if($id=="EncheresEnCours")
		{
			$data['labelEncheresEnCours']= $this->requetes->getLotsOuvert();
			$this->load->view('encheresencours',$data); // Créer une vue nommée formulaire.php dans VIEWS		
		}

		if($id=="FuturesEncheres")
		{
			$data['labelFuturesEncheres']= $this->requetes->getLotsFermes();
			$this->load->view('futuresencheres',$data); // Créer une vue nommée formulaire.php dans VIEWS		
		}

		if($id=="Panier")
		{
			$this->load->view('panier'); // Créer une vue nommée formulaire.php dans VIEWS		
		}
		
		if($id=="affichage") {
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
					$this->load->view('enchere', ['lotDetails' => $lotDetails]);
				} else {
					// Si aucun lot trouvé
					echo "Aucun détail trouvé pour ce lot.";
				}
			} else {
				// Si l'idLot est manquant
				echo "ID du lot manquant.";
			}
		}

		if($id=="Connexion") {
			$this->load->view('connexion');
		}
		
		if($id=="Inscription") {
			$this->load->view('inscription');
		}
		
		if($id=="MentionsLegales") {
			$this->load->view('mentionslegales');
		}
		
		if($id=="Contacts") {
			$this->load->view('contacts');
		}
		
		if($id=="Deconnexion"){
			$this->session->sess_destroy();
			$this->load->view('accueil');
		}
		
		$this->load->view('piedPage',NULL); // Vue piedPage à créer dans le dossier VIEWS 
		
	}
	
	public function enchereOuverte() {
		// Vérifier si l'ID du lot a été envoyé via POST
		$idLot = $this->input->post('idLot');
	
		// Si l'ID du lot est valide, récupérer les détails du lot
		if ($idLot) {
			$lotDetails = $this->requetes->getLotById($idLot); // Appel de la méthode pour récupérer les informations du lot
	
			// Si les détails du lot sont trouvés, afficher la vue 'enchere'
			if ($lotDetails) {
				$this->load->view('enTete');
				$this->load->view('enchere', ['lotDetails' => $lotDetails]);
				$this->load->view('piedPage',NULL);
			} else {
				echo "Aucun détail trouvé pour ce lot.";
			}
		} else {
			echo "L'ID du lot est manquant.";
		}
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
			// retour des données => afficher le produit
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
				$data['error'] = 'Login ou mot de passe incorrect';
				$this->load->view('connexion', $data);
			}
		}
	}
	
}
