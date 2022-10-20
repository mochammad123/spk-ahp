<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcriteriaComparison extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['criteria'];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' .  $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['decision'] ?? false, function ($query, $decision) {
            return $query->whereHas('decision', function ($query) use ($decision) {
                $query->where('slug', $decision);
            });
        });
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
