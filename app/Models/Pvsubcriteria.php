<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pvsubcriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['criteria', 'subcriteria'];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function subcriteria()
    {
        return $this->belongsTo(Subcriteria::class);
    }
}
