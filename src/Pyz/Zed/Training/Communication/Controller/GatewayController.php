<?php

namespace Pyz\Zed\Training\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\Training\Business\TrainingFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    public function findAntelopeAction(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeResponseTransfer
    {
        return $this->getFacade()
            ->findAntelope($antelopeCriteria);
    }

    public function createAntelopeAction(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        return $this->getFacade()
            ->createAntelope($antelopeTransfer);
    }
}
