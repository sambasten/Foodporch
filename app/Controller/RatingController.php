<?php
// namespace App\Controller;
// //use Controller;
// use App\Model\Product;
// use App\Model\User;

class RatingController extends Controller
{
    public function process($params): void
    {
        if ($params[0] == "rate" && isset($_POST['product']))
        {
        //for instantiatitng rating and adding rate
        $userId = intval($_SESSION['user']['id']);
        $rate = intval($_POST['rate']);
        $productId = intval($_POST['product']);
        $rating = new Rating(null, $productId, $userId, $rate);
        $rating->add();
        $this->redirect('product');
        }
    }   
}