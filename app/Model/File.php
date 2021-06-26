<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use UuId;
    protected $guarded = ['id'];

    public function records()
    {
        return $this->hasMany(Data::class);
    }
}
