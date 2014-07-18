<?php namespace repositories\User;
use \User;

class UserRepository implements IUserRepository {

public function getAllUsers()
    {
        return User::all();
    }
 
    public function getUserById($id)
    {
        return User::find($id);
    }
 
    public function createOrUpdate($id = null)
    {
        if(is_null($id)) {
            // create after validation
            $user = new User;
            $user->name = 'Sheikh Heera';
            $user->lastname = 'me@yahoo.com';
            $user->password = '123456';
            return $user->save();
        }
        else {
            // update after validation
            $user = User::find($id);
            $user->name = 'Sheikh Heera';
            $user->lastname = 'me@yahoo.com';
            $user->password = '123456';
            return $user->save();
        }
    }
}