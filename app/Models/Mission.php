<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'mark',
        'repeat_type',
        'repeat_config',
        'notify_at',
        'start_at',
        'end_at',
        'mission_type_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function missionType()
    {
        return $this->belongsTo(MissionType::class);
    }
}
