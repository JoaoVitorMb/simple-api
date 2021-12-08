<?php
namespace App\Services;

use App\Models\Company;

class CompanyService
{
    public function get(?int $id = null)
    {
        if ($id) {
            return Company::select($id);
        } else {
            return Company::selectAll();
        }
    }

    public function post()
    {
        $urlDecoded = urldecode(file_get_contents("php://input"));
        return $urlDecoded;
        //return Company::insert($_POST);
    }

    public function put(int $id)
    {
        $urlDecoded = urldecode(file_get_contents("php://input"));
        $jsonData = json_decode($urlDecoded);
        return $jsonData;        
        //return Company::update($data);
    }

    public function delete() 
    {
        
    }
}