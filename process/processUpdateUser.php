<?php
session_start();
require_once "../models/User.php";
require_once "../Controllers/UserController.php";

// Récupération des données du formulaire
$fname = trim($_POST["fname"]);
$lname = trim($_POST["lname"]);
$email = trim($_POST["email"]);
$phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : null;
$id = $_POST["id"];

// Récupération de l'utilisateur actuel depuis la db
$currentUser = UserController::getUser($_SESSION["Email"]);
if (!$currentUser) {
	header("Location: ../views/profil.php?error=user_not_found");
	exit();
}

// Gestion du MDP
if (!empty($_POST["password"])) {
	$pwd = password_hash($_POST["password"], PASSWORD_BCRYPT);
} else {
	$pwd = $currentUser->getPassword();
}

//Gestion du rôle
$role_id = isset($_POST["role"]) ? $_POST["role"] : $currentUser->getRole();

$user = new User($fname, $lname, $email, $phone, $pwd, $role_id, $id);

// MAJ du client en base
try {
	UserController::updateUser($user);
	header("Location: ../views/profil.php?success=user_updated");
	exit();
} catch (Exception $e) {
	// En cas d'erreur, redirige avec un message d'erreur
	header("Location: ../views/profil.php?error=user_update_failed");
	exit();
}
