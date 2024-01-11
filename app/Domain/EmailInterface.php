<?php 

namespace App\Domain;

interface EmailInterface
{
    public function sendEmail(string $email, string $message);
}