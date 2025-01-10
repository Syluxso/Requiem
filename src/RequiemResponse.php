<?php

namespace Syluxso\Requiem;

class RequiemResponse {
  public $status;
  public $message;
  public $data;
  public $errors;
  
  function __construct($status = false, $message = false, $data = false, $errors = false) {
    $this->set_status($status);
    $this->set_message($message);
    $this->set_data($data);
    $this->set_errors($errors);
  }
  
  private function set_status($status) {
    $this->status = (int) $status;
  }
  
  private function set_message($message) {
    $this->message = $message;
  }
  
  private function set_data($data) {
    $this->data = $data;
  }
  
  private function set_errors($errors) {
    $this->errors = $errors;
  }
}
