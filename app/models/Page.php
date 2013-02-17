<?php
namespace Nixla;
use Nette;
use Nette\Database\Connection;
use \Nette\Diagnostics\FireLogger;

class Page extends \Nette\Object {
	protected $connection;


	public function __construct(Nette\Database\Connection $db) {
		\Nette\Diagnostics\FireLogger::log('11111111111AAAAAAAAAAAAAAAA');
		$this->connection = $db;
	}
	
	public function getPage($uri) {
		$aaa = $this->getTemplate(15);
		
		FireLogger::log($this->connection->fetch('SELECT * FROM `datatype`'));
		return $this->getTemplate(1);
	}
	
	private function getTemplate($id) {
		return $this->connection->fetch('SELECT * FROM template WHERE id=?', $id);
	}
	
	public function getIdByUrl($path) {
		\Nette\Diagnostics\FireLogger::log($path);
		return null;
	}

	public function getUrlById($id) {
		\Nette\Diagnostics\FireLogger::log($id);
		return null;
	}
	
}