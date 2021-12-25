<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected $primaryKey = 'department_id';
    protected $guarded = ['department_id', 'created_at'];
    public $timestamps = false;

    /**
     * Method to change default search column from
     * column 'id' te desired column name
     */
    public function getRouteKeyName()
    {
        return 'department_id';
    }
}