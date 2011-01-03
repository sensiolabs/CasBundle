<?php

namespace Bundle\Sensio\CasBundle\Service;

use Bundle\Sensio\CasBundle\Service\Protocole\V1Protocole;
use Bundle\Sensio\CasBundle\Service\Protocole\V2Protocole;

use Bundle\Sensio\CasBundle\Service\Request\CurlRequest;
use Bundle\Sensio\CasBundle\Service\Request\HttpRequest;
use Bundle\Sensio\CasBundle\Service\Request\FileRequest;

use Bundle\Sensio\CasBundle\Service\Response\V1Response;
use Bundle\Sensio\CasBundle\Service\Response\V2Response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Cas
{
    protected
        $protocole,
        $version,
        $certFile,
        $requestType;

    public function __construct($baseUri, $version = 2, $certFile = null, $requestType = 'curl')
    {
        $this->version = $version;
        $this->certFile = $certFile;
        $this->requestType = $requestsType;
        $this->protocole = $this->getProtocole($baseUri, $version);
    }

    public function getValidation(Request $request)
    {
        $uri = $this->protocole->getValidationUri($request->getUri(), $request->query->get('ticket'));

        return $this->getRequest($uri)
            ->setCertFile($this->certFile)
            ->send($this->getResponse())
            ->getResponse();
    }

    public function getLogoutResponse(Request $request)
    {
        $uri = $this->protocole->getLogoutUri($request->getUri());

        $response = new Response();
        $response->setRedirect($uri);

        return $response;
    }

    public function getLoginResponse(Request $request)
    {
        $uri = $this->protocole->getLoginUri($request->getUri());

        $response = new Response();
        $response->setRedirect($uri);

        return $response;
    }

    public function isValidationRequest(Request $request)
    {
        return $request->query->has('ticket');
    }

    protected function getProtocole($baseUri)
    {
        switch((int)$this->version) {
            case 1: return new V1Protocole($baseUri);
            case 2: return new V2Protocole($baseUri);
            default: throw new \Exception('Invalid CAS version : '.(string)$this->version);
        }
    }

    protected function getResponse()
    {
        switch((int)$this->version) {
            case 1: return new V1Response();
            case 2: return new V2Response();
            default: throw new \Exception('Invalid CAS version : '.(string)$this->version);
        }
    }

    protected function getRequest($uri)
    {
        switch(strtolower($this->requestType))
        {
            case 'curl': return new CurlRequest($uri);
            case 'http': return new HttpRequest($uri);
            case 'file': return new FileRequest($uri);
            default: throw new \Exception('Invalid CAS request type : '.(string)$this->requestType);
        }
    }

}