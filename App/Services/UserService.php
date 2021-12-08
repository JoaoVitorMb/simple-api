<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    public function get(?int $id = null)
    {
        if ($id) {
            return User::select($id);
        } else {
            return User::selectAll();
        }
    }

    public function post(?int $id = null)
    {
        return User::insert($_POST);
    }

    public function put()
    {
        return file_get_contents("php://input");
        //return User::update($_POST);
    }

    public function delete() 
    {
        
    }
}