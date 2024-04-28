<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Firmware extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relation to Brand Model
    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }

    // Relation to DeviceCategory Model
    public function deviceCategory(): BelongsTo {
        return $this->belongsTo(DeviceCategory::class);
    }
}
