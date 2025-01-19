<?php

namespace App\Models;

use Datetime;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This is the model class for table "records".
 *
 * @property string $id
 * @property string $created_by
 * @property string $updated_by
 * @property string $user_id
 * @property string $string
 * @property string $email
 * @property string $integer
 * @property float $decimal
 * @property integer $n_p_w_p
 * @property Datetime $datetime
 * @property Datetime $date
 * @property Datetime $time
 * @property string $i_p_address
 * @property bool $boolean
 * @property string $enumerate
 * @property string $text
 * @property string $file
 * @property string $image
 * @property string $markdown_text
 * @property string $w_y_s_i_w_y_g
 * @property string $latitude
 * @property string $longitude
 *
 * @property Subrecord[] $subrecords
 *
 * @property User $user
 *
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
