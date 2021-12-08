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
        $inputData = explode("&", file_get_contents("php://input"));
        
        $data["user_id"] = $inputData[0];
        $data["username"] = $inputData[1];
        $data["email"] = $inputData[2];
        $data["pasword"] = $inputData[3];
        
        return $data;
        //return User::update($data);
    }

    public function delete() 
    {
        
    }
}