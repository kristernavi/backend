<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkPaper extends Model
{
    //
    protected $guarded = [];

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }
}
