<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This is the model class for table "subrecords".
 *
 * @property uuid $id
 * @property uuid $record_id
 * @property Datetime $datetime
 * @property Datetime $date
 * @property Datetime $time
 * @property bigInteger $n_p_w_p
 * @property text $markdown_text
 * @property text $w_y_s_i_w_y_g
 * @property text $file
 * @property text $image
 * @property ipAddress $i_p_address
 * @property float $latitude
 * @property float $longitude
 *
 */

class Subrecord extends Model
{
    use HasUuids;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'record_id',
        'datetime',
        'date',
        'time',
        'n_p_w_p',
        'markdown_text',
        'w_y_s_i_w_y_g',
        'file',
        'image',
        'i_p_address',
        'latitude',
        'longitude',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'datetime' => 'datetime',
        'date' => 'date',
        'time' => 'datetime:H:i:s',
    ];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
