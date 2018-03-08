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
        $arvostelut = Arvostelu::find_by_elokuva($id);

        View::make('/suunnitelmat/elokuva.html', array('elokuva' => $elokuva, 'arvostelut' => $arvostelut));
    }

    public static function muokkaus($id) {

        $elokuva = Elokuva::find($id);
        View::make('/suunnitelmat/elokuvamuokkaus.html', array('muokkaus' => $elokuva));
    }

    public static function store() {

        $params = $_POST;
        $elokuva = new Elokuva(array(
            'tyyli_id' => $params['tyyli_id'],
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus']
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
        $arvostelut = Arvostelu::find_by_elokuva($id);
        if ($arvostelut != null) {
            foreach ($arvostelut as $arvostelu) {
                $arvostelu->destroy();
            }
        }
        $elokuva->destroy();
        Redirect::to('/');
    }

    public static function store_destroy($id) {

        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'tyyli_id' => $params['tyyli_id']
        );
        $elokuva = new Elokuva($attributes);
        $errors = $elokuva->validate_name();
        if (count($errors) > 0) {
            View::make('/suunnitelmat/elokuvamuokkaus.html', array('errors' => $errors, 'muokkaus' => $elokuva));
        } else {
            $elokuva->update();
            Redirect::to('/');
        }
        

        
    }

    public static function elokuvamuokkaus() {
        View::make('suunnitelmat/elokuvamuokkaus.html');
    }

}
