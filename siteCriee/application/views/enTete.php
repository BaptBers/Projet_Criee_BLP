<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Vente aux enchères</title>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/style2.css');?>">
	</head>





	<header>
		<div id="logo">
			<img src="<?php echo base_url().'assets/img/logo3.png';?>" alt="">
		</div>
		<div id="titre">
			<h1>Vente aux enchères Cornouailles</h1>
		</div>
		<div class="auth-boutons">
			<a href="<?php echo site_url('welcome/contenu/Connexion');?>" class ="button">Se connecter</a>
			<a href="<?php echo site_url('welcome/contenu/Inscription');?>" class ="button">S'inscrire</a>
    	</div>
	</header>
	



	<nav>
		<div class="nav-milieu">
			<a href="<?php echo site_url('welcome/contenu/EncheresEnCours');?>" class ="button">Enchères en cours</a>  
			<a href="<?php echo site_url('welcome/contenu/FuturesEncheres');?>" class ="button">Futures enchères</a> 
		</div>
			
		<div class="nav-droite">
			<a href="<?php echo site_url('welcome/contenu/Panier');?>" class ="button">Mon panier</a>
		</div>
			
	</nav>





