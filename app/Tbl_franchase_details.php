<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_franchase_details extends Model
{
    //
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_franchase_details extends Model
{
    // protected $table = 'tbl_franchise_details';

   
protected $fillable = ['franchise_id', 'type', 'district_id', 'place_id'];
// In tbl_franchase_details model

public function franchise()
{
    return $this->belongsTo(Tbl_franchises::class, 'franchise_id');
}

public function place()
{
    return $this->belongsTo(Tbl_places::class, 'place_id');
}

public function district()
{
    return $this->belongsTo(Tbl_districts::class, 'district_id');
}

}


