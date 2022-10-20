<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Alternative extends Model
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
                'source' => 'alternative'
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

    public function alternativecomparison()
    {
        return $this->hasMany(AlternativeComparison::class);
    }

    public function alternativesinglecomparison()
    {
        return $this->hasMany(AlternativeSingleComparison::class);
    }

    public function pvalternative()
    {
        return $this->hasMany(Pvalternative::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($alternative) {
            $alternative->alternativecomparison()->delete();
        });

        static::deleting(function ($alternative) {
            $alternative->alternativesinglecomparison()->delete();
        });

        static::deleting(function ($alternative) {
            $alternative->pvalternative()->delete();
        });
    }
}
