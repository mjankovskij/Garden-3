<?php

class Plants
{
    private $id,$type,$img,$quantity;

    public function getId()
    {
        return $this->id;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    // public static function plantNew($type, $image = 1, $value = 0)
    // {
    //     $sql = "INSERT INTO garden (type, img , quantity) VALUES ('$type', '$image', '$value')";
    //     Db::conn()->prepare($sql)->execute([$type, $image, $value]);
    // }

    public static function uproot($id)
    {
        if (!(Db::getQuantity('garden', $id))) {
            return 'Tokiu daržovių nėra.';
        }
        Db::delete('garden', $id);
        return 'OK';
    }

    public static function pick($id, $value)
    {
        if (!$id || !$value) {
            return 'Nuskinti nepavyko, prasome pasitikslinti skinama kieki.';
        }
        $amount = preg_replace('/[^0-9]/', '', $value);
        if ($amount != $value || $amount < 0) {
            return 'Prasome pasitikslinti skinama kieki.';
        }
        if (!(Db::getQuantity('garden', $id))) {
            return 'Tokiu daržovių nėra.';
        }
        if ((Db::getValue('garden', $id, 'quantity')) - $amount < 0) {
            return 'Kiekis negali būti neigiamas.';
        }
        Db::subtractValue('garden', $id, 'quantity', $amount);
        return 'OK';
    }
}

include_once __DIR__ . '/plants/Cucumber.php';
include_once __DIR__ . '/plants/Tomato.php';
include_once __DIR__ . '/plants/Pepper.php';
