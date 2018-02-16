<?php
class User extends BaseModel {
    public $id, $tunnus, $salasana;
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_tunnus', 'validoi_ss');
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();
        $rows = $query->fetchAll();
        $users = array();
        foreach ($rows as $row) {
            $users[] = new User(array('id' => $rivi['id'],
                'tunnus' => $row['tunnus'], 'salasana' => $row['salasana']));
        }
        return $users;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id'=>$id));
        $row = $query->fetch();
        if($row) {
            $kayttaja = new User(array('id' => $row['id'],
                'tunnus' => $row['tunnus'], 'salasana' => $row['salasana']));
            return $user;
        }
        return null;
    }
    
    public static function find_tunnus($tunnus) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $tunnus));
        $row = $query->fectch();
        if ($row) {
            $user = new Kayttaja(array('id' => $row['id'],
                'tunnus' => $row['tunnus'], 'salasana' => $row['salasana']));
            return $user;
        }
        return null;
    }
    
    public static function validate($tunnus, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array('id' => $row['id'], 'tunnus' => $row['tunnus'], 'salasana' => $row['salasana']));
            return $user;
        }
        return null;
    }
}