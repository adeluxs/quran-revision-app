<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevisionSession extends Model
{
    protected $fillable = [
      'name','user_id','partner_id','date','time','start_time','end_time','status,','user_name'
    ];

    // The user who requested/owns this session
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The partner they are revising with
    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }
}
