<?php
class Type
{
	private $id_type;
	private $name;

	public function __construct($name, $id_type = null)
	{
		$this->name = $name;
		$this->id_type = $id_type;
	}

	// Getters
	public function getIdType()
	{
		return $this->id_type;
	}
	public function getTypeName()
	{
		return $this->name;
	}
}
