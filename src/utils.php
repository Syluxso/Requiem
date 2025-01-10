<?php

use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('dump')) {
  function dump(...$vars)
  {
    foreach ($vars as $var) {
      VarDumper::dump($var);
    }
  }
}

// Define the dd (dump and die) function if it doesn't already exist
if (!function_exists('dd')) {
  function dumpk(...$vars)
  {
    dump(...$vars); // Use the dump function
    exit;           // Stop execution
  }
}
