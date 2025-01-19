<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This is the model class for table "user_uploads".
 *
 * @property uuid $id
 * @property uuid $user_id
 * @property Datetime $at
 * @property text $file
 * @property string $name
 * @property text $description
 * @property string $type
 * @property array $metadata
 *
 */

class UserUpload extends Model
{
    use HasUuids;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'at',
        'file',
        'name',
        'description',
        'type',
        'metadata',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'user_uploads';

    public $timestamps = false;

    protected $casts = [
        'at' => 'datetime',
        'metadata' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
