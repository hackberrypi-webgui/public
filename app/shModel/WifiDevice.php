<?php

class WifiDevice
{
	private $name;
	private $status;

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 * @return WifiDevice
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param mixed $status
	 * @return WifiDevice
	 */
	public function setStatus($status)
	{
		$this->status = $status;
		return $this;
	}


}
