<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This is the model class for table "user_activity_logs".
 *
 * @property uuid $id
 * @property Datetime $at
 * @property uuid $user_id
 * @property string $title
 * @property text $link
 * @property text $message
 * @property ipAddress $i_p_address
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
