<?php

use \Phalcon\Tag;
use \Phalcon\Mvc\Model\Query;

class DashboardController extends BaseController
{

	public function indexAction()
	{
		Tag::setTitle('Dashboard');
		parent::initialize();

		$surveys = $this->modelsManager->createBuilder()
			->columns('Survey.*,Agent.*')
			->from('Survey')
			->where('driver = "Driver 1"')
		    ->join('Survey', 'Survey.client_id = Agent.client_id', 'Agent')
		    ->getQuery()
		    ->execute();
		//$surveys = $query->executeQuery();

    	//	SELECT `Agent`.`id`, `Agent`.`client_id`, `Agent`.`driver`, `Agent`.`score` FROM `survey` LEFT JOIN `survey` AS `Agent` ON `survey`.`client_id` = `Agent`.`client_id` WHERE (`Agent`.`client_id` = 234) AND (`Agent`.`driver` = 'Driver 2') ) [_sqlStatement:protected] => SELECT `Agent`.`id`, `Agent`.`client_id`, `Agent`.`driver`, `Agent`.`score` FROM `survey` LEFT JOIN `survey` AS `Agent` ON `survey`.`client_id` = `Agent`.`client_id` WHERE (`Agent`.`client_id` = 234) AND (`Agent`.`driver` = 'Driver 2')

    	//print_r($surveys);

		foreach($surveys as $survey) {
			//echo $survey->id.' / '.$survey->score.' / '.$survey->driver.'<br>';
			echo $survey->score.'<br>';
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