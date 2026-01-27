<?php
class Status
{
	private $id_status;
	private $name;

	public function __construct($name, $id_status = null)
	{
		$this->name = $name;
		$this->id_status = $id_status;
	}

	// Getters
	public function getIdStatus()
	{
		return $this->id_status;
	}
	public function getStatusName()
	{
		return $this->name;
	}
}
