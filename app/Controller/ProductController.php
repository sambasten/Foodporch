<?php
// namespace App\Controller;
// //use Controller;
// use App\Model\User;
// use App\Model\Product;

class ProductController extends Controller
{
    public function process($params): void
    {
        // Only registered users can access the product page
        $this->authUser();

        //logging off the user
        $userInstance= new User();
        if (!empty($params[0]) && $params[0] == 'logoff')
        {
            $userInstance->logoffUser();
            $this->redirect('login');
        }
        
        $user = $userInstance->getUser();
        //set the data array to username variable and extract
        $this->data['username'] = $user['username'];

        //create a model instance of product model
        $productInstance =  new Product();

        //get all product list if no URL was entered
        $products = $productInstance->getProducts();
        //var_dump($products); exit;
        
        /*set the data array to products template. 
        * it will be extracted by extract method in renderView method
        */
        $this->data['products'] = $products; 
        //set the view product page
        $this->view = 'product';
        
        //get the balance of particular user in session
        $newBalance = ($userInstance->getUserById(intval($_SESSION['user']['id'])))->getBalance();
        // var_dump($newBalance); exit;
        //set data array to balance variable
        $this->data['balance'] = $newBalance;

    }
}
