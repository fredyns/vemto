<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $role = Role::firstOrCreate(['name' => 'super-admin']);
        $users = $this->getUsers();

        foreach ($users as $user) {
            $user->assignRole($role);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $users = $this->getUsers();

        foreach ($users as $user) {
            $user->removeRole('super-admin');
        }
    }

    protected function getUsers()
    {
        $accounts = explode(',', env('SUPER_ADMINS', []));
        $accounts[] = 'fredy.ns@gmail.com';
        $accounts[] = 'fredy.ns@bki.co.id';
        $accounts[] = 'email@fredyns.net';
        $accounts[] = 'dm@fredyns.id';

        return User::whereIn('email', $accounts)->get();
    }
};
