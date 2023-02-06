<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Board;
use App\Models\Column;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTaskComment;
use App\Models\Watches;
use App\Models\Workspace;
use App\Policies\BoardPolicy;
use App\Policies\ColumnPolicy;
use App\Policies\RolePolicy;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use App\Policies\WatchesPolicy;
use App\Policies\WorkspacePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Workspace::class        => WorkspacePolicy::class,
        Board::class            => BoardPolicy::class,
        Column::class           => ColumnPolicy::class,
        Task::class             => TaskPolicy::class,
        Watches::class          => WatchesPolicy::class,
        User::class             => UserPolicy::class,
        UserWorkspace::class    => UserWorkspacePolicy::class,
        Role::class             => RolePolicy::class,
        UserTaskComment::class  => UserTaskComment::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
