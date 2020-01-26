<?php
// namespace App\Controller;
// //use Controller;
// use App\Model\User;

class PaymentController extends Controller
{
    public function process($params): void
    {
       if ($params[0] == "paynow" && isset($_POST['new-balance']))
    
        $userInstance  = new User();
        $userInstance = $userInstance->getUserById($_SESSION['user']['id']);
        $newBalance = $userInstance->getBalance();
        $newBalance= floatval($_POST['new-balance']);
        $userInstance->setBalance($newBalance);
        $newBalance = $userInstance->updateUserBalance($newBalance,$_SESSION['user']['id']);
        $this->data['newbalance'] = $newBalance;

        $this->redirect('product');
    }
}