<?php
namespace App\Services;

use App\Models\Record;

class RecordService
{
    public function get(?int $id = null)
    {
        if ($id) {
            return Record::select($id);
        } else {
            return Record::selectAll();
        }
    }

    public function post() 
    {
        $data = $_POST;

        return "SUCCESS";
    }

    public function update() 
    {
        
    }

    public function delete() 
    {
        
    }
}