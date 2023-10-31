<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->defineUserRoleGate('isUser',UserRole::USER);
        $this->defineUserRoleGate('isAdmin',UserRole::ADMIN);
    }

    public function defineUserRoleGate(string $name, string $role): void
    {
        Gate::define($name, function (User $user) use($role) {
            return $user->role == $role;
        });
    }
}
