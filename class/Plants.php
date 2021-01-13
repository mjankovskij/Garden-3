<?php

class Plants
{
    private $id, $type, $img, $quantity;
    private static $plants = [
        'Cucumber' => ['min' => '10', 'max' => '20'],
        'Pepper' => ['min' => '1', 'max' => '5'],
        'Tomato' => ['min' => '1', 'max' => '10']
    ];

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

    public function growQuantity()
    {
        return rand(self::$plants[$this->type]['min'], self::$plants[$this->type]['max']);
    }

    public static function growQuantityStatic($id)
    {
        $type = Db::getValue('garden', $id, 'type');
        return rand(self::$plants[$type]['min'], self::$plants[$type]['max']);
    }

    public static function growAll($obj)
    {
        $count = 0;
        foreach ($obj as $key => $value) {
            if (!(Db::getQuantity('garden', $key))) {
                return 'Tokiu daržovių nėra.';
            }
            if ($value > 20 || $value < 1) {
                return 'Tokiu prieaugių nebūna.';
            }
            $count++;
        }
        if($count<1){
            return 'Nėra ką auginti.';
        }
        $array = [];
        foreach ($obj as $key => $value) {
            Db::addValue('garden', $key, 'quantity', $value);
            $array[] = ['id' => $key, 'quantity' => Db::getValue('garden', $key, 'quantity'), 'grow' => self::growQuantityStatic($key)];
        }
        return $array;
    }

    public static function isPlant($name)
    {
        $exists = false;
        foreach (self::$plants as $key => $_) {
            if ($key == $name) {
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
        if (!(Db::getQuantity('garden', $id))) {
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
