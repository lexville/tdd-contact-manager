<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile_number',
    ];

    /**
     * Eloquest relationship linking contacts to users
     *
     *  @return Eloquesnt relationship
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePersonalize()
    {
        if (Auth::check()) {
            return self::where('user_id', Auth::user()->id);
        }
    }
}
