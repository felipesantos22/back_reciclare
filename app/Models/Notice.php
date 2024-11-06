<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author'
    ];

    public $timestamps = true;

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'id_notice');
    }

}
