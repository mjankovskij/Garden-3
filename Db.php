<?php

class Db
{
    // public static function conn()
    // {
    //     return new mysqli('localhost', 'root', '', 'sodas');
    // }

    public static function conn()
    {
        return new PDO('mysql:host=localhost;dbname=sodas', 'root', '');
    }

    public static function getObjects($obj)
    {
        $_table = $obj['table'];
        $_order = 'ORDER by id';
        $_sort = $_limit = '';
        if (isset($obj['order'])) $_order = "ORDER by $obj[order]";
        if (isset($obj['sort'])) $_sort = $obj['sort'];
        if (isset($obj['limit'])) $_limit = "LIMIT $obj[limit]";
        $quer = self::conn()->query("Select * FROM $_table $_order $_sort $_limit");
        $objects = $quer->fetchAll(PDO::FETCH_CLASS, 'Plants');
        // foreach ($objects as &$item) $item = new $item->type;
        // _c($objects);
        return $objects;
    }

    public static function arrayTable($obj)
    {
        $_table = $obj['table'];
        $_order = 'ORDER by id';
        $_sort = $_limit = '';
        if (isset($obj['order'])) $_order = "ORDER by $obj[order]";
        if (isset($obj['sort'])) $_sort = $obj['sort'];
        if (isset($obj['limit'])) $_limit = "LIMIT $obj[limit]";
        $sql = self::conn()->prepare("SELECT * FROM $_table $_order $_sort $_limit");
        $sql->execute();
        $result = $sql->fetchAll();
        if (isset($obj['invert']) && $obj['invert']) sort($result);
        return $result;
    }

    public static function getQuantity($table, $id)
    {
        return self::conn()->query("SELECT count(*) FROM $table WHERE id = '$id'")->fetchColumn(); 
    }

    public static function getValue($table, $id, $value)
    {
        $pdod = self::conn()->prepare("SELECT $value FROM $table WHERE id=$id");
        $pdod->execute();
        return $pdod->fetch()[$value];
    }

    public static function addValue($table, $id, $value, $amount)
    {
        $sql = "UPDATE $table SET $value = $value + $amount WHERE id = '$id'";
        self::conn()->prepare($sql)->execute([$value]);
    }

    public static function subtractValue($table, $id, $value, $amount)
    {
        $sql = "UPDATE $table SET $value = $value - $amount WHERE id = '$id'";
        self::conn()->prepare($sql)->execute([$value]);
    }

    public static function insert($table, $data){
        $items = '\''.implode('\', \'', $data).'\'';
        $array = [];
        foreach($data as $key=>$_) $array[] = $key;
        $keys = implode(', ', $array);
        $sql = "INSERT INTO $table ($keys) VALUES ($items)";
        Db::conn()->prepare($sql)->execute($data);
    }

    public static function delete($table, $id)
    {
        self::conn()->prepare("DELETE FROM $table WHERE id='$id'")->execute();
    }
}
