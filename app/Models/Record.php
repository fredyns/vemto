<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'bool',
        'enum',
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
        'bool' => 'boolean',
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
