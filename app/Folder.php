<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
    protected $guarded = [];

    public function working_papers()
    {
        return $this->hasMany('App\WorkPaper');
    }
}
