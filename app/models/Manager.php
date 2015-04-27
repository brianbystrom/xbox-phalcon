<?php

use Phalcon\Mvc\Model;

class Manager extends Model
{
	public $id;
	public $clientId;

	public function initialize()
	{
		$this->hasMany('client_id','Agent','supervisor_id');
	}
}