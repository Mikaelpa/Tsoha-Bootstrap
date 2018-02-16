<?php

class UserController extends BaseController {

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function kirjaudu() {
        $param = $_POST;
        $user = User::validate($param['tunnus'], $param['salasana']);
        if (!$user) {
            View::make('suunnitelmat/login.html', array('error' => 'Tunnus tai salasana väärin!', 'tunnus' => $param['tunnus']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('/elokuvamuokkaus');
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('error' => 'Olet kirjautunut ulos!'));
    }

}
