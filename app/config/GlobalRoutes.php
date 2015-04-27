<?php

class GlobalRoutes extends \Phalcon\Mvc\Router\Group
{
	public function initialize()
	{
		$this->add('/test/test/:int', [
			'controller' => 'index'
		]);
	}
}