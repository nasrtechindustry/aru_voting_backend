<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User_Role extends Model
{
    /** @use HasFactory<\Database\Factories\UserRoleFactory> */
    use HasFactory;

    protected $table = 'user_roles';
    protected $fillable = [
        'user_id',
        'role_id',
    ];

    /**
     * Summary of user
     * @return BelongsTo<User, User_Role>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Summary of role
     * @return BelongsTo<Role, User_Role>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
