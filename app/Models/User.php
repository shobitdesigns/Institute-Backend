<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Leave;
use App\Models\Module;
use App\Models\Attendance;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    // show roles

    public function showRoles()
    {
        if($this->roles->isEmpty())
        {
            return "N/A";
        }
        $roles  =   $this->roles->pluck("name","name")->toArray();
        return implode(",",$roles);

    }

    // Policies check functions
    public function hasRole($role)
    {
        if ($this->super_admin) {
            return true;
        }
        else if(($this->roles->where("name","admin"))->isNotEmpty() ? $this->roles->where("name","admin")->first()->name == 'admin' : false)
        {
            return true;
        }
        $roles = $this->roles->pluck('name')->toArray();
        $roles = array_map('strtolower', $roles);
        if (in_array(strtolower($role), $roles)) {
            return true;
        }
        return false;
    }

    public function hasPermission($access, $module)
    {
        if ($this->hasRole('admin') || $this->super_admin) {
            return true;
        }
        if ($this->permissionCache == null) {
            $this->permissionCache = $this->permissions();
        }
        if (Module::$moduleCache == null) {
            Module::$moduleCache = Module::all();
        }
        $module = Module::$moduleCache->where('name', $module)->first();
        if ($this->permissionCache->isNotEmpty() && !empty($module)) {
            $permissions = $this->permissionCache->where('module_id', $module->id);
            if ($permissions->isNotEmpty()) {
                $permissions = $permissions->where('name', $access);
                if ($permissions->isNotEmpty()) {
                    return true;
                }
            }
        }

        return false;
    }

    public function isVendor($user)
    {
        if(empty($user->employee_id))
        {
            return false;
        }
        $employee   =   $user->load("employee")->employee;
        if(empty($employee))
        {
            return false;
        }
        return $employee->apply_for=="vendor";
    }

    private function permissions()
    {
        return $this->roles->load('permissions')->pluck('permissions')->collapse()->map(function ($item) {
            $item->access = strtolower($item->access);
            return $item;
        });
    }

    public function document():HasOne
    {
        return $this->HasOne(Document::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaves():HasMany
    {
        return $this->hasMany(Leave::class);
    }

}
