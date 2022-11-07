<?php

namespace Pyz\Zed\Customer\Communication;

use Pyz\Zed\Customer\CustomerDependencyProvider;
use Pyz\Zed\Training\Business\TrainingFacadeInterface;
use Spryker\Zed\Customer\Communication\CustomerCommunicationFactory as SprykerCustomerCommunicationFactory;

class CustomerCommunicationFactory extends SprykerCustomerCommunicationFactory
{
    public function getTrainingFacade(): TrainingFacadeInterface
    {
        return $this->getProvidedDependency(CustomerDependencyProvider::FACADE_TRAINING);
    }

}
