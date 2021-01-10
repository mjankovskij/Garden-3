<?php

class Plants
{
    private $id, $type, $img, $quantity;

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

    public static function plantNew($type, $quantity = 1)
    {
        if ($type != 'Cucumber' && $type != 'Tomato' && $type != 'Pepper') {
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

    public static function pick($id='-1', $value=0)
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
