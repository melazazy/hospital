<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table = 'medicines';
    protected $primaryKey = 'id';
    protected $fillable =['name','code','Medicine_price','start_quantity','limit_quant'];

    public function trans()
    {
        return $this->hasOne(Transaction::class,'med_id');
    }
}
