<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function role_permission()
    {
        return $this->hasMany('App\Models\User\Role\Role_Permission','role_id', 'id');
    }
}
