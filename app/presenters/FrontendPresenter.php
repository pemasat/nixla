<?php
use \Nette\Utils\Finder;

/**
 * Test presenter.
 *
 * @author     pm
 * @package    MyApplication
 */
class FrontendPresenter extends BasePresenter {

	public function renderDefault() {
		\Nette\Diagnostics\FireLogger::log('555555555555555555555555555');
		$this->template->setFile(APP_DIR . '/templates/umcaca.latte');
	}
	
	public function renderCache($file) {
		header('Content-type: image/gif');
		readfile($file);
		exit;
		
		$dir = WWW_DIR . '/../web/www.nixla.cz/cache/';
		foreach (Finder::findFiles('*.pdf')->in($dir) as $key => $file) {
			//\Nette\Http\Request::
			//header('Content-type: image/gif');
			/* 
			header('Content-type: application/pdf');
			ob_clean();
			flush();
			readfile('/var/www/www.nixla.cz/web/www.nixla.cz/cache/behani21.pdf');
			exit; */
		}
		$aaa = new \Nette\Http\Response();
		$this->template->setFile(APP_DIR . '/templates/umcaca.latte');
/*
		$dir = WWW_DIR . '/../';
		foreach (Finder::findFiles('*')->in($dir) as $key => $file) {
			\Nette\Diagnostics\FireLogger::log('asd');
			\Nette\Diagnostics\FireLogger::log($file);
		}
*/
	}
	

	
}
