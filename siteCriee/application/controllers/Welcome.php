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
		//$this->load->library('session');
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
			$this->load->view('futuresencheres'); // Créer une vue nommée formulaire.php dans VIEWS		
		}

		if($id=="Panier")
		{
			$this->load->view('panier'); // Créer une vue nommée formulaire.php dans VIEWS		
		}
		
		if($id=="affichage") {
			$this->load->view('accueil');
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
			// retour des données => afficher le produit
			$this->load->view('enTete');
			//$this->load->view('menu');
			$this->load->view('afficheInscription', $_POST); // valeurs saisies
			$data['utilisateurs']= $this->requetes->setUtilisateur($_POST['login'],$_POST['pwd'],$_POST['raisonSocialeEntreprise'],$_POST['adresse'],$_POST['ville'],$_POST['cp'],$_POST['numHabilitation']); 
			$this->load->view('piedPage',$data); // Vue piedPage à créer dans le dossier VIEWS
		}
	}
	
	public function validerConn()
	{
	// validité du formulaire
	$this->form_validation->set_rules('email', 'Email', 'required');
	$this->form_validation->set_rules('motdepasse', 'Motdepasse', 'required');
	// est-ce que c'est un retour du formulaire et est-il valide ?
		if ($this->form_validation->run() === FALSE) {
			// pas de formulaire ou champs invalides => réafficher le formulaire
			return $this->index();
			
		} else {
			// retour des données => afficher le produit
			$this->load->view('enTete');
			//$this->load->view('menu');
			$data['conn']= $this->requetes->getConn($_POST['email'],$_POST['motdepasse']); 
			foreach ($data['conn'] as $row) {
				$mdp = $row['password'];
			}
			if($mdp == $_POST['motdepasse'])
			{ 
				$this->load->view('commande', $data); // valeurs saisies
			}
			else{
				$this->load->view('afficheConnexion');
			}
			//$data['clients']= $this->requetes->getClients();
			$this->load->view('piedPage'); // Vue piedPage à créer dans le dossier VIEWS
		}
	}
	/*	
	public function validerCommande()
	{
		$this->form_validation->set_rules('quantite_baguette', 'Baguette');
		$this->form_validation->set_rules('quantite_campagne', 'Campagne');
		$this->form_validation->set_rules('quantite_cereales', 'Cereales');
		$this->form_validation->set_rules('quantite_croissant', 'Croissant');
		$this->form_validation->set_rules('quantite_chocolat', 'Chocolat');
		$this->form_validation->set_rules('quantite_chausson', 'Chausson');
		$this->form_validation->set_rules('quantite_fougasse', 'Fougasse');
		$this->form_validation->set_rules('quantite_epices', 'Epices');
		$this->form_validation->set_rules('quantite_galette', 'Galette');

		$this->load->view('enTete');
			
			$idUtilisateur = 1; // À remplacer par l'ID réel de l'utilisateur connecté

			$this->requetes->envoieCommande(
				$idUtilisateur,
				$_POST['quantite_baguette'],
				$_POST['quantite_campagne'],
				$_POST['quantite_cereales'],
				$_POST['quantite_croissant'],
				$_POST['quantite_chocolat'],
				$_POST['quantite_chausson'],
				$_POST['quantite_fougasse'],
				$_POST['quantite_epices'],
				$_POST['quantite_galette']
			);

			$this->load->view('afficheCommande', $_POST);
		

		$this->load->view('piedPage');
	} */
	
}
