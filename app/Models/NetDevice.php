<?php

class NetDevice
{
	private $device;
	private $type;
	private $state;
	private $connection;
	private $ipAddress;
	private $macAddress;
	private $chipset;
	private $driver;
	private $phy;
	private $mode;

	/**
	 * @return mixed
	 */
	public function getDevice()
	{
		return $this->device;
	}

	/**
	 * @param mixed $device
	 * @return NetDevice
	 */
	public function setDevice($device)
	{
		$this->device = $device;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param mixed $type
	 * @return NetDevice
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * @param mixed $state
	 * @return NetDevice
	 */
	public function setState($state)
	{
		$this->state = $state;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getConnection()
	{
		return $this->connection;
	}

	/**
	 * @param mixed $connection
	 * @return NetDevice
	 */
	public function setConnection($connection)
	{
		$this->connection = $connection;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIpAddress()
	{
		return $this->ipAddress;
	}

	/**
	 * @param mixed $ipAddress
	 * @return NetDevice
	 */
	public function setIpAddress($ipAddress)
	{
		$this->ipAddress = $ipAddress;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMacAddress()
	{
		return $this->macAddress;
	}

	/**
	 * @param mixed $macAddress
	 * @return NetDevice
	 */
	public function setMacAddress($macAddress)
	{
		$this->macAddress = $macAddress;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getChipset()
	{
		return $this->chipset;
	}

	/**
	 * @param mixed $chipset
	 * @return NetDevice
	 */
	public function setChipset($chipset)
	{
		$this->chipset = $chipset;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDriver()
	{
		return $this->driver;
	}

	/**
	 * @param mixed $driver
	 * @return NetDevice
	 */
	public function setDriver($driver)
	{
		$this->driver = $driver;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPhy()
	{
		return $this->phy;
	}

	/**
	 * @param mixed $phy
	 * @return NetDevice
	 */
	public function setPhy($phy)
	{
		$this->phy = $phy;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMode()
	{
		return $this->mode;
	}

	/**
	 * @param mixed $mode
	 * @return NetDevice
	 */
	public function setMode($mode)
	{
		$this->mode = $mode;
		return $this;
	}







}
