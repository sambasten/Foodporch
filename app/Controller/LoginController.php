<?php
// namespace App\Controller;
// //use Controller;
// use App\Model\User;

class LoginController extends Controller
{
    public function process($params): void
    {
        $userInstance  = new User();
        //if user is already logged in
        if ($userInstance->getUser())
        {
        //$this->redirect('product');
        }
        //html head
        $this->head['title'] = 'Login';
        
        //on submitting login form
        if ($_POST)
        {
            $userInstance = new User();
            $userInstance->loginUser($_POST['username'], $_POST['password']);
            echo "LOGGED IN!!";
            $this->redirect('product');
        }
        //render login page
        $this->view = 'login';
    }    
}