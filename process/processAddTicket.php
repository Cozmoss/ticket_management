<?php
session_start();
require_once "../models/Ticket.php";
require_once "../Controllers/TicketController.php";

// Vérification des champs obligatoires
$required = ["ticket_number", "client_id", "device_id", "status_id", "priority_id", "created_by", "assigned_to"];
foreach ($required as $field) {
	if (empty($_POST[$field])) {
		// Redirection avec message d’erreur si un champ manque
		header("Location: ../views/index.php?error=missing_field");
		exit();
	}
}

// Récupération des données du formulaire
$ticket_number = $_POST["ticket_number"];
$client_id = (int) $_POST["client_id"];
$device_id = (int) $_POST["device_id"];
$status_id = (int) $_POST["status_id"];
$priority_id = (int) $_POST["priority_id"];
$created_by = (int) $_POST["created_by"];
$assigned_to = (int) $_POST["assigned_to"];

// Création de l’objet Ticket
$ticket = new Ticket($ticket_number, $client_id, $device_id, $status_id, $priority_id, $created_by, $assigned_to);

// Ajout du ticket en base
TicketController::addTicket($ticket);

// Redirection vers l’index
header("Location: ../views/index.php?success=ticket_added");
exit();
