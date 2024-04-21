<?php
    /*
    * App Core Class
    * Create URL & load core controller
    * URL FORMAT - /controller/method/params
    */

    class Core
    {
        protected $currentController = 'Pages';
        protected $currentMethod = 'Index';
        protected $params = [];
        protected $existsController = true;
        protected $existsMethod = true;

        public function __construct()
        {
            $url = $this->getUrl();
            echo implode('/', $_GET);
        }
        
        public static function Router($link,$class,$method){
            if ($link == implode('/', $_GET)) {
              
            }
            if (file_exists('./app/controllers/' . $class . '.php')) {
                // If exists, set as controller
                $this->currentController = ucwords( $url[0] );
                // Unset 0 url
                unset($url[0]);
                // Require the controller
                require_once './app/controllers/' . $this->currentController . '.php';
                // Instantiate controller class
                $this->currentController =  new $this->currentController;
            }else{
                $this->existsController = false;
            }
        }
        
        public function  getUrl(){
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
        }
    }