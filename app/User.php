<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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


    public function routeNotificationForSlack($notification){
        return env('SLACK_WEBHOOK_URL', 'https://hooks.slack.com/services/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');
    }
}
