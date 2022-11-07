<?php

namespace Pyz\Yves\CustomerPage;

use Pyz\Client\Training\TrainingClientInterface;
use Pyz\Yves\CustomerPage\Form\FormFactory;
use Pyz\Yves\CustomerPage\Form\Transformer\AntelopeTransformer;
use SprykerShop\Yves\CustomerPage\CustomerPageFactory as SprykerCustomerPageFactory;

class CustomerPageFactory extends SprykerCustomerPageFactory
{
    public function getTrainingClient(): TrainingClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_TRAINING);
    }

    public function createAntelopeTransformer(): AntelopeTransformer
    {
        return new AntelopeTransformer(
            $this->getTrainingClient()
        );
    }

    public function createCustomerFormFactory(): FormFactory
    {
        return new FormFactory();
    }
}
