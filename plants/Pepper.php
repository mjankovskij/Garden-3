<?php

class Pepper extends Plants
{
    public function growQuantity()
    {
        return rand(1, 5);
    }
    
}
