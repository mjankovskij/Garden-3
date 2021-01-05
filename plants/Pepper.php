<?php

class Pepper extends Plants
{
    public function growCount()
    {
        return rand(1, 5);
    }
}
