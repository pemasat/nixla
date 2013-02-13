<?php

/**
 * Homepage presenter.
 *
 * @author     petr.masat
 * @package    MyApplication
 */
class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
		
	}

}
