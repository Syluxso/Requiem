# Requiem

## INSTALL
```
composer require syluxso/requiem
```

### GOAL
- Make api calls that are simple to read and write.
- Simple implementation of defaults for setting headers, auth, etc.
- Access the response $status, $message, $data, $errors with ease.
- Permit for a platform specific drivers to be pre-configured for each api endpoint.

### CLASSES
- Requiem: Example class to extend RequiemAPi
- RequiemApi: The main class drive them all.
- RequiemGuzzle: The class that consumes RequiemApi set up, implements Guzzle call, and returns the call through the RequiemResponse class.
- RequiemResponse: Takes the data from a $guzzle->getResponse() and processes it.
- Utils: Helper functions.


### REQUIREMENTS
- Requires Guzzle
- PHP 8.x

### EXAMPLE: Make calls
```php
// The most simple call
$r = new Requiem('https://api.test.com/get');
$r->call();

var_dump(
  $r->status(),  // 200
  $r->message(), // OK
  $r->data(),    // array|object of data response.
  $r->errors()  // null (unless there are errors.
);
```

```php
// Add query params
$r = new Requiem('https://api.test.com/get');
$r->add_query('foo', 'bar'); // adds ?foo=bar to the request url string.
$r->call();
```

```php
// Add headers
$r = new Requiem('https://api.test.com/get');
$r->add_header('Content-Type', 'application/json'); // Adds header.
$r->call();
```

```php
// Change the request method
$r = new Requiem('https://api.test.com/get');
$r->method('post');
$r->call();
```

```php
// Add body content
$r = new Requiem('https://api.test.com/get');
$r->add_body($array); // Array/Objects converted to json body.
$r->call();
```

```php
// A few helpers
$r = new Requiem('https://api.test.com/get');
$r->basic_auth($user, $pass); // Simple basic auth.
$r->bearer_auth($token);
$r->use_json(); // This is added by default and adds the Content Type to the header.
$r->call();
```

```php
// User $root and $routes
$r = new Requiem('/resource/endpoint');
$r->roote('https://api.test.com');
$r->call();
```

### EXAMPLE: Access the response & errors.
```php
$r = new Requiem('https://api.test.com/get');
$r->call();
$status_code = $r->status(); // '200'
$status_message = $r->message(); // 'OK'
$response_data = $r->data(); // Array or Object body of the api response.
$errors = $r->errors(); // $error code(s)
```

### EXAMPLE: Extend with defaults
```php

class CustomPostRequiem {
  function __construct($route) {
    $this->root('https://api.myendpoing.com');
    $this->route($route);
    $this->method('post');
    $this->basic_auth(env('USER_ID', env('USER_PASS')));
    $this->add_query('api_token', env('API_TOKEN'));
  }
}

$r = new CustomPostRequiem('/my-route');
$r->call();

class CustomGetRequiem {
  function __construct($route) {
    $this->root('https://api.myendpoing.com');
    $this->route($route);
    $this->method('get');
    $this->basic_auth(env('USER_ID', env('USER_PASS')));
    $this->add_query('api_token', env('API_TOKEN'));
  }
}

$r = new CustomGetRequiem('/my-route');
$r->call();
```
