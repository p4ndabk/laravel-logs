<?php

namespace App\Domain;

class EmailService implements EmailInterface
{
    public function sendEmail(string $email, string $message)
    {
        // Send email
        dd($email, $message);
    }  
}