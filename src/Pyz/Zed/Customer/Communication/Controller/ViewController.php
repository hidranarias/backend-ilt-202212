<?php

namespace Pyz\Zed\Customer\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Spryker\Zed\Customer\Communication\Controller\ViewController as SprykerViewController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Customer\Communication\CustomerCommunicationFactory getFactory()
 */
class ViewController extends SprykerViewController
{
    public function indexAction(Request $request)
    {
        $response = parent::indexAction($request);

        if (!is_array($response)) {
            return $response;
        }

        if (!isset($response['customer']) || !$response['customer']->getFkAntelope()) {
            return $response;
        }

        $response['antelope'] = $this->getFactory()
            ->getTrainingFacade()
            ->findAntelope((new AntelopeCriteriaTransfer())->setIdAntelope($response['customer']->getFkAntelope()))
            ->getAntelope();

        return $response;
    }
}
