<?php

use Illuminate\Support\ServiceProvider;

class SymfonyHasherServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('hash', function()
        {
            return new SymfonyHasher;
        });
    }

}

?>