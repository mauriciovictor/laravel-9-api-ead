<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = ['name', 'description', 'imagemas '];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
