<?php
class Ticket
{
	private $id_ticket;
	private $ticket_number;
	private $client_name;
	private $device_name;
	private $status_name;
	private $priority_name;
	private $created_by;
	private $assigned_to;

	public function __construct($ticket_number, $client_name, $device_name, $status_name, $priority_name, $created_by, $assigned_to, $id_ticket = null)
	{
		$this->ticket_number = $ticket_number;
		$this->client_name = $client_name;
		$this->device_name = $device_name;
		$this->status_name = $status_name;
		$this->priority_name = $priority_name;
		$this->created_by = $created_by;
		$this->assigned_to = $assigned_to;
		$this->id_ticket = $id_ticket;
	}

	// Getters
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

	// Setters (optionnel, si besoin)
	public function setAssignedTo($assigned_to)
	{
		$this->assigned_to = $assigned_to;
	}
}
