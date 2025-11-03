<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee_photos extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'photo_path',
        'isCurrent',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employees::class);
    }
}
