<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'databases';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'database_name',
        'status',
    ];

    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'landlord';

    public $timestamps = false;
}
