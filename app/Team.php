<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Access the Servers object attached to the team.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servers() {
        return $this->hasMany('App\Server');
    }

    /**
     * Access the Users object attached to the team.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany('App\User')->withPivot('is_admin');
    }
}
