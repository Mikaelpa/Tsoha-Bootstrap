<?php

class ElokuvaController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        $elokuvat = Elokuva::all();

        View::make('/suunnitelmat/etusivu.html', array('elokuvat' => $elokuvat));
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['user'])) {
            Redirect::to('/login', array('error' => 'Kirjaudu ensin sisään!'));
        }
    }

    public static function elokuva($id) {

        $elokuva = Elokuva::find($id);

        View::make('/suunnitelmat/elokuva.html', array('elokuva' => $elokuva));
    }

    public static function muokkaus($id) {

        $elokuva = Elokuva::find($id);
        View::make('/suunnitelmat/elokuvamuokkaus.html', array('muokkaus' => $elokuva));
    }

    public static function store() {

        $params = $_POST;
        $elokuva = new Elokuva(array(
//            'näyttelijä_id' => $params['näyttelijä_id'],
//            'ohjaaja_id' => $params['ohjaaja_id'],
//            'tyyli_id' => $params['tyyli_id'],
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus']
//            'julkaisuvuosi' => $params['julkaisuvuosi']
        ));
        $errors = $elokuva->validate_name();
        if (count($errors) > 0) {
            View::make('/suunnitelmat/elokuvamuokkaus.html', array('errors' => $errors));
        } else {
            $elokuva->save();
        }

        Redirect::to('/');
    }

    public static function destroy($id) {
        $elokuva = new Elokuva(array('id' => $id));
        $elokuva->destroy();
        Redirect::to('/');
    }

    public static function store_destroy($id) {

        $params = $_POST;
        $elokuva = new Elokuva(array(
//            'näyttelijä_id' => $params['näyttelijä_id'],
//            'ohjaaja_id' => $params['ohjaaja_id'],
//            'tyyli_id' => $params['tyyli_id'],
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus']
//            'julkaisuvuosi' => $params['julkaisuvuosi']
        ));
        $errors = $elokuva->validate_name();
        if (count($errors) > 0) {
            View::make('/suunnitelmat/elokuvamuokkaus.html', array('errors' => $errors, 'muokkaus' => $elokuva));
        } else {
            $leffa = new Elokuva(array('id' => $id));
            $leffa->destroy();
            $elokuva->save();
        }

        Redirect::to('/');
    }

    public static function elokuvamuokkaus() {
        View::make('suunnitelmat/elokuvamuokkaus.html');
    }



}
