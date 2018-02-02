<?php

require 'app/models/Elokuva.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        $elokuvat = Elokuva::all();

        View::make('suunnitelmat/etusivu.html', array('elokuvat' => $elokuvat));
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('/helloworld.html');
    }

    public static function elokuva() {
        View::make('suunnitelmat/elokuva.html');
    }

    public static function elokuvamuokkaus() {
        View::make('suunnitelmat/elokuvamuokkaus.html');
    }

    public static function arvostelu() {
        View::make('suunnitelmat/arvostelu.html');
    }

    public static function store() {

        $params = $_POST;

        $elokuva = new Elokuva(array(
            'näyttelijä_id' => $params['näyttelijä_id'],
            'ohjaaja_id' => $params['ohjaaja_id'],
            'tyyli_id' => $params['tyyli_id'],
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'julkaisuvuosi' => $params['julkaisuvuosi']
        ));

        $elokuva->save();

        Redirect::to('/');
    }

}
