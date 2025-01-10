<?php

class CustomPostRequiem {
  function __construct($route) {
    $this->root('https://api.myendpoing.com');
    $this->route($route);
    $this->method('post');
    $this->basic_auth(env('USER_ID', env('USER_PASS')));
    $this->add_query('api_token', env('API_TOKEN'));
  }
}

class CustomGetRequiem {
  function __construct($route) {
    $this->root('https://api.myendpoing.com');
    $this->route($route);
    $this->method('get');
    $this->basic_auth(env('USER_ID', env('USER_PASS')));
    $this->add_query('api_token', env('API_TOKEN'));
  }
}
