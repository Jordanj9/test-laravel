<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'description', 'maximum_execution_date', 'user_id', 'created_at', 'updated_at'
    ];

    public function getIsTaskExpiredAttribute() {
        $current = strtotime(date("Y-m-d H:i:00"), time());
        $maximun = strtotime($this->maximum_execution_date);
        return $current > $maximun;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function logs() {
        return $this->hasMany(Log::class);
    }
}
