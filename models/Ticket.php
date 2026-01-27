<?php
class Ticket
{
	private $id_ticket;
	private $ticket_number;

	// Pour affichage
	private $client_name;
	private $device_name;
	private $status_name;
	private $priority_name;

	// Pour insertion
	private $client_id;
	private $device_id;
	private $status_id;
	private $priority_id;

	private $created_by;
	private $assigned_to;

	public function __construct(
		$ticket_number,
		$client, // id ou nom
		$device, // id ou nom
		$status, // id ou nom
		$priority, // id ou nom
		$created_by,
		$assigned_to,
		$id_ticket = null,
	) {
		$this->ticket_number = $ticket_number;

		// Si c'est un entier, on stocke l'id, sinon le nom
		if (is_numeric($client)) {
			$this->client_id = $client;
			$this->client_name = null;
		} else {
			$this->client_name = $client;
			$this->client_id = null;
		}
		if (is_numeric($device)) {
			$this->device_id = $device;
			$this->device_name = null;
		} else {
			$this->device_name = $device;
			$this->device_id = null;
		}
		if (is_numeric($status)) {
			$this->status_id = $status;
			$this->status_name = null;
		} else {
			$this->status_name = $status;
			$this->status_id = null;
		}
		if (is_numeric($priority)) {
			$this->priority_id = $priority;
			$this->priority_name = null;
		} else {
			$this->priority_name = $priority;
			$this->priority_id = null;
		}

		$this->created_by = $created_by;
		$this->assigned_to = $assigned_to;
		$this->id_ticket = $id_ticket;
	}

	// Getters pour affichage
	public function getIdTicket()
	{
		return $this->id_ticket;
	}
	public function getTicketNumber()
	{
		return $this->ticket_number;
	}
	public function getClientName()
	{
		return $this->client_name;
	}
	public function getDeviceName()
	{
		return $this->device_name;
	}
	public function getStatusName()
	{
		return $this->status_name;
	}
	public function getPriorityName()
	{
		return $this->priority_name;
	}
	public function getCreatedBy()
	{
		return $this->created_by;
	}
	public function getAssignedTo()
	{
		return $this->assigned_to;
	}

	// Getters pour insertion
	public function getClientId()
	{
		return $this->client_id;
	}
	public function getDeviceId()
	{
		return $this->device_id;
	}
	public function getStatusId()
	{
		return $this->status_id;
	}
	public function getPriorityId()
	{
		return $this->priority_id;
	}

	// Setters (optionnel)
	public function setAssignedTo($assigned_to)
	{
		$this->assigned_to = $assigned_to;
	}
}
