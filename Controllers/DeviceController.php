<?php
require_once "../DAO/DeviceDAO.php";
require_once __DIR__ . "/../models/Device.php";

class DeviceController
{
	public static function getDevices()
	{
		$devicesObjet = [];
		$devices = DeviceDAO::getDevices();
		foreach ($devices as $device) {
			$devicesObjet[] = new Device($device["id_device"], $device["model"], $device["serial_number"], $device["brand"], $device["type_id"], $device["client_id"], $device["submission_date"], $device["retrieve_date"]);
		}
		return $devicesObjet;
	}

	public static function getDevice($id)
	{
		$device = DeviceDAO::getDevice($id);
		if ($device) {
			return new Device($device["id_device"], $device["model"], $device["serial_number"], $device["brand"], $device["type_id"], $device["client_id"], $device["submission_date"], $device["retrieve_date"]);
		}
		return null;
	}
	public static function addDevice($device)
	{
		return DeviceDAO::addDeviceDAO($device);
	}
}
