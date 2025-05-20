<?php

// app/Models/Partner.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'partner_id', 'status'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
