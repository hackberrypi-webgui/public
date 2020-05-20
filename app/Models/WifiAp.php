<?php


class WifiAp
{
	private $inUse;
	private $ssid;
	private $mode;
	private $channel;
	private $rate;
	private $bars;
	private $security;
	private $signal;

	/**
	 * @return mixed
	 */
	public function getInUse()
	{
		return $this->inUse;
	}

	/**
	 * @param mixed $inUse
	 * @return WifiAp
	 */
	public function setInUse($inUse)
	{
		$this->inUse = $inUse;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSsid()
	{
		return $this->ssid;
	}

	/**
	 * @param mixed $ssid
	 * @return WifiAp
	 */
	public function setSsid($ssid)
	{
		$this->ssid = $ssid;
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
	 * @return WifiAp
	 */
	public function setMode($mode)
	{
		$this->mode = $mode;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getChannel()
	{
		return $this->channel;
	}

	/**
	 * @param mixed $channel
	 * @return WifiAp
	 */
	public function setChannel($channel)
	{
		$this->channel = $channel;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getRate()
	{
		return $this->rate;
	}

	/**
	 * @param mixed $rate
	 * @return WifiAp
	 */
	public function setRate($rate)
	{
		$this->rate = $rate;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getBars()
	{
		return $this->bars;
	}

	/**
	 * @param mixed $bars
	 * @return WifiAp
	 */
	public function setBars($bars)
	{
		$this->bars = $bars;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSecurity()
	{
		return $this->security;
	}

	/**
	 * @param mixed $security
	 * @return WifiAp
	 */
	public function setSecurity($security)
	{
		$this->security = $security;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSignal()
	{
		return $this->signal;
	}

	/**
	 * @param mixed $signal
	 * @return WifiAp
	 */
	public function setSignal($signal)
	{
		$this->signal = $signal;
		return $this;
	}





}
