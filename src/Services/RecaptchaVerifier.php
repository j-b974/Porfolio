<?php

namespace Berti\Porfolio\Services;

class RecaptchaVerifier
{
    const RECAPTCHA_URL = 'https://www.google.com/recaptcha/api/siteverify';

    public static function verify($jetonRecaptcha)
    {
        $data = [
            'secret' => $_ENV['KEY_SECRET_RECAPTCHA'],
            'response' => $jetonRecaptcha
        ];

        // Configuration de la requête cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::RECAPTCHA_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception("Erreur cURL: " . $error);
        }

        curl_close($ch);

        if ($httpCode !== 200) {
            throw new Exception("Erreur HTTP: " . $httpCode);
        }

        $response = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Erreur lors du décodage JSON: " . json_last_error_msg());
        }

        return $response;
    }

}