<?php
session_start();
require_once "../Controllers/UserController.php";

// Vérification des droits (optionnel mais recommandé)
if ($_SESSION["user_role"] !== 1 && $_SESSION["user_role"] !== 2) {
	header("Location: ../views/user.php?error=unauthorized");
	exit();
}

// Vérification des données reçues
if (!isset($_POST["user_id"], $_POST["role_client_id"])) {
	header("Location: ../views/user.php?error=missing_data");
	exit();
}

$userId = $_POST["user_id"];
$newRoleId = $_POST["role_client_id"];

try {
	UserController::updateUserRole($userId, $newRoleId);
	header("Location: ../views/user.php?success=role_updated");
	exit();
} catch (Exception $e) {
	header("Location: ../views/user.php?error=role_update_failed");
	exit();
}
