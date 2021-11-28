<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    use HasFactory, HasRelationships;
    protected $table = 'add_info';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'd_name',
        'img',
        'location',
        'bio',
        'dark_mode',
        'bg_img'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
