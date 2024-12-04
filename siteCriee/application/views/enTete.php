<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Vente aux enchères</title>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/style2.css');?>">
	</head>

	<header>
		<div id="logo">
			<img src="<?php echo base_url().'assets/img/logo2.png';?>" alt="">
		</div>
		<div id="titre">
			<h1>Vente aux enchères Cornouailles</h1>
		</div>
		<div>
			<a href="<?php echo site_url('welcome/contenu/Connexion');?>" class ="button">Se connecter</a>
			<a href="<?php echo site_url('welcome/contenu/Inscription');?>" class ="button">S'inscrire</a>
		</div>
	</header>
	
	<nav>
			<p><a href="<?php echo site_url('welcome/contenu/Pains');?>">Enchères en cours</a>  <a href="<?php echo site_url('welcome/contenu/Pains');?>">Futures enchères</a> 
			<a href="<?php echo site_url('welcome/contenu/Pains');?>">Mon panier</a></p>
	</nav>





