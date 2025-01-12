<?php

namespace Syluxso\Requiem;

use Syluxso\Requiem\RequiemGuzzle;

class RequiemApi {
  
  public $root = '';
  public $route = '';
  public $query = [];
  public $headers = [];
  public $method = 'get';
  public $body = '';
  public $drivers = [
    'request' => false,
    'response' => false,
    'error' => false,
  ];
  
  public $response;
  
  
  function __construct($route = '') {
    $this->use_json();
    $this->route($route);
  }
  
  /*
   * SETTERS
   */
  
  public function root($root = '') {
    $this->root = $root;
  }
  
  public function route($route = '') {
    $this->route = $route;
  }
  
  public function add_header($key, $value) {
    $headers = $this->headers;
    $headers[$key] = $value;
    $this->headers = $headers;
  }
  
  public function add_query($key, $value) {
    $query = $this->query;
    $query[$key] = $value;
    $this->query = $query;
  }
  
  public function method($method) {
    $this->method = (string) strtoupper($method);
  }
  
  public function add_body($array) {
    if(!empty($array)) {
      $this->body = $array;
    }
  }
  
  public function add_driver($key, $name) {
    $drivers = $this->drivers;
    $drivers[$key] = $name;
    $this->drivers = $drivers;
  }
  
  /*
   * GETTERS
   * Access properties of $this with basic to no processing of the value.
   */
  public function get_root() {
    return $this->root;
  }
  
  public function get_route() {
    return $this->route;
  }
  
  public function get_query() {
    return $this->query;
  }
  
  public function get_headers() {
    return $this->headers;
  }
  
  public function get_method() {
    return $this->method;
  }

  public function get_body() {
    return $this->body;
  }
  
  public function get_driver($name = false) {
    if(key_exists($name, $this->drivers)) {
      return $this->drivers[$name];
    } else {
      return false;
    }
  }
  
  /*
   * BUILDERS
   * Processes properties of $this.
   * function build_* may only RETURN data and not set properties of $this.
   */
  
  public function build_url() {
    // Query parameters are ignored here as Guzzle has you pass them in as an array.
    $root = '';
    $route = '';
    if(is_string($this->root)) {
      $root = $this->root;
    }
    if(is_string($this->route)) {
      $route = $this->route;
    }
    return $root . $route;
  }
  
  /*
   * ACTIONS
   */
  public function call() {
    $this->response = new RequiemGuzzle($this);
    
  }
  
  /*
   * Implement defaults
   */
  
  public function basic_auth($user, $pass) {
    $value = 'Basic ' . base64_encode($user . ':' . $pass);
    $this->add_header('Authorization', $value);
  }
  
  public function bearer_auth($token) {
    $value = 'Bearer  ' . $token;
    $this->add_header('Authorization', $value);
  }
  
  public function token_auth($key, $value) {
    $this->add_query($key, $value);
  }
  
  public function use_json() {
    $this->add_header('Content-Type', 'application/json');
  }
  
  
  /*
   * Response collection methods.
   */
  
  public function response() {
    $object = false;
    if(!empty($this->response)) {
      $object = $this->response->response;
    }
    return $object;
  }
  
  public function status() {
    $value = false;
    if(!empty($this->response)) {
      $value = $this->response->response->status;
    }
    return $value;
  }
  
  public function message() {
    $value = false;
    if(!empty($this->response)) {
      $value = $this->response->response->message;
    }
    return $value;
  }
  
  public function data() {
    $value = false;
    if(!empty($this->response)) {
      $value = $this->response->response->data;
    }
    return $value;
  }
  
  public function errors() {
    $value = false;
    if(!empty($this->response)) {
      $value = $this->response->response->errors;
    }
    return $value;
  }
}
