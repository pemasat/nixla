<?php

use Nette\Application\PresenterRequest;

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class DynamicRoute extends \Nette\Application\Routers\Route {
	/** @var SystemContainer */
	public $context;
	
	public function match(\Nette\Http\IRequest $request) {
		/** @var $appRequest \Nette\Application\Request */
		$appRequest = parent::match($request);
		
		
		// doplněno: pokud match vrátí NULL, musíme také vrátit NULL
		if ($appRequest === NULL) {
			return NULL;
		}
		
/*		
		\Nette\Diagnostics\FireLogger::log('aaa');
		\Nette\Diagnostics\FireLogger::log($request->getUrl()->host);
		\Nette\Diagnostics\FireLogger::log('aaa');
*/
		// $pages = $this->context->createPages();
		\Nette\Diagnostics\FireLogger::log($this->context);
		
		$data = array(
			'action' => 'cache'
		);
		return new Nette\Application\Request('Frontend', 'POST', $data);
		// return NULL;
	}

}