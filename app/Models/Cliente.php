<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;
    protected $fillable = ['name','last_name','direction','country_id'];

    public function pedidos(): BelongsToMany{
        return $this->belongsToMany(Pedido::class);
    }
    
    public function country(): BelongsTo {
        return$this->belongsTo(Country::class);
}
}
