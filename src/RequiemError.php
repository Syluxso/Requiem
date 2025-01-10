<?php

namespace Syluxso\Requiem\RequiemError;


class RequiemError {
  public $code;
  public $message;
  public $error;
  
  function __construct($error) {
    $this->error = $error;
    $this->set_code();
    $this->set_message();
  }
  
  private function set_code() {
    if(!empty($this->error)) {
      // Try to set code
    }
  }
  
  private function set_message() {
    if(!empty($this->error)) {
      // Try to set message
    }
  }
}
