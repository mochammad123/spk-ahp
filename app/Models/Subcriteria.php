<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Subcriteria extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['criteria'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'subcriteria'
            ]
        ];
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' .  $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });;
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function subcriteriacomparison()
    {
        return $this->hasMany(SubcriteriaComparison::class);
    }

    public function pvsubcriteria()
    {
        return $this->hasMany(Pvcriteria::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($subcriteria) {
            $subcriteria->subcriteriacomparison()->delete();
        });

        static::deleting(function ($subcriteria) {
            $subcriteria->pvsubcriteria()->delete();
        });
    }
}
