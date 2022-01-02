<?php

namespace SimpleSAML\XML\Exception;

use RuntimeException;

/**
 * Class IOException
 *
 * This exception is thrown when an I/O operation cannot be handled
 *
 * @package simplesamlphp/xml-common
 */
class IOException extends RuntimeException
{
    /**
     * @param string|null $message
     */
    public function __construct(?string $message = null)
    {
        parent::__construct($message ?: 'Generic I/O Exception.');
    }
}
