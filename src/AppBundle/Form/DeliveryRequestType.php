<?php
// src/AppBundle/DataCollector/DeliveryRequest.php
namespace AppBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class DeliveryRequest extends DataCollector
{
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = array(
            'method' => $request->getMethod(),
            'acceptable_content_types' => $request->getAcceptableContentTypes(),
        );
    }

    public function getMethod()
    {
        return $this->data['method'];
    }

    public function getAcceptableContentTypes()
    {
        return $this->data['acceptable_content_types'];
    }

    public function getName()
    {
        return 'app.data_collector';
    }
}