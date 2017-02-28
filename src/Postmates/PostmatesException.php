<?php

namespace Postmates;

use Exception;

/**
 * Handles Postmates Errors
 * @package Postmates
 */
class PostmatesException extends \Exception
{
    /**
     * Invalid request params
     *
     * @var array
     */
    protected $invalid_params;

    /**
     * Postmates_Exception constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param array $invalid_params
     */
    public function __construct($message = "", $code = 0, Exception $previous = null, array $invalid_params = [])
    {
        parent::__construct($message, $code, $previous);

        if( !empty($invalid_params) ) {

            $this->invalid_params = $invalid_params;

        }

    }

    /**
     * @return array
     */
    public function getInvalidParams()
    {

        return $this->invalid_params;

    }

}