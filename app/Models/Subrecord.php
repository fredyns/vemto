<?php

namespace App\Models;

use Datetime;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This is the model class for table "subrecords".
 *
 * @property string $id
 * @property string $record_id
 * @property Datetime $datetime
 * @property Datetime $date
 * @property Datetime $time
 * @property integer $n_p_w_p
 * @property string $markdown_text
 * @property string $w_y_s_i_w_y_g
 * @property string $file
 * @property string $image
 * @property string $i_p_address
 * @property string $latitude
 * @property string $longitude
 *
 * @property Record $record
 *
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
