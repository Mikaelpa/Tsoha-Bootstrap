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
    ElokuvaController::check_logged_in();
    ElokuvaController::elokuvamuokkaus();
});

$routes->post('/', function() {
    ElokuvaController::store();
});

$routes->get('/elokuva/:id', function($id){
    ElokuvaController::elokuva($id);
});

$routes->post('/elokuva/:id/destroy', function($id){
    ElokuvaController::check_logged_in();
  ElokuvaController::destroy($id);
});

$routes->get('/elokuva/:id/muokkaus', function($id){
    ElokuvaController::check_logged_in();
    ElokuvaController::muokkaus($id);
});

$routes->post('/elokuva/:id/muokkaus', function($id){
    ElokuvaController::check_logged_in();
    ElokuvaController::store_destroy($id);
});

$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::kirjaudu();
});

$routes->post('/logout', function(){
  ElokuvaController::check_logged_in();
  UserController::logout();
});




