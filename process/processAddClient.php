<?php
session_start();
require_once "../models/Client.php";
require_once "../Controllers/ClientController.php";

// Vérification des champs obligatoires
$required = ["fname", "lname", "email"];
foreach ($required as $field) {
	if (empty($_POST[$field])) {
		header("Location: ../views/index.php?error=missing_client_field");
		exit();
	}
}

// Récupération des données du formulaire
$fname = trim($_POST["fname"]);
$lname = trim($_POST["lname"]);
$email = trim($_POST["email"]);
$phone = isset($_POST["phone_number"]) ? trim($_POST["phone_number"]) : null;

// Création de l'objet Client (l'id est null car auto-incrémenté)
$client = new Client(null, $fname, $lname, $email, $phone);

// Ajout du client en base
try {
	ClientController::addClient($client);
	header("Location: ../views/index.php?success=client_added");
	exit();
} catch (Exception $e) {
	// En cas d'erreur, redirige avec un message d'erreur
	header("Location: ../views/index.php?error=client_add_failed");
	exit();
}
