<?php

use Nette\Application\PresenterRequest;

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class DynamicRoute extends \Nette\Application\Routers\Route {
	/** @var SystemContainer */
	public $context;

	const WAY_IN = 'in';
	const WAY_OUT = 'out';

	/** @var array */
	private $filters = array();
	
	/**
	 * @param Nette\Web\IHttpRequest $httpRequest
	 * @return Nette\Application\PresenterRequest|NULL
	 */
	public function match(\Nette\Http\IRequest $httpRequest) {
		/** @var $appRequest \Nette\Application\Request */
		$appRequest = parent::match($httpRequest);
		
		// doplněno: pokud match vrátí NULL, musíme také vrátit NULL
		if (!$appRequest) {
			return $appRequest;
		}
		
		
		

		/*
		if ($params = $this->doFilterParams($this->getRequestParams($appRequest), $appRequest, self::WAY_IN)) {
			return $this->setRequestParams($appRequest, $params);
		}
		*/

		// $pages = $this->context->createPages();
		\Nette\Diagnostics\FireLogger::log('asasa');
		\Nette\Diagnostics\FireLogger::log($this);
		\Nette\Diagnostics\FireLogger::log($this->context);
		
		$data = array(
			'action' => 'cache'
		);
		return new Nette\Application\Request('Frontend', 'POST', $data);
	}

}