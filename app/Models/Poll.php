<?php

namespace App\Models;

use App\Models\Vote;
use App\Models\Choice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory;

    public function choices() {
        return $this->hasMany(Choice::class);
    }
    
    public function votes() {
        return $this->hasMany(Vote::class);
    }
}
