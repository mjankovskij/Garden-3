<?php

namespace plants;

use Plants;

class Cucumber extends Plants
{
    public function growQuantity()
    {
        return rand(10, 20);
    }
}
