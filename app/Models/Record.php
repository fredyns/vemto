<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This is the model class for table "records".
 *
 * @property uuid $id
 * @property uuid $created_by
 * @property uuid $updated_by
 * @property uuid $user_id
 * @property string $string
 * @property string $email
 * @property integer $integer
 * @property decimal $decimal
 * @property bigInteger $n_p_w_p
 * @property \Datetime $datetime
 * @property Datetime $date
 * @property Datetime $time
 * @property ipAddress $i_p_address
 * @property bool $boolean
 * @property enum $enumerate
 * @property text $text
 * @property text $file
 * @property text $image
 * @property text $markdown_text
 * @property text $w_y_s_i_w_y_g
 * @property float $latitude
 * @property float $longitude
 *
 */

class Record extends Model
{
    use HasUuids;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'created_by',
        'updated_by',
        'user_id',
        'string',
        'email',
        'integer',
        'decimal',
        'n_p_w_p',
        'datetime',
        'date',
        'time',
        'i_p_address',
        'boolean',
        'enumerate',
        'text',
        'file',
        'image',
        'markdown_text',
        'w_y_s_i_w_y_g',
        'latitude',
        'longitude',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'datetime' => 'datetime',
        'date' => 'date',
        'time' => 'datetime:H:i:s',
        'boolean' => 'boolean',
    ];

    public function subrecords()
    {
        return $this->hasMany(Subrecord::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
