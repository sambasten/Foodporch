<?php
// namespace App\Controller;
// //use Controller;
// use App\Model\Product;
// use App\Model\Cart;

class AjaxController extends Controller
{

    function __construct()
    {
        header("content-type: application/json");
    }

   public function process($params): void
   {
        //create a model instance of product model
        $productInstance =  new Product();
        
        $productId = $productInstance->getId();
        if ($params[0]== "add" && is_numeric($params[1]))
        {
            $productId = intval($params[1]);
             //check existence in db
            if($productId == $productInstance->getProductIdById($productId))
            {
               $existsInDb = true;
            }
            if($existsInDb)
            {
                $productsIdString = $_SESSION['cart'];
                $productsIdArray = Cart::toArray($productsIdString);
                $cart = new Cart($productId, $productsIdArray);
                $productIdString = $_SESSION['cart'] = $cart->add();
                $productIdString = trim($productIdString, "\,");
                $productIds = explode(",", $productIdString);
            }             
        }

        elseif ($params[0] == "remove" && is_numeric($params[1]))
        {
            $productId = intval($params[1]);
            $productsIdString = $_SESSION['cart'];
            $productsIdArray = Cart::toArray($productsIdString);
            $cart = new Cart($productId, $productsIdArray);
            $productIdString = $_SESSION['cart'] = $cart->remove();
            $productIdString = trim($productIdString, "\,");
            $productIds = explode(",", $productIdString);
            //$this->redirect('cart');
        }
        
        if(isset($productIds) && count($productIds) > 0)
        {
            $message = "Successfully added/removed to cart";
            $status = 1;
         }else
         {
             $error = "Could not add product to cart";
             $status = -1;
         }          
         $response = array(
             'status' => $status
         );
         if($status == 1)
         {
            $response['data'] = $productIds;
            $response['message'] = $message;
         }else
         {
            $response['error'] = $error;
         }

         echo json_encode($response, JSON_NUMERIC_CHECK );
         exit;   
    }

}

