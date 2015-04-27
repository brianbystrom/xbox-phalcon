<?php

use \Phalcon\Tag;

class DashboardController extends BaseController
{

	public function indexAction()
	{
		Tag::setTitle('Dashboard');
		parent::initialize();

		$manager = Manager::findFirstByClientId(23);

		foreach ($manager->agent as $agent) {
			foreach ($agent->survey as $survey) {
				echo $survey->client_id.' / '.$survey->score.' / '.$survey->driver.'<br>';
			}
		}
	}
}