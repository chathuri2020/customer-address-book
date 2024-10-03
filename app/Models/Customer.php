<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [ 'name',
    'company',
    'contact_phone',
    'email',
    'country'];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'customer_project', 'customer_id', 'project_id');
    }
}

