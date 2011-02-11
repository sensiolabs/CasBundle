<?php

namespace Sensio\CasBundle\Service\Response;

use Sensio\CasBundle\Service\Response\Response;
use Sensio\CasBundle\Service\Response\ResponseInterface;

class V2Response extends Response implements ResponseInterface
{
    public function setBody($body)
    {
        if($body === false) {
            $this->failureMessage = 'Request failed';
            $this->success = false;
            return $this;
        }

        $xml = new \DOMDocument();
        if($xml->loadXML($body)) {

            foreach($xml->firstChild->childNodes as $child) {
                if($child->nodeName === 'cas:authenticationSuccess') {
                    $root = $child;
                    $this->success = true;
                    break;
                } elseif($child->nodeName === 'cas:authenticationFailure') {
                    $root = $child;
                    $this->success = false;
                    break;
                }
            }

            if($this->success) {
                foreach($root->childNodes as $child) {
                    switch($child->nodeName) {

                        case 'cas:user':
                            $this->username = $child->textContent;
                            break;

                        case 'cas:attributes':
                            foreach($child->childrenNodes as $attr) {
                                if($attr->nodeName != '#text') {
                                    $this->attributes[$attr->nodeName] = $attr->textContent;
                                }
                            }
                            break;

                        case 'cas:attribute':
                            $name = $child->attributes->getNamedItem('name')->value;
                            $value = $child->attributes->getNamedItem('value')->value;
                            if($name && $value) {
                                $this->attributes[$name] = $value;
                            }
                            break;

                        case '#text':
                            break;

                        default:
                            $this->attributes[substr($child->nodeName, 4)] = $child->textContent;
                    }
                }
            } else {
                $this->failureMessage = (string)$root->textContent;
            }

        } else {
            $this->success = false;
            $this->failureMessage = 'Invalid response';
        }

        return $this;
    }
}