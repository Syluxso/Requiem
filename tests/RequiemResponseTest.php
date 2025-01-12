<?php

namespace Syluxso\Requiem\Tests;

use PHPUnit\Framework\TestCase;
use Syluxso\Requiem\RequiemResponse;

class RequiemResponseTest extends TestCase
{
  /**
   * Test the constructor initializes all properties correctly.
   */
  public function testConstructorInitializesProperties()
  {
    $response = new RequiemResponse(200, 'Success', ['key' => 'value'], ['error' => 'None']);
    
    $this->assertEquals(200, $response->status);
    $this->assertEquals('Success', $response->message);
    $this->assertEquals(['key' => 'value'], $response->data);
    $this->assertEquals(['error' => 'None'], $response->errors);
  }
  
  /**
   * Test that the default constructor initializes properties to false.
   */
  public function testDefaultConstructor()
  {
    $response = new RequiemResponse();
    
    $this->assertEquals(0, $response->status); // Default status as an integer.
    $this->assertFalse($response->message);
    $this->assertFalse($response->data);
    $this->assertFalse($response->errors);
  }
  
  /**
   * Test set_status sets the status property correctly.
   */
  public function testSetStatus()
  {
    $response = new RequiemResponse();
    
    $reflection = new \ReflectionClass($response);
    $method = $reflection->getMethod('set_status');
    $method->setAccessible(true);
    
    $method->invoke($response, 201);
    $this->assertEquals(201, $response->status);
    
    $method->invoke($response, '404'); // Test coercion to integer.
    $this->assertEquals(404, $response->status);
  }
  
  /**
   * Test set_message sets the message property correctly.
   */
  public function testSetMessage()
  {
    $response = new RequiemResponse();
    
    $reflection = new \ReflectionClass($response);
    $method = $reflection->getMethod('set_message');
    $method->setAccessible(true);
    
    $method->invoke($response, 'New Message');
    $this->assertEquals('New Message', $response->message);
  }
  
  /**
   * Test set_data sets the data property correctly.
   */
  public function testSetData()
  {
    $response = new RequiemResponse();
    
    $reflection = new \ReflectionClass($response);
    $method = $reflection->getMethod('set_data');
    $method->setAccessible(true);
    
    $data = ['key' => 'value'];
    $method->invoke($response, $data);
    $this->assertEquals($data, $response->data);
  }
  
  /**
   * Test set_errors sets the errors property correctly.
   */
  public function testSetErrors()
  {
    $response = new RequiemResponse();
    
    $reflection = new \ReflectionClass($response);
    $method = $reflection->getMethod('set_errors');
    $method->setAccessible(true);
    
    $errors = ['error' => 'An error occurred'];
    $method->invoke($response, $errors);
    $this->assertEquals($errors, $response->errors);
  }
}
