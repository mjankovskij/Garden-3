<?php

class Plants
{
    private $id, $type, $img, $quantity, $willGrow;
    private static $plants = ['Cucumber', 'Pepper', 'Tomato'];

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

    public function getWillGrow()
    {
        return $this->willGrow;
    }

    public static function growAll()
    {
        foreach (Db::arrayTable(['table'  => 'garden']) as $item) {
            Db::addValue('garden', $item['id'], 'quantity', $item['willGrow']);
            if ($item['type'] == 'Cucumber') $rand = rand(10, 20);
            if ($item['type'] == 'Tomato') $rand = rand(1, 10);
            if ($item['type'] == 'Pepper') $rand = rand(1, 5);
            Db::updateValue('garden', $item['id'], 'willGrow', $rand);
        }
        return Db::arrayTable(['table'  => 'garden']);
    }

    // public static function growAll2($obj)
    // {
    //     $count = 0;
    //     foreach ($obj as $key => $value) {
    //         if (!(Db::idExists('garden', $key))) {
    //             return 'Tokiu daržovių nėra.';
    //         }
    //         if ($value > 20 || $value < 1) {
    //             return 'Tokiu prieaugių nebūna.';
    //         }
    //         $count++;
    //     }
    //     if ($count < 1) {
    //         return 'Nėra ką auginti.';
    //     }
    //     $array = [];
    //     foreach ($obj as $key => $value) {
    //         Db::addValue('garden', $key, 'quantity', $value);
    //         $array[] = ['id' => $key, 'quantity' => Db::getValue('garden', $key, 'quantity'), 'grow' => self::growQuantityStatic($key)];
    //     }
    //     return $array;
    // }
    
    public static function isPlant($name)
    {
        $exists = false;
        foreach (self::$plants as $item) {
            if ($item == $name) {
                $exists = true;
            }
        }
        return $exists;
    }

    public static function plantNew($type, $quantity = 1)
    {
        if (!self::isPlant($type)) {
            return 'Tokiu daržovių nėra.';
        }
        if ($quantity != (int)$quantity || $quantity < 1 || $quantity > 5) {
            return 'Prašome pasitikslinti sodinamą kiekį (1-5).';
        }
        foreach (range(1, $quantity) as $_) {
            Db::insert('garden', ['type' => $type, 'img' => rand(1, 3), 'quantity' => 0]);
        }
        return 'OK';
    }

    public static function uproot($id)
    {
        if (!(Db::idExists('garden', $id))) {
            return 'Tokiu daržovių nėra.';
        }
        Db::delete('garden', $id);
        return 'OK';
    }

    public static function pick($id = '-1', $value = 0)
    {
        if (!$id || !$value) {
            return 'Nuskinti nepavyko, prasome pasitikslinti skinama kieki.';
        }
        $amount = preg_replace('/[^0-9]/', '', $value);
        if ($amount != $value || $amount < 0) {
            return 'Prašome patikslinti skynamą kiekį.';
        }
        if (!(Db::idExists('garden', $id))) {
            return 'Tokių daržovių nėra.';
        }
        if ((Db::getValue('garden', $id, 'quantity')) - $amount < 0) {
            return 'Kiekis negali būti neigiamas.';
        }
        Db::subtractValue('garden', $id, 'quantity', $amount);
        return 'OK';
    }
}
