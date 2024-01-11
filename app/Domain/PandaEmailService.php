<?php 

namespace App\Domain;

class PandaEmailService implements EmailInterface
{
    public function sendEmail(string $email, string $message)
    {
        // Send email
        dd($email, $message, 'panda');
    }
}