<?php
namespace App\HomepageModule\Presenters;

use Nette;
use App\Model;
use App\Forms;


class HomepagePresenter extends BasePresenter
{
	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}


}
