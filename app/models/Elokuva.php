<?php

class Elokuva extends BaseModel {

    public $id, $näyttelijä_id, $ohjaaja_id, $tyyli_id, $nimi, $kuvaus, $julkaisuvuosi;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Elokuva');
        $query->execute();
        $rows = $query->fetchAll();
        $elokuvat = array();

        foreach ($rows as $row) {
            $elokuvat[] = new Elokuva(array(
                'id' => $row['id'],
                'näyttelijä_id' => $row['näyttelijä_id'],
                'kuvaus' => $row['kuvaus'],
                'ohjaaja_id' => $row['ohjaaja_id'],
                'tyyli_id' => $row['tyyli_id'],
                'nimi' => $row['nimi'],
                'julkaisuvuosi' => $row['julkaisuvuosi']
            ));
        }

        return $elokuvat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Elokuva WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $elokuva = new Elokuva(array(
                'id' => $row['id'],
                'näyttelijä_id' => $row['näyttelijä_id'],
                'kuvaus' => $row['kuvaus'],
                'ohjaaja_id' => $row['ohjaaja_id'],
                'tyyli_id' => $row['tyyli_id'],
                'nimi' => $row['nimi'],
                'julkaisuvuosi' => $row['julkaisuvuosi']
            ));

            return $elokuva;
        }

        return null;
    }

}
