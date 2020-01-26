<?php
/*
** abstract class for all our controller classes
*/

// namespace App\Controller;
// use App\Model\User;

abstract class Controller
{

    protected $data = array();//used for view templating 
    protected $view = ""; 
    protected $head = array('title' => '', 'description' => '');//set title and description of view html head 

    abstract function process($params);
    
    //renders the view
    public function renderView(): void
    {
        if ($this->view)
        {
        extract($this->data);
        require("app/View/" . $this->view . ".phtml");
        }
    }

    //redirection
    public function redirect($url): void
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }
    //authenticate user
    public function authUser(): void
    {
        $userInstance= new User();
        $user = $userInstance->getUser();
        if (!$user)
        {
            $this->redirect('login');
        }
    }

}