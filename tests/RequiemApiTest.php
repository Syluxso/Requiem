<?php

use PHPUnit\Framework\TestCase;
use Syluxso\Requiem\RequiemApi;
use Syluxso\Requiem\RequiemGuzzle;

class RequiemApiTest extends TestCase
{
  /**
   * Test the constructor sets default headers and route.
   */
  public function testConstructorSetsDefaults()
  {
    $api = new RequiemApi('test-route');
    $this->assertEquals('test-route', $api->get_route());
    $this->assertEquals(['Content-Type' => 'application/json'], $api->get_headers());
  }
  
  /**
   * Test the root setter and getter.
   */
  public function testRootSetterGetter()
  {
    $api = new RequiemApi();
    $api->root('https://api.example.com');
    $this->assertEquals('https://api.example.com', $api->get_root());
  }
  
  /**
   * Test adding headers.
   */
  public function testAddHeader()
  {
    $api = new RequiemApi();
    $api->add_header('Authorization', 'Bearer token123');
    $this->assertArrayHasKey('Authorization', $api->get_headers());
    $this->assertEquals('Bearer token123', $api->get_headers()['Authorization']);
  }
  
  /**
   * Test adding query parameters.
   */
  public function testAddQuery()
  {
    $api = new RequiemApi();
    $api->add_query('key', 'value');
    $this->assertArrayHasKey('key', $api->get_query());
    $this->assertEquals('value', $api->get_query()['key']);
  }
  
  /**
   * Test setting and getting the HTTP method.
   */
  public function testMethodSetterGetter()
  {
    $api = new RequiemApi();
    $api->method('post');
    $this->assertEquals('POST', $api->get_method());
  }
  
  /**
   * Test the build_url method.
   */
  public function testBuildUrl()
  {
    $api = new RequiemApi();
    $api->root('https://api.example.com');
    $api->route('/users');
    $this->assertEquals('https://api.example.com/users', $api->build_url());
  }
  
  /**
   * Test basic authentication header.
   */
  public function testBasicAuth()
  {
    $api = new RequiemApi();
    $api->basic_auth('user', 'password');
    $expectedValue = 'Basic ' . base64_encode('user:password');
    $this->assertEquals($expectedValue, $api->get_headers()['Authorization']);
  }
  
  /**
   * Test bearer authentication header.
   */
  public function testBearerAuth()
  {
    $api = new RequiemApi();
    $api->bearer_auth('token123');
    $this->assertEquals('Bearer  token123', $api->get_headers()['Authorization']);
  }
  
  /**
   * Test adding body content.
   */
  public function testAddBody()
  {
    $api = new RequiemApi();
    $api->add_body(['key' => 'value']);
    $this->assertEquals(['key' => 'value'], $api->get_body());
  }
  
  /**
   * Test adding drivers.
   */
  public function testAddDriver()
  {
    $api = new RequiemApi();
    $api->add_driver('request', 'CustomDriver');
    $this->assertEquals('CustomDriver', $api->get_driver('request'));
  }
  
  /**
   * Test default response collection methods.
   */
  public function testResponseMethods()
  {
    $mockResponse = (object) [
      'status' => 200,
      'message' => 'Success',
      'data' => ['key' => 'value'],
      'errors' => null,
    ];
    
    $mockGuzzle = $this->createMock(RequiemGuzzle::class);
    $mockGuzzle->response = $mockResponse;
    
    $api = new RequiemApi();
    $api->response = $mockGuzzle;
    
    $this->assertEquals(200, $api->status());
    $this->assertEquals('Success', $api->message());
    $this->assertEquals(['key' => 'value'], $api->data());
    $this->assertNull($api->errors());
  }
}
