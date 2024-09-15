<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'statuses';
    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'status_id';
    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    public function transports()
    {
        // paaiskinimas , hasmany (lentele kurioje yra foreign raktas, foreign raktas toje lenteleje, primary raktas toje lenteleje is kurios norime suristi

        // return $this->hasMany(Transport::class, 'Status_id(foreign_key esantis transport lenteleje)' , 'Status_id'(Primary  key esantis lenteleje su kuria norime suristi));
        //                                                                                                  siuo atveju reikia suristis su Status lentele, todel rasome jos rakta)
       // sutartu budu ieskos sio foreign key pagal fukcijos pavadinima + _id
        return $this->hasMany(Transport::class, 'status_id' , 'status_id');
    }
}
