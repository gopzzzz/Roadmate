<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_crms extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Adjust 'user_id' to your actual foreign key column name
    }
    
}
