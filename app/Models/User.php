<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'country',
        'memorized_juz',
        'available_days',
        'available_time',
        'bio',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        
    ];

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
            'memorized_juz' => 'array',
            'available_days' => 'array',
        ];
    }

     // A user belongs to a role
     public function role()
     {
         return $this->belongsTo(Role::class);
     }
 
     // Check if the user has a specific role
     public function hasRole($role)
     {
         return $this->role->name === $role;
     }


     // march partner
     public function matchablePartners()
{
    return User::where('id', '!=', $this->id)
        ->whereJsonContains('memorized_juz', $this->memorized_juz[0]) // match by at least 1 juz
        ->whereJsonContains('available_days', $this->available_days)  // Match users with overlapping availability
        ->get();
}


public function sessions()
{
    return $this->hasMany(RevisionSession::class, 'user_id');
}

public function partnerSessions()
{
    return $this->hasMany(RevisionSession::class, 'partner_id');
}

//check for accepted partners requested by the  authenticated user only
public function acceptedPartners()
{
    return $this->belongsToMany(User::class, 'partners', 'user_id', 'partner_id')
     ->wherePivot('status', 'accepted');
}

public function receivedAcceptedPartners()
{
    return $this->belongsToMany(User::class, 'partners', 'partner_id', 'user_id')
        ->wherePivot('status', 'accepted');
}

//check for accepted partners accepted by the  authenticated user

public function sentPartnerRequests()
{
    return $this->hasMany(Partner::class, 'user_id');
}

//check for  both accepted partners accepted by the  authenticated user & accepted partners requested by the  authenticated user 

public function allAcceptedPartners()
{
    $sent = $this->acceptedPartners()->get();
    $received = $this->receivedAcceptedPartners()->get();

    return $sent->merge($received)->unique('id');
}


public function receivedPartnerRequests()
{
    return $this->hasMany(Partner::class, 'partner_id');
}


}
