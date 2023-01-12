<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = ['description', 'status'];

    public $statusOptions = [
        'P' => 'Pendente, Aguardando Professor',
        'A' => 'Aguardando aluno',
        'C' => 'Finalizado'
    ];
}
