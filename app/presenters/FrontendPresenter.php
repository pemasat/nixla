<?php

/**
 * Test presenter.
 *
 * @author     pm
 * @package    MyApplication
 */
class FrontendPresenter extends BasePresenter {

	public function renderDefault() {
		\Nette\Diagnostics\FireLogger::log('555555555555555555555555555');
		$this->template->asd = $this->context->page->getPage('asd');
		\Nette\Diagnostics\FireLogger::log($this->context);
		$this->template->setSource('CCCC');
		$this->template->setFile(APP_DIR . '/templates/umcaca.latte');
	}
	
	public function renderCache($file) {
		header('Content-type: image/gif');
		readfile($file);
		exit;
		
		$this->template->setFile(APP_DIR . '/templates/umcaca.latte');
	}
	

	
}
