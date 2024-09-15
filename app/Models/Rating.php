<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     */
    protected $table = 'ratings';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'rating_id';
    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;


    

    protected $fillable = ['user_id','transport_id','rating_score','comment'];


     /**
     * Get the user that owns the Ratings
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function transport(): BelongsTo
    {
        return $this->belongsTo(Transport::class, 'transport_id', 'transport_id');
    }
}
