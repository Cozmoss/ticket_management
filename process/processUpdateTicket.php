<?php
session_start();

require_once "../Controllers/TicketController.php";
require_once "../Controllers/InterventionController.php";

// Récupération des données du formulaire
$ticket_id = $_POST["ticket_id"] ?? null;
$priority_id = $_POST["priority_id"] ?? null;
$status_id = $_POST["status_id"] ?? null;
$assigned_to = $_POST["assigned_to"] ?? null;

// Pour l'ajout d'une intervention
$intervention_user_id = $_POST["intervention_user_id"] ?? null;
$intervention_start_at = $_POST["intervention_start_at"] ?? null;
$intervention_end_at = $_POST["intervention_end_at"] ?? null;

try {
	$ticket = TicketController::getTicketById($ticket_id);

	if (!$ticket) {
		header("Location: ../views/ticket.php?error=ticket_not_found");
		exit();
	}

	// Met à jour les champs modifiables
	if ($priority_id) {
		$ticket->priority_id = $priority_id;
	}
	if ($status_id) {
		$ticket->status_id = $status_id;
	}
	if ($assigned_to) {
		$ticket->assigned_to = $assigned_to;
	}

	// Mets à jour le ticket en base
	TicketController::updateTicket($ticket);

	// Ajout d'une intervention si tous les champs sont remplis
	if ($intervention_user_id && $intervention_start_at && $intervention_end_at) {
		InterventionController::addIntervention($ticket_id, $intervention_user_id, $intervention_start_at, $intervention_end_at);
	}

	header("Location: ../views/ticket.php?success=ticket_updated");
	exit();
} catch (Exception $e) {
	header("Location: ../views/ticket.php?error=ticket_update_failed");
	exit();
}
