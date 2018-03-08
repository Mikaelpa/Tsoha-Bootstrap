<?php

class Elokuva extends BaseModel {

    public $id, $tyyli_id, $nimi, $kuvaus;

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
        if ($this->kuvaus == '' || $this->kuvaus == null) {
            $errors[] = 'Kuvaus ei saa olla tyhjä';
        }
        if (strlen($this->kuvaus) < 10) {
            $errors[] = 'Kuvauksen pitää olla vähintään 10 merkkiä!';
        }
        if ($this->tyyli_id == null || $this->tyyli_id == '') {
            $errors[] = 'Valitse aihe/tyyli';
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
                'tyyli_id' => $row['tyyli_id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
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
                'tyyli_id' => $row['tyyli_id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));

            return $elokuva;
        }

        return null;
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Elokuva SET tyyli_id = :tyyli_id, nimi = :nimi, kuvaus = :kuvaus WHERE id = :id');
        $query->execute(array(
            'nimi' => $this->nimi,
            'tyyli_id' => $this->tyyli_id,
            'kuvaus' => $this->kuvaus,
            'id' => $this->id
        ));
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Elokuva (nimi, kuvaus, tyyli_id) VALUES (:nimi, :kuvaus, :tyyli_id) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'tyyli_id' => $this->tyyli_id));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare(
                'DELETE FROM Elokuva WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }

}
