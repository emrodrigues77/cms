<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Role extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function usersCount() {
        return $this->users()->count();
    }
}
