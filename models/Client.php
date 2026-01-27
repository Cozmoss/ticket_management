<?php

class Client
{
	private $id;
	private $fname;
	private $lname;
	private $email;
	private $phone;

	function __construct($id, $fname, $lname, $email, $phone)
	{
		$this->id = $id;
		$this->fname = $fname;
		$this->lname = $lname;
		$this->email = $email;
		$this->phone = $phone;
	}

	//Getters
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
	public function getIdClient()
	{
		return $this->id;
	}
}
