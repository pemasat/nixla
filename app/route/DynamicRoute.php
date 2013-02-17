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
		
		// musím si přeložit host, kvůli localhostu to není dané
		if (
			strpos($httpRequest->url->host, '.localhost') !== false && 
			!\Nette\Environment::isProduction()
		) { // jsme na localhostu
			$host = substr($httpRequest->url->host, 0, strripos($httpRequest->url->host, '.localhost')); // musíme si doménu osamostatnit od .localhost
			$host = str_replace('_', '.', $host); // na lokálu mám místo teček podtržení
		} else { // jsme na produkci
			$host = $httpRequest->url->host;
		}
		
		// zkusím zda je soubor již v cache
		if (is_file(WEB_DIR . '/' . $host . '/cache' . $httpRequest->url->path)) {
			return new Nette\Application\Request('Frontend', 'POST', array(
				'action' => 'cache',
				'file' => WEB_DIR . '/' . $host . '/cache' . $httpRequest->url->path
			));
		}
		
		/*
		if ($params = $this->doFilterParams($this->getRequestParams($appRequest), $appRequest, self::WAY_IN)) {
			return $this->setRequestParams($appRequest, $params);
		}
		*/

		// $pages = $this->context->createPages();
		$data = array(
			'action' => 'default'
		);
		return new Nette\Application\Request('Frontend', 'POST', $data);
	}

}