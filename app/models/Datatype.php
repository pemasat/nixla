<?php
namespace Nixla;
use Nette;

class Datatype extends \Nette\Object {
	protected $connection;


	public function __construct(Nette\Database\Connection $db) {
		\Nette\Diagnostics\FireLogger::log('XXXXXX');
		$this->connection = $db;
	}
	

	
}