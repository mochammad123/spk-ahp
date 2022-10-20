<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Criteria extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'criteria'
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

    public function subcriteria()
    {
        return $this->hasMany(Subcriteria::class);
    }

    public function pvcriteria()
    {
        return $this->hasMany(Pvcriteria::class);
    }

    public function pvsubcriteria()
    {
        return $this->hasMany(Pvsubcriteria::class);
    }

    public function criteriacomparison()
    {
        return $this->hasMany(CriteriaComparison::class);
    }

    public function subcriteriacomparison()
    {
        return $this->hasMany(SubcriteriaComparison::class);
    }

    public function alternativecomparison()
    {
        return $this->hasMany(AlternativeComparison::class);
    }

    public function alternatisinglevecomparison()
    {
        return $this->hasMany(AlternativeSingleComparison::class);
    }

    public function pvalternative()
    {
        return $this->hasMany(AlternativeSingleComparison::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($criteria) {
            $criteria->subcriteria()->delete();
        });

        static::deleting(function ($criteria) {
            $criteria->pvcriteria()->delete();
        });

        static::deleting(function ($criteria) {
            $criteria->pvsubcriteria()->delete();
        });

        static::deleting(function ($criteria) {
            $criteria->criteriacomparison()->delete();
        });

        static::deleting(function ($criteria) {
            $criteria->subcriteriacomparison()->delete();
        });

        static::deleting(function ($criteria) {
            $criteria->alternativecomparison()->delete();
        });

        static::deleting(function ($criteria) {
            $criteria->alternativesinglecomparison()->delete();
        });

        static::deleting(function ($criteria) {
            $criteria->pvalternative()->delete();
        });
    }
}
