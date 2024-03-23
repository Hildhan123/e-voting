<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = ['election_id', 'name','gender', 'photo', 'visi_misi', 'votes_count'];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }
}
