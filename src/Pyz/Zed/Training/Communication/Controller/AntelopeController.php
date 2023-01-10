<?php

namespace Pyz\Zed\Training\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Training\Business\TrainingFacadeInterface getFacade()
 */
class AntelopeController extends AbstractController
{
    public function addAction(Request $request): array
    {
        $antelopeTransfer = new AntelopeTransfer();
        $name = $request->get('name');
        $antelopeTransfer->setName($name);
        if ($name) {
            $antelopeResponseTransfer = $this->getFacade()
                ->findAntelope((new AntelopeCriteriaTransfer())->setName($antelopeTransfer->getName()));

            if (!$antelopeResponseTransfer->getAntelope()) {
                $antelopeTransfer = $this->getFacade()
                    ->createAntelope($antelopeTransfer);
            }
        }

        return $this->viewResponse([
            'antelope' => $antelopeTransfer,
        ]);
    }
}
