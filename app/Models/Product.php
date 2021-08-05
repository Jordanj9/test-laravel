<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'quantity', 'price', 'invoice_id', 'created_at', 'updated_at'
    ];


    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}
