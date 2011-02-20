<?php

namespace Sensio\CasBundle\Service\Protocol;

abstract class Protocol
{
    protected $baseUri;

    public function __construct($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function getLoginUri($service)
    {
        return $this->buildUri('login', array(
            'service' => $this->cleanUri($service),
        ));
    }

    public function getLogoutUri($service)
    {
        return $this->buildUri('logout', array(
            'service' => $this->cleanUri($service),
        ));
    }

    protected function cleanUri($uri)
    {
        $replacements = array(
            '/\?logout/'        => '',
            '/&ticket=[^&]*/'   => '',
            '/\?ticket=[^&;]*/' => '?',
            '/\?%26/'           => '?',
            '/\?&/'             => '?',
            '/\?$/'             => ''
        );

        return preg_replace(array_keys($replacements), array_values($replacements), $uri);
    }

    protected function buildUri($action, array $parameters = array())
    {
        $query = array();

        foreach($parameters as $key => $value) {
            if($value === true) {
                $query[] = $key.'=true';
            } elseif($value) {
                $query[] = $key.'='.urlencode($value);
            }
        }

        return $this->baseUri.'/'.$action.(count($query) ? '?'.implode('&', $query) : '');
    }
}