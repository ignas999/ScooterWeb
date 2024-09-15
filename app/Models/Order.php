<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_id';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'transport_id', 'status_id', 'amount' ,'start_date' ,'end_date'];

    // rysiai 
    public function user(): BelongsTo
    {
        
        return $this->belongsTo(User::class,'user_id', 'user_id');
    }

    public function transport(): BelongsTo
    {
        
        return $this->belongsTo(Transport::class,'transport_id', 'transport_id');
    }

    public function status(): BelongsTo
    {
        
        return $this->belongsTo(Status::class,'status_id', 'status_id');
    }
}
