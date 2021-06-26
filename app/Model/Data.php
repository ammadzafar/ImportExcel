<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use UuId;
    protected $guarded = ['id'];

    public function files()
    {
        return $this->belongsTo(File::class);
    }
}
