<?php

namespace Syluxso\Requiem;

use GuzzleHttp\Client;
use Syluxso\Requiem\RequiemResponse;

/*
 * Wrapper for the Guzzle. Make Guzzle easy to set up and difficult to do wrong.
 */
class RequiemGuzzle {
  
  private $url;
  private $array;
  
  public $status;
  public $message;
  public $data;
  public $error;
  
  public $response;
  
  function __construct(RequiemApi $requiemApi) {
    $this->guzzle($requiemApi);
  }
  
  private function guzzle($requiemApi) {
    $client = new Client();
  
    // The url to call
    $url = '';
    
    // Build out the wrapper for guzzle. "I like warm hubs!" - Olof.
    $array = [];

    if(!empty($requiemApi->build_url())) {
      $url = $requiemApi->build_url();
    }
  
    $headers = $requiemApi->get_headers();
    if(is_array($headers)) {
      $array['headers'] = $headers;
    }
  
    $body = $requiemApi->get_body();
    if(is_array($body)) {
      $array['json'] = $body;
    }
  
    $query = $requiemApi->get_query();
    if(is_array($query)) {
      $array['query'] = $query;
    }
  
    $method = $requiemApi->get_method();
    $this->url = $url;
    $this->array = $array;
  
    try {
      $response = $client->$method($this->url, $this->array);
      $this->set_status($response);
      $this->set_message($response);
      $this->set_data($response);
      $this->set_response($response);
    } catch (\GuzzleHttp\Exception\RequestException $e) {
      if ($e->hasResponse()) {
        $response = $e->getResponse();
        $this->set_error($response);
        $this->set_status($response);
        $this->set_message($response);
        $this->set_response();
      }
    }
  }
  
  private function set_status($response) {
    $this->status = $response->getStatusCode();
  }
  
  private function set_data($response) {
    $this->data = json_decode($response->getBody());
  }
  
  private function set_message($response) {
    $this->message = $response->getReasonPhrase();
  }
  
  private function set_error($response) {
    $this->error = json_decode($response->getBody()->getContents());
  }
  
  private function set_response() {
    $this->response = new RequiemResponse($this->status, $this->message, $this->data, $this->error);
  }
  
}
