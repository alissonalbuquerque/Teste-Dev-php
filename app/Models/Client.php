<?php

namespace App\Models;

use App\Helpers\Formatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'phone',
        'cep',
        'address',
    ];

    public function getCpfFormattedAttribute() : string {
        return Formatter::format_cpf($this->cpf);
    }

    public function getPhoneFormattedAttribute() : string {
        return Formatter::format_phone($this->phone);
    }

    public function getCepFormattedAttribute() : string {
        return Formatter::format_cep($this->cep);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
