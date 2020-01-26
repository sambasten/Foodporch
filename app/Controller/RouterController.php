<?php
/*
* This class recieves a Url from the user, processes it
*and calls the nested controller in thr url. 
*/

// namespace App\Controller;
// //use Controller;



class RouterController extends Controller
{
    public $controller; //instance of nested controller stored in controller variable

    //main controller function to process url array from parsedUrl function
    public function process($params): void
    {
        $params= array($_SERVER['REQUEST_URI']);
        $parsedUrl = $this->parseUrl($params[0]);
        $controllerPrefix = trim($this->dashesToCamel(array_shift($parsedUrl)));
        $controllerPrefix = $controllerPrefix == "a" ? "Login":$controllerPrefix;
        
        $controllerClass = $controllerPrefix . 'Controller';

        if (file_exists('app/Controller/' . $controllerClass . '.php'))
        {
            $this->controller = new $controllerClass;
            //eval("\$this->controller = new ".$controllerClass."();");
            //var_dump($this->controller); exit;
        }else
        $this->redirect('error');
        // The controller is the 1st URL parameter
        $this->controller->process($parsedUrl);
        $this->data['title'] = $this->controller->head['title'];
        $this->data['description'] = $this->controller->head['description'];
        // Sets the main template
        $this->view = 'layout';
    }
    
    //this method parses the url string given to return array of url params  
    private function parseUrl($url): array
    {
        $parsedUrl = parse_url($url);
        $parsedUrl["path"] = ltrim($parsedUrl["path"], "/");
        $parsedUrl["path"] = trim($parsedUrl["path"]);
        $explodedUrl = explode("/", $parsedUrl["path"]);
        return $explodedUrl;
        
    }
    //this function converts the classname of nexted controller to camel case
    private function dashesToCamel($text): string
    {
        $text = str_replace('-', ' ', $text);
        $text = ucwords($text);
        $text = str_replace(' ', '', $text);
        return $text;
    }
}