<?php

use Phalcon\Mvc\Model;

class Survey extends Model
{
	public $id;
	public $client_id;
	public $driver;
	public $score;

	public function initialize()
	{
		$this->belongsTo('client_id','Agent','client_id');
	}
}