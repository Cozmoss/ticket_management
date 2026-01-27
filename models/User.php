<?php
class User
{
	private $id;
	private $fname;
	private $lname;
	private $email;
	private $phone;
	private $password;
	private $role;

	public function __construct($fname, $lname, $email, $phone, $password, $role, $id = null)
	{
		$this->fname = $fname;
		$this->lname = $lname;
		$this->email = $email;
		$this->phone = $phone;
		$this->password = $password;
		$this->role = $role;
		$this->id = $id;
	}

	// Getters
	public function getFname()
	{
		return $this->fname;
	}

	public function getLname()
	{
		return $this->lname;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function getRole()
	{
		return $this->role;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function getId()
	{
		return $this->id;
	}
	public function __toString()
	{
		return sprintf("User [id=%s, fname=%s, lname=%s, email=%s, phone=%s, role=%s]", $this->id ?? "null", $this->fname, $this->lname, $this->email, $this->phone, $this->role);
	}
}
