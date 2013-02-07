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
	}
	
	public function renderCache() {
		$dir = WWW_DIR . '/../web/zefola.cz/cache/';
		foreach (Finder::findFiles('*.pdf')->in($dir) as $key => $file) {
			//header('Content-Disposition: attachment; filename='.basename($file));
			//\Nette\Http\Request::
			//header('Content-type: image/gif');
			/*
			header('Content-type: application/pdf');
			ob_clean();
			flush();
			readfile('/var/www/zefola/www/zefola.cz/cache/behani21.pdf');
			exit;*/
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
