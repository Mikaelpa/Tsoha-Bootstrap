<?php

class ArvosteluController extends BaseController {

    public static function all() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        $arvostelut = Arvostelu::all();

        View::make('/suunnitelmat/arvostelu.html', array('arvostelut' => $arvostelut));
    }

    public static function arvostelu($id) {

        $arvostelu = Arvostelu::find($id);
        $elokuva = Elokuva::find($arvostelu->elokuva_id);

        View::make('/suunnitelmat/arvostelu.html', array('arvostelu' => $arvostelu, 'elokuva' => $elokuva));
    }

    public static function muokkaus($id) {

        $elokuva = Elokuva::find($id);
        View::make('/suunnitelmat/arvostelumuokkaus.html', array('muokkaus' => $elokuva));
    }

    public static function store($id) {

        $params = $_POST;
        $arvostelu = new Arvostelu(array(
            'elokuva_id' => $id,
            'kirjoittaja' => $params['kirjoittaja'],
            'sisältö' => $params['sisältö'],
            'arvosana' => $params['arvosana']
        ));
        $errors = $arvostelu->validate_name();
        if (count($errors) > 0) {
            View::make('/suunnitelmat/arvostelumuokkaus.html', array('errors' => $errors));
        } else {
            $arvostelu->save();
        }


        Redirect::to('/');
    }

    public static function destroy($id) {
        $arvostelu = new Arvostelu(array('id' => $id));
        $arvostelu->destroy();
        Redirect::to('/');
    }

    public static function store_destroy($id) {

        $params = $_POST;
        $arvostelu = new Arvostelu(array(
            'elokuva_id' => $params['elokuva_id'],
            'kirjoittaja' => $params['kirjoittaja'],
            'sisältö' => $params['sisältö'],
            'arvosana' => $params['arvosana']
        ));
        $errors = $arvostelu->validate_name();
        if (count($errors) > 0) {
            View::make('/suunnitelmat/arvostelumuokkaus.html', array('errors' => $errors, 'muokkaus' => $elokuva));
        } else {
            $arv = new Arvostelu(array('id' => $id));
            $arv->destroy();
            $arvostelu->save();
        }

        View::make('/suunnitelmat/arvostelumuokkaus.html');
    }

    public static function arvostelumuokkaus() {
        View::make('suunnitelmat/arvostelumuokkaus.html');
    }

}
