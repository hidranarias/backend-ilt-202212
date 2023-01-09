<?php

namespace Pyz\Yves\TrainingPage\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;

/**
 * @method \Pyz\Yves\TrainingPage\TrainingPageFactory getFactory()
 */
class AntelopeController extends AbstractController
{
    public function getAction(string $name)
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopeCriteriaTransfer->setName($name);

        $antelopeResponseTransfer = $this->getFactory()
            ->getTrainingClient()
            ->findAntelope($antelopeCriteriaTransfer);

        $currentStore = $this->getFactory()->getStoreClient()->getCurrentStore();
        return $this->view(
            [
                'antelope' => $antelopeResponseTransfer->getAntelope(),
                'store' => $currentStore
            ],

            [],
            '@TrainingPage/views/antelope/get.twig'
        );
    }
}
