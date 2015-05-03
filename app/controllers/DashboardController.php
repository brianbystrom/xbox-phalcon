<?php

use \Phalcon\Tag;
use \Phalcon\Mvc\Model\Query;

class DashboardController extends BaseController
{

	public function indexAction()
	{
		Tag::setTitle('Dashboard');
		parent::initialize();

		$managers = getManagers();

		//$managers = Manager::find();

		$agents = array();

		foreach ($managers as $manager) {
			foreach ($manager->agent as $agent) {
				$agents[] = $agent->client_id;
			}
		}



		print_r($agents);
		die;

		$surveys = $this->modelsManager->createBuilder()
			->from('Survey')
			->where('driver LIKE "%_%"')
			->andWhere('score LIKE "%_%"')
			->inWhere('client_id', $agents)
		    ->getQuery()
		    ->execute();
		//$surveys = $query->executeQuery();

    	//	SELECT `Agent`.`id`, `Agent`.`client_id`, `Agent`.`driver`, `Agent`.`score` FROM `survey` LEFT JOIN `survey` AS `Agent` ON `survey`.`client_id` = `Agent`.`client_id` WHERE (`Agent`.`client_id` = 234) AND (`Agent`.`driver` = 'Driver 2') ) [_sqlStatement:protected] => SELECT `Agent`.`id`, `Agent`.`client_id`, `Agent`.`driver`, `Agent`.`score` FROM `survey` LEFT JOIN `survey` AS `Agent` ON `survey`.`client_id` = `Agent`.`client_id` WHERE (`Agent`.`client_id` = 234) AND (`Agent`.`driver` = 'Driver 2')

    	//print_r($surveys);

		$scores = array();

		foreach($surveys as $survey) {
			//echo $survey->id.' / '.$survey->score.' / '.$survey->driver.'<br>';
			$scores[] = $survey->client_id;
		}

		print_r($scores);

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