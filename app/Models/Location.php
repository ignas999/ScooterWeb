<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'locations';
    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'location_id';
    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    public function transports(): HasMany
{
    return $this->hasMany(Transport::class, 'location_id' , 'location_id');
}
}
