<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
    $routes->get('/arvostelu', function() {
    HelloWorldController::arvostelu();
  });
  
    $routes->get('/elokuvamuokkaus', function() {
    HelloWorldController::elokuvamuokkaus();
  });
  
    $routes->get('/elokuva', function() {
    HelloWorldController::elokuva();
  });
