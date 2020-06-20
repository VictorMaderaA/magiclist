<?php


namespace App\Models;


use App\Models\Base\BaseModel;
use App\User;
use Illuminate\Support\Facades\Mail;

class Feedback extends BaseModel
{

    protected static function boot()
    {
        parent::boot();

        Feedback::created(function ($feedback) {
            $user = $feedback->user_id? User::find($feedback->user_id) : null;
            $user = $user? "User: {$user->name} | {$user->email}" : 'User: Anonimo';
            $content = "Type: {$feedback->type}\n{$user}\nMessage: {$feedback->message}";
            Mail::raw($content, function ($message) {
                //TODO - remove default email
                $message->to('victor.madera.a@gmail.com')
                    ->subject('New Feedback - MagicList ' . date('Y-m-d H:i:s'));
            });
        });
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedback';

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


}
