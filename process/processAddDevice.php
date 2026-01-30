<?php
session_start();
require_once "../models/Device.php";
require_once "../Controllers/DeviceController.php";

// Vérification des champs obligatoires
$required = ["model", "serial_number", "brand", "type_id", "client_id", "submission_date"];
foreach ($required as $field) {
	if (empty($_POST[$field])) {
		header("Location: ../views/index.php?error=missing_device_field");
		exit();
	}
}

// Récupération des données du formulaire
$model = trim($_POST["model"]);
$serialNumber = trim($_POST["serial_number"]);
$brand = trim($_POST["brand"]);
$typeId = (int) $_POST["type_id"];
$clientId = (int) $_POST["client_id"];
$submissionDate = trim($_POST["submission_date"]);
$retrieveDate = null;

// Création de l'objet Device (id = null car auto-incrémenté)
$device = new Device(null, $model, $serialNumber, $brand, $typeId, $clientId, $submissionDate, $retrieveDate);

// Ajout du device en base
try {
	DeviceController::addDevice($device);
	header("Location: ../views/index.php?success=device_added");
	exit();
} catch (Exception $e) {
	header("Location: ../views/index.php?error=device_add_failed");
	exit();
}
