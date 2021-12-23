<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';
    protected $guarded = ['student_id', 'created_at'];
    public $timestamps = false;

    /**
     * Method to change default search column from
     * column 'id' te desired column name
     */
    public function getRouteKeyName()
    {
        return 'student_id';
    }
}