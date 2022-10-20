<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pvcriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['criteria'];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
