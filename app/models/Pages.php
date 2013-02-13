<?php
namespace Test;
use Nette;

class Pages extends \Nette\Object {
	protected $connection;


	public function __construct(Nette\Database\Connection $db) {
		\Nette\Diagnostics\FireLogger::log('AAAAAAAAAAAAAAAA');
		$this->connection = $db;
	}
	
	public function getIdByUrl($path) {
		\Nette\Diagnostics\FireLogger::log('XXXXXXXXXXXXX');
		\Nette\Diagnostics\FireLogger::log($path);
		return 'asa';
	}

	public function getUrlById($id) {
		\Nette\Diagnostics\FireLogger::log('22222222222');
		\Nette\Diagnostics\FireLogger::log($id);
		return 'asa.html';
	}

	
}