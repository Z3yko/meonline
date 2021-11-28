<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_contact extends Model
{
    use HasFactory, HasRelationships;

    protected $table = 'user_contact';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'c_email',
        'phone',
        'social',
        'website'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
