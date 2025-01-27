<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FilamentUser
 * 
 * @property int $id
 * @property string|null $avatar
 * @property string $email
 * @property bool $is_admin
 * @property string $name
 * @property string $password
 * @property array|null $roles
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class FilamentUser extends Model
{
	protected $table = 'filament_users';

	protected $casts = [
		'is_admin' => 'bool',
		'roles' => 'json'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'avatar',
		'email',
		'is_admin',
		'name',
		'password',
		'roles',
		'remember_token'
	];
}
