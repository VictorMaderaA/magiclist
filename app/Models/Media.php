<?php


namespace App\Models;


use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Media extends BaseModel
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';

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
    protected $keyType = 'int';

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
    protected $withCount = [];

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
        return $this->belongsToMany(Activities::class, 'activity_media', 'media_id', 'activity_id');
    }

    public function getTempUrlAttribute()
    {
//        $hour = date('H', time());
        $expires = now()->addHour();
//        if( $hour > 0 && $hour <= 6) {
//            $expires->setTime(12, 0);
//        }
//        else if($hour > 6 && $hour <= 12) {
//            $expires->setTime(18, 0);
//        }
//        else if($hour > 12 && $hour <= 18) {
//            $expires->addDay();
//        }
//        else {
//            $expires->addDay()->setTime(6,0);
//        }

        return Storage::disk('s3')->temporaryUrl($this->getAttribute('path'), $expires);
    }

}
