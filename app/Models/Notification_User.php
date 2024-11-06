<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification_User extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_notification',
        'id_user',
        'seen',
        'date_seen'
    ];

    public $timestamps = true;


    // Relacionamento com Notification
    public function notification()
    {
        return $this->belongsTo(Notification::class, 'id_notification');
    }

    // Relacionamento com User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
