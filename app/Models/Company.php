<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'email',
        'logo',
        'addres',
        'points'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
