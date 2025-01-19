<?php

namespace App\Models;

use Datetime;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This is the model class for table "user_activity_logs".
 *
 * @property string $id
 * @property Datetime $at
 * @property string $user_id
 * @property string $title
 * @property string $link
 * @property string $message
 * @property string $i_p_address
 *
 * @property User $user
 *
 *
 */

class UserActivityLog extends Model
{
    use HasUuids;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'at',
        'user_id',
        'title',
        'link',
        'message',
        'i_p_address',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'user_activity_logs';

    public $timestamps = false;

    protected $casts = [
        'at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
