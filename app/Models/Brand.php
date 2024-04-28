<?php

namespace App\Models;

use App\Models\Firmware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relation to Firmware Model
    public function firmware(): HasMany {
        return $this->hasMany(Firmware::class);
    }
}
