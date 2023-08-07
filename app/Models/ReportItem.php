<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportItem extends Model
{
    use HasFactory, SoftDeletes;
    function reportDate()
    {
        return $this->belongsTo(ReportDate::class);
    }
    function users()
    {
        return $this->belongsTo(User::class);
    }
}