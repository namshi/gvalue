<?php

namespace Namshi\Exception;


class DocumentRetrievalException extends \Exception
{
    const MESSAGE = 'Document "%s" could not be retrieved at "%s", server returned a %s error';

    public function __construct($docId, $url, $message)
    {
        $this->message = sprintf(static::MESSAGE, $docId, $url, $message);
    }
} 