<?php

use \Phalcon\Tag;

class IndexController extends BaseController
{
    public function indexAction()
    {
        Tag::setTitle('Index');  
        parent::initialize();
    }
    
    public function startSessionAction()
    {
        $this->session->set('user', [
            'name' => 'Ted',
            'age'  => 55,
            'soOn' => 'soForth'
        ]);
        $this->session->set('name', 'Jesse');
    }
    
    public function getSessionAction()
    {
        echo $this->session->get('name');
    }
    
    public function removeSessionAction()
    {
        echo $this->session->get('name');
    }
    
    public function destroySessionAction()
    {
       echo $this->session->destroy();
    }
}