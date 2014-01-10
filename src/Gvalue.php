<?php

namespace Namshi;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Namshi\Exception\DocumentRetrievalException;

class Gvalue extends Client
{
    const GOOGLE_DOC_URL = "https://spreadsheets.google.com/feeds/list/%s/od6/public/values?alt=json-in-script";

    public function getDocument($key)
    {
        return $this->formatContent($this->getDocumentContent($key));
    }

    protected function getDocumentContent($key)
    {
        $request = $this->get(sprintf(static::GOOGLE_DOC_URL, $key));

        try {
            return $this->send($request)->getBody(true);
        } catch (ClientErrorResponseException $e) {
            throw new DocumentRetrievalException($key, $request->getUrl(), $e->getResponse()->getStatusCode());
        }
    }

    protected function formatContent($content)
    {
        $length                         = strlen($content);
        $lengthOfInitialTextToRemove    = 28;
        $jsonContent                    = substr($content, $lengthOfInitialTextToRemove, $length - ($lengthOfInitialTextToRemove + 2));
        $arrayContent                   = json_decode($jsonContent, true);
        $keyValue                       = array();

        foreach ($arrayContent['feed']['entry'] as $entry) {
            $keyValue[$entry['gsx$key']['$t']] = $entry['gsx$value']['$t'];
        }

        return $keyValue;
    }
} 