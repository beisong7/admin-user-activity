<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'uid',
        'created_by',
        'title',
        'description',
        'image',
        'type',
        'date',
    ];

    public function getImgAttribute(){
        if(!empty($this->image)){
            return url($this->image);
        }
        return url('sample.jpg');

    }
}
