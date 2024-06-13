<?php

namespace App\Exceptions;

use Exception;

class BelowZeroTabungan extends Exception
{
    // Pesan default untuk exception ini
    protected $message = 'Saldo tidak boleh di bawah nol.';

    // Konstruktor untuk menetapkan pesan exception
    public function __construct($message = null, $code = 500, Exception $previous = null)
    {
        // Jika pesan tidak diberikan, gunakan pesan default
        if ($message === null) {
            $message = $this->message;
        }
        
        // Panggil konstruktor induk
        parent::__construct($message, $code, $previous);
    }
}