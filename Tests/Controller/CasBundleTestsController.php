<?php

namespace Bundle\Sensio\CasBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CasBundleTestsController extends Controller
{
    public function serviceAction()
    {
        return $this->createResponse(get_class($this->get('cas')));
    }

    public function protectedAction()
    {
        return $this->createResponse('access granted');
    }

    public function validateV1Action()
    {
        return $this->validateAction('V1');
    }

    public function validateV2Action()
    {
        return $this->validateAction('V2');
    }

    protected function validateAction($version)
    {
        $ticket = $this->get('request')->query->get('ticket');
        $template = 'validation'.($ticket == 'success' ? 'Success' : 'Error').$version.'.twig';
        return $this->render('Sensio/CasBundle:Tests:'.$template);
    }
}