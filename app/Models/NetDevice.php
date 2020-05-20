<?php

class NetDevice
{
	private $device;
	private $type;
	private $state;
	private $connection;

	/**
	 * @return mixed
	 */
	public function getDevice()
	{
		return $this->device;
	}

	/**
	 * @param mixed $device
	 * @return WifiDevice
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
	 * @return WifiDevice
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
	 * @return WifiDevice
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
	 * @return WifiDevice
	 */
	public function setConnection($connection)
	{
		$this->connection = $connection;
		return $this;
	}



}
