<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Validator;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'user';

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'username',
        'date_of_birth',
    ];

    public static function validate($user)
    {
        /*
        Rules:
            username: (string with no spaces, accepting only 1 period and 
            multiple underscore as symbol. No symbol in the beginning or end)

            date_of_birth: (date in YYYY-MM-DD format)
        */

        $validator = Validator::make($user, [
            'username' => 'regex:/^(?![_])(?!.*[_]$)([^.]*\.?[^.]*)[a-zA-Z0-9_]+$/',
            'date_of_birth' => 'date_format:Y-m-d'
        ]);

        return $validator;
    }
}
