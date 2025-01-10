<?php


require_once __DIR__ . '/../vendor/autoload.php';

use Syluxso\Requiem\Requiem;


/*
 * GET request without presets.
 */
$r = new Requiem('https://jsonplaceholder.typicode.com/todos/1');
$r->call();

dd(
  $r->status(),
  $r->message(),
  $r->data(),
  $r->errors()
);
