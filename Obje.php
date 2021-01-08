<?php

// try{
// $db = new PDO('mysql:host=localhost;dbname=sodas', 'root', '');
// }catch(PDOException $e){
//     _c($e);
// }



class Obje
{
    public $id;
    // private $type;
    // public function __construct()
    // {
    // }
    public function damn(){
        return $this->type;
    }
    // public function __set(){
    //     $this = new Fir;
    // }
}


// $pdo = new PDO('mysql:host=localhost;dbname=sodas', 'root', '');
// $quer = $pdo->query("Select * FROM garden");
// $rows = $quer->fetchAll(PDO::FETCH_CLASS, 'Obje');


// foreach ($rows as &$row) $row = new $row->type;

_c($rows);

foreach($rows as $item){
    _c($item->growCount());

}
// foreach($rows as $item)
// {
//     _c($item);
// }