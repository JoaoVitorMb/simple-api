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

    public function post()
    {
        $urlDecoded = urldecode(file_get_contents("php://input"));
        $data = json_decode($urlDecoded, true);
        return User::insert($data);
    }

    public function put(int $id)
    {
        $urlDecoded = urldecode(file_get_contents("php://input"));
        $data = json_decode($urlDecoded, true);        
        return User::update($data);
    }

    public function delete() 
    {
        
    }
}