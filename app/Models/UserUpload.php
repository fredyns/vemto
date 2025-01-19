<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Datetime;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Snippet\Helpers\JsonField;

/**
 * This is the model class for table "user_uploads".
 *
 * @property string $id
 * @property string $user_id
 * @property Datetime $at
 * @property string $file
 * @property string $name
 * @property string $description
 * @property string $type
 * @property array $metadata
 *
 * @property User $user
 *
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

    public function metadata($key = null, $default = null)
    {
        return JsonField::getField($this, 'metadata', $key, $default);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
