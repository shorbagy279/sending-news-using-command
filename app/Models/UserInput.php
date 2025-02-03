<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInput extends Model
{
    use HasFactory;

    protected $table = 'user_inputs';

    protected $fillable = ['name', 'email', 'interested_with', 'country'];
}

