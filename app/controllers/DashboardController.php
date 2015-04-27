<?php

use \Phalcon\Tag;
use \Phalcon\Mvc\Model\Query;

class DashboardController extends BaseController
{

	public function indexAction()
	{
		Tag::setTitle('Dashboard');
		parent::initialize();

		$query = $this->modelsManager->createQuery('SELECT * FROM survey');
		$surveys = $query->execute();

		foreach($surveys as $survey) {
			echo $survey->id.' / '.$survey->score.' / '.$survey->client_id.'<br>';
		}


		echo '<hr>';


		$manager = Manager::findFirstByClientId(648);

		foreach ($manager->agent as $agent) {
			foreach ($agent->survey as $survey) {
				//$surveys[] = $survey->id;
				echo $survey->id.' / '.$survey->score.' / '.$survey->client_id.'<br>';
			}
		}
	}
}