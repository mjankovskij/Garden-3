<?php

class Plants
{
    private $id, $type, $img, $quantity, $willGrow;
    private static $plants = [
        'Cucumber' => ['min' => 10, 'max' => 20, 'price' => 2],
        'Tomato' => ['min' => 1, 'max' => 10, 'price' => 1.5],
        'Pepper' => ['min' => 1, 'max' => 5, 'price' => 2.4]
    ];

    public function getPrice()
    {
        return self::$plants[$this->type]['price'];
    }

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
            $rand = rand(self::$plants[$item['type']]['min'], self::$plants[$item['type']]['max']);
            Db::updateValue('garden', ['id', $item['id']], 'willGrow', $rand);
        }
        return Db::arrayTable(['table'  => 'garden']);
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
            Db::insert('garden', [
                'type' => $type,
                'img' => rand(1, 3),
                'quantity' => 0,
                'willGrow' => rand(self::$plants[$type]['min'], self::$plants[$type]['max'])
            ]);
        }
        return 'OK';
    }

    public static function uproot($id)
    {
        if (!(Db::isExists('garden', ['id', $id]))) {
            return 'Tokiu daržovių nėra.';
        }
        Db::delete('garden', $id);
        return 'OK';
    }

    public static function pick($id = '0', $value = 0)
    {
        if (!$id || !$value) {
            return 'Nuskinti nepavyko, prasome pasitikslinti skinama kieki.';
        }
        $amount = preg_replace('/[^0-9]/', '', $value);
        if ($amount != $value || $amount < 0) {
            return 'Prašome patikslinti skynamą kiekį.';
        }
        if (!(Db::isExists('garden', ['id', $id]))) {
            return 'Tokių daržovių nėra.';
        }
        if ((Db::getValue('garden', ['id', $id], 'quantity')) - $amount < 0) {
            return 'Kiekis negali būti neigiamas.';
        }
        Db::subtractValue('garden', $id, 'quantity', $amount);
        return 'OK';
    }
}
