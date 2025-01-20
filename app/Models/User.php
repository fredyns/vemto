<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Datetime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property Datetime $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $two_factor_secret
 * @property string $two_factor_recovery_codes
 * @property Datetime $two_factor_confirmed_at
 * @property string $current_team_id
 * @property string $profile_photo_path
 *
 * @property UserActivityLog[] $userActivityLogs
 *
 * @property UserUpload[] $userUploads
 *
 * @property UserGallery[] $userGalleries
 *
 * @property Record[] $records
 *
 *
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use HasUuids;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    protected $fillable = ['name', 'email', 'password'];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function userActivityLogs()
    {
        return $this->hasMany(UserActivityLog::class);
    }

    public function userUploads()
    {
        return $this->hasMany(UserUpload::class);
    }

    public function userGalleries()
    {
        return $this->hasMany(UserGallery::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
}
