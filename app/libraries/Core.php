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

            // Look in controllers for first value
            if (file_exists('./app/controllers/' . ucwords($url[0]) . '.php')) {
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
            if ($this->existsController==true) {
              // Check for second part of url
              if (isset($url[1])) {
                  if(method_exists($this->currentController, $url[1]))
                  {
                      $this->currentMethod = $url[1];
                      unset($url[1]);
                      // Get params
                      $this->params = $url ? array_values($url) : [0];
                      //Call a callback with array of params
                      /*
                      if(md5($_SERVER["HTTP_HOST"])!=='5363fe3734b9534e8e6455ec33e0dc08'){ 
                        
                      }
                      */
                      call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
                  }else{
                    $this->existsMethod = false;
                  }
              }else{
                $this->existsMethod = false;
              }
            }
            // require error page is not found
            if($this->existsController && $this->existsMethod){
              
            }else{
              require_once "./app/views/template/header.php";
              require_once "./app/views/404.php";
              require_once "./app/views/template/footer.php";
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