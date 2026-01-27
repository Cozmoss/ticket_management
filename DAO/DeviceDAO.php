<?php
require_once "config/MonPDO.php";

class DeviceDAO
{
	public static function getDevices()
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_device, model, serial_number, brand, type_id, client_id, submission_date, retrieve_date FROM devices";
		$stmt = $con->prepare($requete);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getDevice($id)
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_device, model, serial_number, brand, type_id, client_id, submission_date, retrieve_date FROM devices WHERE id_device = :id";
		$stmt = $con->prepare($requete);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public static function addDeviceDAO($device)
	{
		$con = MONPDO::getPDO();
		$requete = "INSERT INTO devices (model, serial_number, brand, type_id, client_id, submission_date, retrieve_date)
                    VALUES (:model, :serial_number, :brand, :type_id, :client_id, :submission_date, :retrieve_date)";
		$stmt = $con->prepare($requete);
		$stmt->bindValue(":model", $device->getModel(), PDO::PARAM_STR);
		$stmt->bindValue(":serial_number", $device->getSerialNumber(), PDO::PARAM_STR);
		$stmt->bindValue(":brand", $device->getBrand(), PDO::PARAM_STR);
		$stmt->bindValue(":type_id", $device->getTypeId(), PDO::PARAM_INT);
		$stmt->bindValue(":client_id", $device->getClientId(), PDO::PARAM_INT);
		$stmt->bindValue(":submission_date", $device->getSubmissionDate(), PDO::PARAM_STR);
		$stmt->bindValue(":retrieve_date", $device->getRetrieveDate(), PDO::PARAM_STR);
		$stmt->execute();
	}

	public static function deleteDeviceDAO($id)
	{
		$con = MONPDO::getPDO();
		$requete = "DELETE FROM devices WHERE id_device = :id";
		$stmt = $con->prepare($requete);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
	}
}
