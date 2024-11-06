<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_notice',
        'alias',
    ];

    public $timestamps = true;

    public function notificationUsers()
    {
        return $this->hasMany(Notification_User::class, 'id_notification');
    }

    // Relacionamento com Notice
    public function notice()
    {
        return $this->belongsTo(Notice::class, 'id_notice');
    }
}
