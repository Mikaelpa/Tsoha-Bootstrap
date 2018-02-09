<?php

class ElokuvaController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        $elokuvat = Elokuva::all();

        View::make('/suunnitelmat/etusivu.html', array('elokuvat' => $elokuvat));
    }

    public static function elokuva($id) {

        $elokuva = Elokuva::find($id);

        View::make('/suunnitelmat/elokuva.html', array('elokuva' => $elokuva));
    }

    public static function store() {

        $params = $_POST;
        $elokuva = new Elokuva(array(
//            'näyttelijä_id' => $params['näyttelijä_id'],
//            'ohjaaja_id' => $params['ohjaaja_id'],
//            'tyyli_id' => $params['tyyli_id'],
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
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
    
  

}
