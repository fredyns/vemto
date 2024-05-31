<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    ];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
