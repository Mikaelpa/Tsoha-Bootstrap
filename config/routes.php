<?php

$routes->get('/', function() {
    ElokuvaController::index();
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

$routes->post('/', function() {
    ElokuvaController::store();
});

$routes->get('/elokuva/:id', function($id){
    ElokuvaController::elokuva($id);
});

$routes->post('/elokuva/:id/destroy', function($id){
  ElokuvaController::destroy($id);
});


