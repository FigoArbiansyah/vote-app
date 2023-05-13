<?php

namespace App\Models;

use App\Models\Poll;
use App\Models\User;
use App\Models\Choice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function polls() {
        return $this->belongsTo(Poll::class);
    }

    public function choices() {
        return $this->belongsTo(Choice::class);
    }
}
