<?php
require_once "../DAO/TicketDAO.php";
require_once __DIR__ . "/../models/Ticket.php";

class TicketController
{
	// Récupère tous les tickets sous forme d'objets Ticket
	public static function getTickets()
	{
		$ticketsObjet = [];
		$tickets = TicketDAO::getTickets();

		foreach ($tickets as $ticket) {
			$ticketsObjet[] = new Ticket(
				$ticket["ticket_number"],
				$ticket["client_id"],
				$ticket["device_id"],
				$ticket["status_id"],
				$ticket["priority_id"],
				$ticket["created_by"],
				$ticket["assigned_to"],
				$ticket["id_ticket"] ?? null,
				$ticket["status"],
				$ticket["priority"],
				$ticket["client_fname"] . " " . $ticket["client_lname"],
				$ticket["device_model"],
			);
		}
		return $ticketsObjet;
	}

	// Récupère les tickets assignés à un utilisateur donné
	public static function getTicketsByAssigned($user_id)
	{
		$ticketsObjet = [];
		$tickets = TicketDAO::getTicketsByAssigned($user_id);

		foreach ($tickets as $ticket) {
			$ticketsObjet[] = new Ticket(
				$ticket["ticket_number"],
				$ticket["client_id"],
				$ticket["device_id"],
				$ticket["status_id"],
				$ticket["priority_id"],
				$ticket["created_by"],
				$ticket["assigned_to"],
				$ticket["id_ticket"] ?? null,
				$ticket["status"],
				$ticket["priority"],
				$ticket["client_fname"] . " " . $ticket["client_lname"],
				$ticket["device_model"],
			);
		}
		return $ticketsObjet;
	}

	// Ajoute un ticket (créé par un superviseur et assigné à un utilisateur)
	public static function addTicket($ticket)
	{
		return TicketDAO::addTicketDAO($ticket);
	}

	// Met à jour un ticket (y compris l'assignation)
	public static function updateTicket($ticket)
	{
		return TicketDAO::updateTicketDAO($ticket);
	}

	// Supprime un ticket
	public static function deleteTicket($id_ticket)
	{
		return TicketDAO::deleteTicketDAO($id_ticket);
	}

	// Récupère un ticket par son id et retourne un objet Ticket
	public static function getTicketById($id_ticket)
	{
		$data = TicketDAO::getTicketById($id_ticket);
		if (!$data) {
			return null;
		}
		return new Ticket($data["ticket_number"], $data["client_id"], $data["device_id"], $data["status_id"], $data["priority_id"], $data["created_by"], $data["assigned_to"], $data["id_ticket"] ?? null, $data["status"], $data["priority"]);
	}
}
