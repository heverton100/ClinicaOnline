<?php

require_once __DIR__ . '/RouteSwitch.php';

class Router extends RouteSwitch
{
    public function run(string $requestUri)
    {
        $route = substr($requestUri, 1);

        if (substr_count($route,"?") > 0) {
            $routetemp = explode("?",$route);
            $routetemp = explode("/",$routetemp[0]);
        }else{
            $routetemp = explode("/",$route);
        }

        $final = end($routetemp);

        if ($final === '') {
            $this->home();
        } else {
            $this->$final();
        }
    }
}