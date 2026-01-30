<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
	header("Location: login.php");
}

if (!isset($mainContent)) {
	$mainContent = "";
}

$currentPage = basename($_SERVER["PHP_SELF"]);

require_once "../Controllers/UserController.php";
require_once "../models/User.php";
require_once "../Controllers/TicketController.php";
require_once "../models/Ticket.php";
require_once "../Controllers/PrioritiesController.php";
require_once "../models/Priority.php";
require_once "../Controllers/RoleController.php";
require_once "../models/Role.php";

$users = UserController::getUsers();
// Tableau associatif id utilisateur => nom complet
$userNamesById = [];
foreach ($users as $u) {
	$userNamesById[$u->getId()] = $u->getFname() . " " . $u->getLname();
}
$user = UserController::getUser($_SESSION["Email"]);

$roles = RoleController::getRoles();

// Si superviseur ou team leader, on récupère tous les tickets, sinon seulement ceux assignés à l'utilisateur
if ($_SESSION["user_role"] === "Superviseur" || $_SESSION["user_role"] === "Team Leader") {
	$allTickets = TicketController::getTickets();
} else {
	$allTickets = TicketController::getTicketsByAssigned($_SESSION["id_user"]);
}
$tickets = $allTickets; // On filtre $tickets pour le premier tableau
// Compter les tickets résolus par utilisateur assigné
$ticketsResolusParUser = [];
foreach ($allTickets as $ticket) {
	if ($ticket->getStatusName() === "Résolu") {
		$userId = $ticket->getAssignedTo();
		if (!isset($ticketsResolusParUser[$userId])) {
			$ticketsResolusParUser[$userId] = 0;
		}
		$ticketsResolusParUser[$userId]++;
	}
}

$priorities = PrioritiesController::getPriorities();
// Gestion des priorités sélectionnées (checkboxes)
$priorityNames = array_map(function ($priority) {
	return $priority->getPrioritiesName();
}, $priorities);

$selectedPriorities = isset($_GET["priority"]) ? (array) $_GET["priority"] : [];
$selectedPriorities = array_filter($selectedPriorities); // remove empty values

if (!empty($selectedPriorities)) {
	$tickets = array_filter($tickets, function ($ticket) use ($selectedPriorities) {
		return in_array($ticket->getPriorityName(), $selectedPriorities);
	});
}
