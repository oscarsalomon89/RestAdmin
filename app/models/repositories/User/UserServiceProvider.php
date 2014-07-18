<?php namespace repositories\User;
 
use Illuminate\Support\ServiceProvider;
 
class UserServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('repositories\\User\\IUserRepository', 'repositories\\User\\UserRepository');
    }
}