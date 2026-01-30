<?php
class Role
{
	private $id_role;
	private $name;

	public function __construct($name, $id_role = null)
	{
		$this->name = $name;
		$this->id_role = $id_role;
	}

	// Getters
	public function getIdRole()
	{
		return $this->id_role;
	}
	public function getRoleName()
	{
		return $this->name;
	}
}
