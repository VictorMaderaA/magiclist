<?php


namespace App\Models;


use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lists extends BaseModel
{
    use SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lists';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int'; //'int'

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = [
        'activities',
        'activitiesPending',
        'activitiesCompleted'
    ];

    //-----------------------------------------------------------------------------------------------------------------

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [];

    //-----------------------------------------------------------------------------------------------------------------

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    //-----------------------------------------------------------------------------------------------------------------

    public function activities()
    {
        return $this->hasMany(Activities::class, 'list_id');
    }

    public function activitiesCompleted()
    {
        return $this->hasMany(Activities::class, 'list_id')
            ->where('completed_at', '<>', null);
    }

    public function activitiesPending()
    {
        return $this->hasMany(Activities::class, 'list_id')
            ->where('completed_at',null);
    }


}
