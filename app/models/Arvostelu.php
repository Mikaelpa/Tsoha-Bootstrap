<?php

class Arvostelu extends BaseModel {

    public $id, $elokuva_id, $kirjoittaja, $sisältö, $arvosana;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function validate_name() {
        $errors = array();
        if ($this->sisältö == '' || $this->sisältö == null) {
            $errors[] = 'Sisältö ei saa olla tyhjä!';
        }
        if (strlen($this->sisältö) < 10) {
            $errors[] = 'Sisällön pituuden tulee olla vähintään kymmenen merkkiä!';
        }
        if ($this->kirjoittaja == '' || $this->kirjoittaja == null) {
            $errors[] = 'Arvostelulla pitää olla kirjoittaja';
        }

        if (strlen($this->kirjoittaja) < 3) {
            $errors[] = 'Kirjoittajan pitää olla vähintään kolme merkkiä pitkä';
        }

        return $errors;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Arvostelu');
        $query->execute();
        $rows = $query->fetchAll();
        $arvostelut = array();

        foreach ($rows as $row) {
            $arvostelut[] = new Arvostelu(array(
                'id' => $row['id'],
                'elokuva_id' => $row['elokuva_id'],
                'kirjoittaja' => $row['kirjoittaja'],
                'sisältö' => $row['sisältö'],
                'arvosana' => $row['arvosana']
            ));
        }

        return $arvostelut;
    }

    public static function find_by_elokuva($id) {
        $query = DB::connection()->prepare('SELECT * FROM Arvostelu WHERE elokuva_id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $arvostelut = array();

        if ($rows) {
            foreach ($rows as $row) {
                $arvostelut[] = new Arvostelu(array(
                    'id' => $row['id'],
                    'elokuva_id' => $row['elokuva_id'],
                    'kirjoittaja' => $row['kirjoittaja'],
                    'sisältö' => $row['sisältö'],
                    'arvosana' => $row['arvosana']
                ));
            }
            return $arvostelut;
        }

        return null;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Arvostelu WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $arvostelu = new Arvostelu(array(
                'id' => $row['id'],
                'elokuva_id' => $row['elokuva_id'],
                'kirjoittaja' => $row['kirjoittaja'],
                'sisältö' => $row['sisältö'],
                'arvosana' => $row['arvosana']
            ));

            return $arvostelu;
        }

        return null;
    }
        public function update() {
        $query = DB::connection()->prepare('UPDATE Arvostelu SET kirjoittaja = :kirjoittaja, sisältö = :sisalto, arvosana = :arvosana WHERE id = :id');
        $query->execute(array(
            'kirjoittaja' => $this->kirjoittaja,
            'sisalto' => $this->sisältö,
            'arvosana' => $this->arvosana,
            'id' => $this->id
        ));
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Arvostelu (elokuva_id, kirjoittaja, sisältö, arvosana) VALUES (:elokuva_id, :kirjoittaja, :sisalto, :arvosana) RETURNING id');
        $query->execute(array('elokuva_id' => $this->elokuva_id, 'kirjoittaja' => $this->kirjoittaja, 'sisalto' => $this->sisältö, 'arvosana' => $this->arvosana));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
        public function saveUusi($elokuva_id) {

        $query = DB::connection()->prepare('INSERT INTO Arvostelu (elokuva_id, kirjoittaja, sisältö, arvosana) VALUES (:elokuva_id, :kirjoittaja, :sisalto, :arvosana) RETURNING id');
        $query->execute(array('elokuva_id' => $elokuva_id, 'kirjoittaja' => $this->kirjoittaja, 'sisalto' => $this->sisältö, 'arvosana' => $this->arvosana));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare(
                'DELETE FROM Arvostelu WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }

}
