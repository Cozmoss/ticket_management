<?php
require_once "config/MonPDO.php";

// Toutes les opérations CRUD pour les tickets
class TicketDAO
{
	public static function getTickets()
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT
			t.id_ticket,
			t.ticket_number,
			t.client_id,
			t.device_id,
			t.status_id,
			t.priority_id,
			t.created_by,
			t.assigned_to,
			c.fname AS client_fname,
			c.lname AS client_lname,
			d.model AS device_model,
			s.nom AS status,
			p.nom AS priority,
			u.fname AS created_by_fname,
			u.lname AS created_by_lname,
			ua.fname AS assigned_to_fname,
			ua.lname AS assigned_to_lname
		FROM tickets t
			LEFT JOIN clients c ON t.client_id = c.id_client
			LEFT JOIN devices d ON t.device_id = d.id_device
			LEFT JOIN status s ON t.status_id = s.id_status
			LEFT JOIN priorities p ON t.priority_id = p.id_priority
			LEFT JOIN users u ON t.created_by = u.id_user
			LEFT JOIN users ua ON t.assigned_to = ua.id_user
		ORDER BY t.id_ticket DESC";
		$stmt = $con->prepare($requete);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getTicketsByAssigned($user_id)
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT
			t.id_ticket,
			t.ticket_number,
			t.client_id,
			t.device_id,
			t.status_id,
			t.priority_id,
			t.created_by,
			t.assigned_to,
			c.fname AS client_fname,
			c.lname AS client_lname,
			d.model AS device_model,
			s.nom AS status,
			p.nom AS priority,
			u.fname AS created_by_fname,
			u.lname AS created_by_lname,
			ua.fname AS assigned_to_fname,
			ua.lname AS assigned_to_lname
		FROM tickets t
			LEFT JOIN clients c ON t.client_id = c.id_client
			LEFT JOIN devices d ON t.device_id = d.id_device
			LEFT JOIN status s ON t.status_id = s.id_status
			LEFT JOIN priorities p ON t.priority_id = p.id_priority
			LEFT JOIN users u ON t.created_by = u.id_user
			LEFT JOIN users ua ON t.assigned_to = ua.id_user
		WHERE t.assigned_to = :user_id";
		$stmt = $con->prepare($requete);
		$stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function addTicketDAO($ticket)
	{
		$con = MONPDO::getPDO();
		$requete = "INSERT INTO tickets
			(ticket_number, client_id, device_id, status_id, priority_id, created_by, assigned_to)
			VALUES (:ticket_number, :client_id, :device_id, :status_id, :priority_id, :created_by, :assigned_to)";
		$stmt = $con->prepare($requete);

		$stmt->bindValue(":ticket_number", $ticket->getTicketNumber(), PDO::PARAM_STR);
		$stmt->bindValue(":client_id", $ticket->getClientId(), PDO::PARAM_INT);
		$stmt->bindValue(":device_id", $ticket->getDeviceId(), PDO::PARAM_INT);
		$stmt->bindValue(":status_id", $ticket->getStatusId(), PDO::PARAM_INT);
		$stmt->bindValue(":priority_id", $ticket->getPriorityId(), PDO::PARAM_INT);
		$stmt->bindValue(":created_by", $ticket->getCreatedBy(), PDO::PARAM_INT);
		$stmt->bindValue(":assigned_to", $ticket->getAssignedTo(), PDO::PARAM_INT);

		$stmt->execute();
	}

	public static function updateTicketDAO($ticket)
	{
		$con = MONPDO::getPDO();
		$requete = "UPDATE tickets
			SET ticket_number = :ticket_number,
				client_id = :client_id,
				device_id = :device_id,
				status_id = :status_id,
				priority_id = :priority_id,
				created_by = :created_by,
				assigned_to = :assigned_to
			WHERE id_ticket = :id_ticket";
		$stmt = $con->prepare($requete);

		$stmt->bindValue(":id_ticket", $ticket->getIdTicket(), PDO::PARAM_INT);
		$stmt->bindValue(":ticket_number", $ticket->getTicketNumber(), PDO::PARAM_STR);
		$stmt->bindValue(":client_id", $ticket->getClientId(), PDO::PARAM_INT);
		$stmt->bindValue(":device_id", $ticket->getDeviceId(), PDO::PARAM_INT);
		$stmt->bindValue(":status_id", $ticket->getStatusId(), PDO::PARAM_INT);
		$stmt->bindValue(":priority_id", $ticket->getPriorityId(), PDO::PARAM_INT);
		$stmt->bindValue(":created_by", $ticket->getCreatedBy(), PDO::PARAM_INT);
		$stmt->bindValue(":assigned_to", $ticket->getAssignedTo(), PDO::PARAM_INT);

		$stmt->execute();
	}

	public static function deleteTicketDAO($id)
	{
		$con = MONPDO::getPDO();
		$requete = "DELETE FROM tickets WHERE id_ticket = :id_ticket";
		$stmt = $con->prepare($requete);

		$stmt->bindValue(":id_ticket", $id, PDO::PARAM_INT);

		$stmt->execute();
	}

	public static function getTicketById($id_ticket)
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT
			t.id_ticket,
			t.ticket_number,
			t.client_id,
			t.device_id,
			t.status_id,
			t.priority_id,
			t.created_by,
			t.assigned_to,
			c.fname AS client_fname,
			c.lname AS client_lname,
			d.model AS device_model,
			s.nom AS status,
			p.nom AS priority,
			u.fname AS created_by_fname,
			u.lname AS created_by_lname,
			ua.fname AS assigned_to_fname,
			ua.lname AS assigned_to_lname
		FROM tickets t
			LEFT JOIN clients c ON t.client_id = c.id_client
			LEFT JOIN devices d ON t.device_id = d.id_device
			LEFT JOIN status s ON t.status_id = s.id_status
			LEFT JOIN priorities p ON t.priority_id = p.id_priority
			LEFT JOIN users u ON t.created_by = u.id_user
			LEFT JOIN users ua ON t.assigned_to = ua.id_user
		WHERE t.id_ticket = :id_ticket";
		$stmt = $con->prepare($requete);
		$stmt->bindValue(":id_ticket", $id_ticket, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
