<?php



class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        $elokuvat = Elokuva::all();

        View::make('/suunnitelmat/etusivu.html', array('elokuvat' => $elokuvat));
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
     
        $elokuvat = Elokuva::all();
        
        Kint::dump($elokuvat);
 
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



}
