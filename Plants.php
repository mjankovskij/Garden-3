<?php
class Plants
{
    private $id;
    private $type;
    private $img;
    private $count;
    private $connection;

    public function __construct($id = 0)
    {
        $this->connection = new mysqli('localhost', 'root', '', 'sodas');
        $this->connection->set_charset('utf8');
        if ($this->connection->query("SELECT id FROM garden WHERE id = '$id'")->num_rows > 0) {
            $data = $this->connection->query("SELECT * FROM garden WHERE id='$id' ORDER by id")->fetch_assoc();
            $this->id = $data['id'];
            $this->type = $data['type'];
            $this->img = $data['img'];
            $this->count = $data['count'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAllPlants()
    {
        $sql = $this->connection->query('SELECT * FROM garden ORDER by id DESC');
        $array = [];
        while ($row = $sql->fetch_assoc()) {
            $this->id = $row['id'];
            $this->type = $row['type'];
            $typeUpper = ucfirst($this->type);
            $array[] = new $typeUpper($this->id);
        }
        return $array;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function grow($id, $value)
    {
        $this->connection->query("UPDATE garden SET count = count + $value WHERE id = '$id'");
    }

    public function plantNew($type, $image = 1, $value = 0)
    {
        $this->connection->multi_query("INSERT INTO garden (type, img , count) VALUES ('$type', '$image', '$value');");
    }

    public function getLimitedArray($limit)
    {
        $array = [];
        $sql = $this->connection->query("SELECT * FROM garden ORDER by id DESC LIMIT $limit");
        while ($row = $sql->fetch_assoc()) {
            $array[] = ['id' => $row['id'], 'img' => $row['img'], 'type' =>  $row['type']];
        }
        sort($array);
        return $array;
    }

    public function uproot($id)
    {
        if ($this->connection->query("SELECT id FROM garden WHERE id = '$id'")->num_rows < 1) {
            return 'Tokiu daržovių nėra.';
        }
        $this->connection->query("DELETE FROM garden WHERE id='$id'");
        return 'OK';
    }

    public function pick($id, $value)
    {
        if (!$id || !$value) {
            return 'Nuskinti nepavyko, prasome pasitikslinti skinama kieki.';
        }
        $amount = preg_replace('/[^0-9]/', '', $value);
        if ($amount != $value || $amount < 0) {
            return 'Prasome pasitikslinti skinama kieki.';
        }
        if (!($this->connection->query("SELECT count FROM garden WHERE id = '$id'")->num_rows)) {
            return 'Tokiu daržovių nėra.';
        }
        if (($this->connection->query("SELECT count FROM garden WHERE id='$id'")->fetch_assoc()['count']) - $amount < 0) {
            return 'Kiekis negali būti neigiamas.'. ($this->connection->query("SELECT count FROM garden WHERE id='$id'")->fetch_assoc()['count']);
        }

        $this->connection->query("UPDATE garden SET count = count - $amount WHERE id = '$id'");
        return 'OK';
    }
}

include_once __DIR__ . '/plants/Cucumber.php';
include_once __DIR__ . '/plants/Tomato.php';
include_once __DIR__ . '/plants/Pepper.php';
