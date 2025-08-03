<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bookings()
    {
        return $this->hasMany('App\Models\Booking', 'service_id');
    }

    public function includes()
    {
        return $this->hasMany(ServiceInclude::class, 'service_id');
    }

    public function excludes()
    {
        return $this->hasMany(ServiceExclude::class, 'service_id');
    }

    public function requirements()
    {
        return $this->hasMany(ServiceRequirement::class, 'service_id');
    }

    public function images()
    {
        return $this->hasMany(ServiceImage::class, 'service_id');
    }

    public function variants()
    {
        return $this->hasMany(ServiceVariant::class, 'service_id');
    }

    // Keep the original relationships for backward compatibility
    public function serviceIncludes()
    {
        return $this->hasMany(ServiceInclude::class, 'service_id');
    }

    public function serviceExcludes()
    {
        return $this->hasMany(ServiceExclude::class, 'service_id');
    }

    public function serviceRequirements()
    {
        return $this->hasMany(ServiceRequirement::class, 'service_id');
    }

    public function serviceImages()
    {
        return $this->hasMany(ServiceImage::class, 'service_id');
    }

    public function serviceVariants()
    {
        return $this->hasMany(ServiceVariant::class, 'service_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'service_id');
    }
}
