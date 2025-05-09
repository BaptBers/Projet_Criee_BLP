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
			<h1>Vente aux enchères de Cornouailles</h1>
		</div>
		<?php if(!isset($_SESSION["is_logged_in"])) : ?>
		<div class="auth-boutons">		
			<a href="<?php echo site_url('welcome/contenu/Connexion');?>" class ="button">CONNEXION</a>
			<a href="<?php echo site_url('welcome/contenu/Inscription');?>" class ="button">INSCRIPTION</a>
    	</div>
		<?php else: 
			$login = $_SESSION['user_login']; ?> 
		<div class="auth-boutons">		
			<?php echo "<p class ='login'>" . $login. "</p>";?>
			<a href="<?php echo site_url('welcome/contenu/Deconnexion');?>" class ="button">DÉCONNEXION</a>
		</div>
		<?php endif; ?>
	</header>
	<br>
	<nav>
		<div class="nav-milieu">
			<a href="<?php echo site_url('welcome/contenu/EncheresEnCours');?>" class ="button">ENCHÈRES EN COURS</a>  
			<a href="<?php echo site_url('welcome/contenu/FuturesEncheres');?>" class ="button">FUTURES ENCHÈRES</a> 
			<?php if(isset($_SESSION["is_admin"])):?>
				<a href="<?php echo site_url('welcome/contenu/Ajout');?>" class ="button">AJOUT DE LOTS</a>	
			<?php endif; ?>
		</div>
			
		<div class="nav-droite">
			<a href="<?php echo site_url('welcome/contenu/Panier');?>" class ="button">MON PANIER</a>
		</div>
			
	</nav>







