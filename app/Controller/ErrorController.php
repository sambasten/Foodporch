<?php
// namespace App\Controller;
// //use Controller;

class ErrorController extends Controller
{
    public function process($params): void
    {
        // HTTP header
        header("HTTP/1.0 404 Not Found");
        // HTML header
        $this->head['title'] = 'Error 404';
        // Sets the template
        $this->view = 'error';
    }
}