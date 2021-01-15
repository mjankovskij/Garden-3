<?php

class Db
{
    // public static function conn()
    // {
    //     return new mysqli('localhost', 'root', '', 'sodas');
    // }

    public final static function conn()
    {
        return new PDO('mysql:host=localhost;dbname=sodas', 'root', '');
    }

    public final static function getObjects($obj)
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
        if (isset($obj['invert']) && $obj['invert']) sort($objects);
        return $objects;
    }

    public final static function arrayTable($obj)
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

    public final static function isExists($table, $key)
    {
        $stm = self::conn()->prepare("select count(*) from `$table` where `$key[0]`=:$key[0]");
        $stm->bindParam(":$key[0]", $key[1]);
        $stm->execute();
        return $stm->fetchColumn();
    }

    public final static function getValue($table, $key, $value)
    {
        $pdod = self::conn()->prepare("SELECT $value FROM $table WHERE $key[0] = '$key[1]'");
        $pdod->execute();
        return $pdod->fetch()[$value];
    }

    public final static function updateValue($table, $key, $value, $amount)
    {
        $sql = "UPDATE $table SET $value = $amount WHERE $key[0] = '$key[1]'";
        self::conn()->prepare($sql)->execute([$value]);
    }

    public final static function addValue($table, $id, $value, $amount)
    {
        $sql = "UPDATE $table SET $value = $value + $amount WHERE id = '$id'";
        self::conn()->prepare($sql)->execute([$value]);
    }

    public final static function subtractValue($table, $id, $value, $amount)
    {
        $sql = "UPDATE $table SET $value = $value - $amount WHERE id = '$id'";
        self::conn()->prepare($sql)->execute([$value]);
    }

    public final static function insert($table, $data)
    {
        $items = '\'' . implode('\', \'', $data) . '\'';
        $array = [];
        foreach ($data as $key => $_) $array[] = $key;
        $keys = implode(', ', $array);
        $sql = "INSERT INTO $table ($keys) VALUES ($items)";
        Db::conn()->prepare($sql)->execute($data);
    }

    public final static function delete($table, $id)
    {
        self::conn()->prepare("DELETE FROM $table WHERE id='$id'")->execute();
    }
}
