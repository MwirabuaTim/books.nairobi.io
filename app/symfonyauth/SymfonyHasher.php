<?php

class SymfonyHasher implements Illuminate\Hashing\HasherInterface {

    public function make($value, array $options = array())
    {
        /* make your hash here */
    }

    public function check($value, $hashedValue, array $options = array())
    {
        return $hashedValue == $this->make($value);
    }

}

?>