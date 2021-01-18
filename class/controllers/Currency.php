<?php

namespace Controller;

use Api, App, Db;

class Currency
{
    public static $symbol = [
        'EUR' => '€',
        'USD' => '$',
        'GBP' => '£',
        'RUB' => '₽'
    ];

    public function render()
    {
        $options = '';
        foreach (Currency::$symbol as $key => $item) {
            $options .= "<option value=" . URL . (URI[0] ?? '') . "/setCurrency/$key>$key $item</option>";
        }
        return "<form>
        <label for='currency'>Valiuta:</label>
        <select name='currency' onchange='location = this.value;'>
            <option value=''>Pasirinkite</option>
           $options
        </select>
    </form>";
    }

    public function setCurrency()
    {
        $exists = false;
        foreach (Currency::$symbol as $key => $_) {
            if ($key == URI[2]) {
                $exists = true;
            }
        }
        if ($exists) {
            setcookie('garden_currency', URI[2], time() + 365 * 24 * 60 * 60, "/");
            App::redirect(URL . (URI[0] ?? ''));
        }
    }

    public static function api($to)
    {
        $to = "EUR_$to";
        return Api::get("https://free.currconv.com/api/v7/convert?apiKey=do-not-use-this-key&q=$to&compact=ultra&apiKey=fd59d99637a236229269")->$to;
    }

    public static function getCurrency($to)
    {
        return Db::getValue('currencies', ['currencies', "EUR_$to"], 'ratio');
    }

    public static function convert($price, $to)
    {
        $conn = DB::isExists('currencies', ['currencies', "EUR_$to"]);
        if (!$conn) {
            Db::insert('currencies', ['currencies' => "EUR_$to", 'ratio' => self::api($to), 'time' => time() + 60 * 60]);
        } else {
            $time = Db::getValue('currencies', ['currencies', "EUR_$to"], 'time');
            if ($conn && $time < time() && $time != -1) {
                Db::updateValue('currencies', ['ratio', "EUR_$to"], 'ratio', self::api($to));
                Db::updateValue('currencies', ['currencies', "EUR_$to"], 'time', time() + 60 * 60);
            }
        }
        return number_format($price * self::getCurrency($to), 2, ',', ' ') . ' ' . (self::$symbol[$to] ?? '');
    }


}
