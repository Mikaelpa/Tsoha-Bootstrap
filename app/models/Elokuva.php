<?php

class Elokuva extends BaseModel {

//    public $id, $näyttelijä_id, $ohjaaja_id, $tyyli_id, $nimi, $kuvaus, $julkaisuvuosi;
    public $id, $nimi, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function validate_name() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
        }

        return $errors;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Elokuva');
        $query->execute();
        $rows = $query->fetchAll();
        $elokuvat = array();

        foreach ($rows as $row) {
            $elokuvat[] = new Elokuva(array(
                'id' => $row['id'],
//                'näyttelijä_id' => $row['näyttelijä_id'],
                'nimi' => $row['nimi'],
//                'ohjaaja_id' => $row['ohjaaja_id'],
//                'tyyli_id' => $row['tyyli_id'],
                'kuvaus' => $row['kuvaus']
//                'julkaisuvuosi' => $row['julkaisuvuosi']
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
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
//                'ohjaaja_id' => $row['ohjaaja_id'],
//                'tyyli_id' => $row['tyyli_id'],
//                'näyttelijä_id' => $row['näyttelijä_id'],
//                'julkaisuvuosi' => $row['julkaisuvuosi']
            ));

            return $elokuva;
        }

        return null;
    }

    public function save() {

//        $querry = DB::connection()->prepare('INSERT INTO Elokuva (näyttelijä_id, ohjaaja_id, tyyli_id, nimi, kuvaus, julkaisuvuosi) VALUES (:näyttelijä_id, :ohjaaja_id, :tyyli_id, :nimi, :kuvaus, :julkaisuvuosi) RETURNING id');
        $querry = DB::connection()->prepare('INSERT INTO Elokuva (nimi, kuvaus) VALUES (:nimi, :kuvaus) RETURNING id');

//        $querry->execute(array('näyttelijä_id' => $this->näyttelijä_id, 'ohjaaja_id' => $this->ohjaaja_id, 'tyyli_id' => $this->tyyli_id, 'nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'julkaisuvuosi' => $this->julkaisuvuosi));
        $querry->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus));

        $row = $querry->fetch();

        $this->id = $row['id'];
    }
    
    public function destroy(){
        $query = DB::connection()->prepare(
                'DELETE FROM Elokuva WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }

}
