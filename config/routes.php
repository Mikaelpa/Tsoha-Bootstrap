<?php

$routes->get('/', function() {
    ElokuvaController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/arvostelu', function() {
    ArvosteluController::all();
});

$routes->get('/elokuvamuokkaus', function() {
    ElokuvaController::check_logged_in();
    ElokuvaController::elokuvamuokkaus();
});

$routes->post('/', function() {
    ElokuvaController::check_logged_in();
    ElokuvaController::store();
});

$routes->get('/elokuva/:id', function($id){
    ElokuvaController::elokuva($id);
});

$routes->get('/arvostelu/:id', function($id){
    ArvosteluController::arvostelu($id);
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

$routes->get('/elokuva/:id/arvostelu', function($id){
    ArvosteluController::muokkaus($id);
});

$routes->post('/elokuva/:id/arvostelu', function($id){
    ArvosteluController::store($id);
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




