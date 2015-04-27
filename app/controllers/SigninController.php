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

        $password = 'thrice';

        $hash = $this->security->hash($password);
    	echo $hash;	
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

    public function doSigninAction()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = User::findFirstByUsername($email);
        
        if ($user) {
            if ($this->security->checkHash($password, $user->password)) {
                //The password is valid
                echo $user->username;

                $this->session->set('username', $user->username);
                $this->session->set('id', $user->id);

                $id = $this->session->get('id');
                $name = $this->session->get('username');

                print_r($_SESSION);
                die;
            }
        }
    }
}