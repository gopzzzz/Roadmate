<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_franchises extends Model
{ 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Adjust 'user_id' to your actual foreign key column name
    }
    
// In tbl_franchis.php
public function franchiseDetails()
{
    return $this->hasOne(Tbl_franchase_details::class, 'franchise_id', 'id');
}

// In TblFranchaseDetail.php
public function franchise()
{
    return $this->belongsTo(Tbl_franchises::class, 'franchise_id');
}



}
