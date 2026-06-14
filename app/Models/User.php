<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

#[Fillable(['name', 'email', 'password', 'rolename'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function sp_GetAllUsers($user_Id)
    {
        $results = DB::select('CALL sp_GetAllUsers(:id)', ['id' => $user_Id]);
        return $results;
    }
    public function sp_GetUserById($user_Id)
    {
        $results = DB::selectOne('CALL sp_GetUserById(:id)', ['id' => $user_Id]);
        return $results;
    }
    public function sp_GetAllUserroles()
    {
        $results = DB::select('CALL sp_GetAllUserroles()');
        return $results;
    }
    public function sp_UpdateUser($id, $name, $email, $rolename)
    {
        $results = DB::selectOne('CALL sp_UpdateUser(:id, :name, :email, :rolename)', [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'rolename' => $rolename
        ]);
        return $results;
    }
    public function sp_DeleteUser($userid)
    {
        $results = DB::selectOne('CALL sp_DeleteUser(:userid)', [
            'userid' => $userid]);
        return $results;
    }
}
