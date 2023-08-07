<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDate extends Model
{
    use HasFactory;

    function user()
    {
        return $this->belongsTo(User::class);
    }
    function reportItems()
    {
        return $this->hasMany(ReportItem::class);
    }

    function createBy($id)
    {
        $user = User::where('id', $id)->first();
        return $user->name;
    }
}