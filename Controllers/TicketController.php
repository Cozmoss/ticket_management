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
				trim($ticket["client_fname"] . " " . $ticket["client_lname"]),
				$ticket["device_model"],
				$ticket["status"],
				$ticket["priority"],
				trim($ticket["created_by_fname"] . " " . $ticket["created_by_lname"]),
				trim($ticket["assigned_to_fname"] . " " . $ticket["assigned_to_lname"]),
				$ticket["id_ticket"] ?? null,
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
				trim($ticket["client_fname"] . " " . $ticket["client_lname"]),
				$ticket["device_model"],
				$ticket["status"],
				$ticket["priority"],
				trim($ticket["created_by_fname"] . " " . $ticket["created_by_lname"]),
				trim($ticket["assigned_to_fname"] . " " . $ticket["assigned_to_lname"]),
				$ticket["id_ticket"] ?? null,
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
}
