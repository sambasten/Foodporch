<?php
// namespace App\Controller;
// //use Controller;
// use App\Model\Product;
// use App\Model\User;

class CartController extends Controller
{
    public function process($params): void
    {
        $productInstance = new Product();
        //pass in productsid data from Ajax controller
        $productIds = explode(",", trim($_SESSION['cart'], ","));
        //var_dump($productIds); exit;
        $cartproducts = array();
            foreach($productIds as $productId)
            {
                if(intval($productId) > 0)
                {
                    $cartproducts[] = $productInstance->getProductById(intval($productId));
                }

            }
        //var_dump($cartproducts); exit;
        $userInstance = new User();
        $user = $userInstance->getUser();
        //set the data array to username variable and extract
        $this->data['username'] = $user['username'];
        
        //get the balance of particular user in session
        $newBalance = ($userInstance->getUserById(intval($_SESSION['user']['id'])))->getBalance();
        // var_dump($newBalance); exit;
        //set data array to balance variable
        $this->data['balance'] = $newBalance;
 
        $this->data['cartproducts'] = $cartproducts;
        $this->view = 'cart';

    }
}