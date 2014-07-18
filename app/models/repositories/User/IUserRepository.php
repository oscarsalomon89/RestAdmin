<?php namespace repositories\User;

interface IUserRepository {
    
    public function getAllUsers();

    public function getUserById($id);

    public function createOrUpdate($id = null);
}