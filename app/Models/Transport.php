<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transport extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transports';
    protected $primaryKey = 'transport_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function status(): BelongsTo
    {
        
        return $this->belongsTo(Status::class,'status_id', 'status_id');
    }

    

    public function category(): BelongsTo
    {

        //transportoTipas - foreign key esantis Transport leneleje
        //TransportoTIpasID - primary key esantis transporto tipai lenteleje
        return $this->belongsTo(Category::class,'category_id', 'category_id');
    }

    public function location(): BelongsTo{
        
      
            return $this->belongsTo(location::class,'location_id', 'location_id');
        
    }
    public function orders(): HasMany{
        
      
        return $this->hasMany(Order::class,'transport_id', 'transport_id');
    
}

    public function ratings(): HasMany{
            
        
        return $this->hasMany(Rating::class,'Ivertinimo_id', 'Transporto_id');

    }
}

