<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = array(
        'name', 'host', 'port', 'api_token', 'whm_user', 'is_https', 'team_id'
    );

    /**
     * Access the Accounts object attached to the server.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts () {
        return $this->hasMany('App\Account');
    }

    /**
     * Access the Teams object attached to the server.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams() {
        return $this->belongsToMany('App\Team');
    }
}
