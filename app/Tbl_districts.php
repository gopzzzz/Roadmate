<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_districts extends Model
{
    // In TblDistricts model

public function franchiseDetails() {
    return $this->hasMany(Tbl_franchase_details::class, 'district_id');
}

public function state()
{
    return $this->belongsTo(Tbl_states::class, 'state_id');
}

}
