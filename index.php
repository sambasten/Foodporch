<?php
//autoloader for classes 
// function autoloadFunction($class)
// {
//     // Ends with a string "Controller"?
//     if (preg_match('/Controller$/', $class))
//         require("App" . DS . "Controller" . DS . $class . ".php");
//     else
//       require("App" . DS . "Model" . DS .$class . ".php");
// }
// spl_autoload_register("autoloadFunction");

// //autoloader for classes 
function autoloadFunction($class)
{
    // Ends with a string "Controller"?
    if (preg_match('/Controller$/', $class))
        require(ROOT . DS ."app/Controller/" . $class . ".php");
    else
      require(ROOT . DS ."app/Model/" .$class . ".php");
}
spl_autoload_register("autoloadFunction");

// function autoloadFunction($class)
// {
//       require( $class . ".php");
// }
// spl_autoload_register("autoloadFunction");

// use App\Model\Database;
// use App\Controller\RouterController;
// //use Controller;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once(ROOT . DS . 'config' . DS . 'config.php');
mb_internal_encoding("UTF-8");
session_start();

// echo "This is the index page";
// echo "<br/>";
// Connects to the database
Database::connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$router = new RouterController();
$params = array($_SERVER['REQUEST_URI']);
$router->process($params);
$router->renderView();

//  $userInstance  = new User();
//  var_dump($userInstance->getUser()); exit;
// var_dump($userInstance->getUserByUsernameANDPassword('chukkldsvlvks', '1234')); exit;

// $productInstance = new Product();
// var_dump($productInstance->getProductIdById(2)); exit;