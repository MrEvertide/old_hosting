<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Access the Team object attached to the user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams() {
        return $this->belongsToMany('App\Team')->withPivot('is_admin');
    }

    /**
     * Method to add a user to a specified Team object.
     * Not used for now since users can only be part of 1 Team.
     * @param $team
     * @return bool
     */
    public function addToTeam($team) {
        if($this->teams()->attach($team->id) == 'NULL') {
            return false;
        }
        return true;
    }

    /**
     * Method to determine if the user has completed the setup process.
     * @return bool
     */
    public function hasCompletedSetup() {
        if (count($this->team()) == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Method to determine if the user is admin of his team.
     * @return bool
     */
    public function isTeamAdmin() {
        if ($this->team()->pivot->is_admin) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Return the user's Team
     * For now, users can only be part of a single team.
     * Later on, multi teams will be a feature.
     * @return mixed
     */
    public function team() {
        try {
            return $this->teams()->first();
        } catch (\ErrorException $ee) {
            return redirect(route('setup@createTeam'));
        } catch (\Exception $e) {
            return redirect(route('setup@createTeam'));
        }
    }
}
