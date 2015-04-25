<?php

use \Phalcon\Tag;

class SigninController extends BaseController
{
    public function indexAction()
    {
        Tag::setTitle('Index');  
        parent::initialize();
    }

    public function registerAction()
    {
    	$user = User::findFirst(1);
    	$test = $user->created_on;
    	echo $test;	
    	die;
  


/*
        //Store and check for errors
        $success = $user->save($this->request->getPost(), array('id', 'username'));

        if ($success) {
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";
            foreach ($user->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();*/
    }
}