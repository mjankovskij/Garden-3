<?php

class Tomato extends Plants {
    public function growCount(){
        return rand(1,10);
    }
}