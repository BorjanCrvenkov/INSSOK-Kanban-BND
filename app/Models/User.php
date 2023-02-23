<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\QueryBuilderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, QueryBuilderTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'image_name',
        'image_link',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string[]
     */
    public function allowedFilters(): array
    {
        return [
            'first_name',
            'last_name',
            'username',
            'email',
        ];
    }

    /**
     * @return array|string[]
     */
    public function allowedSorts(): array
    {
        return [
            'first_name',
            'last_name',
            'username',
            'email',
        ];
    }

    /**
     * @return string[]
     */
    public function allowedIncludes(): array
    {
        return [
            'assigned_tasks',
            'reported_tasks',
            'watched_tasks',
            'workspaces',
        ];
    }

    /**
     * @return HasMany
     */
    public function assigned_tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assignee_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function reported_tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'reporter_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function watched_tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'watches');
    }

    /**
     * @return BelongsToMany
     */
    public function workspaces(): BelongsToMany
    {
        return $this->belongsToMany(Workspace::class, 'user_workspaces');
    }
}
