<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_places extends Model
{
    // In TblPlaces model

public function franchiseDetails() {
    return $this->hasMany(Tbl_franchase_details::class, 'place_id');
    
}

}
