<?php

class Device
{
	private $id;
	private $model;
	private $serialNumber;
	private $brand;
	private $typeId;
	private $clientId;
	private $submissionDate;
	private $retrieveDate;

	public function __construct($id, $model, $serialNumber, $brand, $typeId, $clientId, $submissionDate, $retrieveDate)
	{
		$this->id = $id;
		$this->model = $model;
		$this->serialNumber = $serialNumber;
		$this->brand = $brand;
		$this->typeId = $typeId;
		$this->clientId = $clientId;
		$this->submissionDate = $submissionDate;
		$this->retrieveDate = $retrieveDate;
	}

	public function getIdDevice()
	{
		return $this->id;
	}
	public function getModel()
	{
		return $this->model;
	}
	public function getSerialNumber()
	{
		return $this->serialNumber;
	}
	public function getBrand()
	{
		return $this->brand;
	}
	public function getTypeId()
	{
		return $this->typeId;
	}
	public function getClientId()
	{
		return $this->clientId;
	}
	public function getSubmissionDate()
	{
		return $this->submissionDate;
	}
	public function getRetrieveDate()
	{
		return $this->retrieveDate;
	}
}
