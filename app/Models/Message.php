<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $fillable =['from_u_id','to_u_id','subject','body','date','isRead','isStarred'];

    public function sender()
    {
        return $this->belongsTo(User::class,'from_u_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class,'to_u_id');
    }

}
