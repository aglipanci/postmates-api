<?php

namespace Postmates;

class PostmatesWebHook
{

    protected $signature_secret;

    public function __construct(\string $signature_secret = '')
    {
        $this->signature_secret = $signature_secret;
    }

    /**
     * Parse and validate webhook request
     *
     * @return mixed|null
     */
    public function parseRequest()
    {

        $raw_request = file_get_contents('php://input');
        $postmates_signature = $_SERVER['HTTP_X_POSTMATES_SIGNATURE'];

        if ($this->validateRequest($raw_request, $postmates_signature)) {
            return json_decode($raw_request, true);
        }

        return null;

    }

    /**
     * Validate Postmates request with te provided signature secret
     *
     * @param $payload
     * @param $key
     * @return bool
     */
    public function validateRequest($payload, $key)
    {

        return hash_hmac('sha256', $payload, $this->signature_secret) == $key;

    }

}