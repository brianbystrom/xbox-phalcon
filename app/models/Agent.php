<?php

use Phalcon\Mvc\Model;

class Agent extends Model
{
	public $id;
	public $client_id;

	public function initialize()
	{
		$this->belongsTo('supervisor_id','Manager','client_id');
		$this->hasMany('client_id','Survey','client_id');
	}
}