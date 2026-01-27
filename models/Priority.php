<?php
class Priorities
{
	private $id_priority;
	private $name;

	public function __construct($name, $id_priority = null)
	{
		$this->name = $name;
		$this->id_priority = $id_priority;
	}

	// Getters
	public function getIdPriorities()
	{
		return $this->id_priority;
	}
	public function getPrioritiesName()
	{
		return $this->name;
	}
}
