<?php

class Tomato extends Plants
{
    public function growQuantity()
    {
        return rand(1, 10);
    }
}
