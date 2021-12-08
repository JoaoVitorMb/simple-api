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

    public function put()
    {
        $urlDecoded = urldecode(file_get_contents("php://input"));
        $data = json_decode($urlDecoded);
        
        // $data["id"] = explode("=", $inputData[0])[1];
        // $data["username"] = explode("=", $inputData[1])[1];
        // $data["email"] = explode("=", $inputData[2])[1];
        // $data["password"] = explode("=", $inputData[3])[1];
        
        return User::update($data);
    }

    public function delete() 
    {
        
    }
}