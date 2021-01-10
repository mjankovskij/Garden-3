<?php

namespace plants;

use Plants;

class Pepper extends Plants
{
    public function growQuantity()
    {
        return rand(1, 5);
    }
}
