<?php

namespace App\Helpers;

class Formatter
{
    public static function format_cpf($cpf) : string
    {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
    }

    public static function format_phone($phone) : string
    {
        if (strlen($phone) === 11) {
            return preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $phone);
        }

        return preg_replace("/(\d{2})(\d{4})(\d{4})/", "($1) $2-$3", $phone);
    }

    public static function format_cep($cep) : string
    {
        return preg_replace("/(\d{5})(\d{3})/", "$1-$2", $cep);
    }
}
