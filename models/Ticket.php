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

	public function __construct($ticket_number, $client_id, $device_id, $status_id, $priority_id, $created_by, $assigned_to, $id_ticket = null, $status_name = null, $priority_name = null, $client_name = null, $device_name = null)
	{
		$this->ticket_number = $ticket_number;
		$this->client_id = $client_id;
		$this->device_id = $device_id;
		$this->status_id = $status_id;
		$this->priority_id = $priority_id;
		$this->created_by = $created_by;
		$this->assigned_to = $assigned_to;
		$this->id_ticket = $id_ticket;
		$this->status_name = $status_name;
		$this->priority_name = $priority_name;
		$this->client_name = $client_name;
		$this->device_name = $device_name;
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

	// Setters
	public function setAssignedTo($assigned_to)
	{
		$this->assigned_to = $assigned_to;
	}
	public function setPriorityId($priority_id)
	{
		$this->priority_id = $priority_id;
	}
	public function setStatusId($status_id)
	{
		$this->status_id = $status_id;
	}
}
