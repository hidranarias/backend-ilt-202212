<?php

namespace Pyz\Yves\TrainingPage;

use Pyz\Client\Training\TrainingClientInterface;
use Spryker\Client\Store\StoreClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class TrainingPageFactory extends AbstractFactory
{
    public function getTrainingClient(): TrainingClientInterface
    {
        return $this->getProvidedDependency(TrainingPageDependencyProvider::CLIENT_TRAINING);
    }

    public function getStoreClient(): StoreClientInterface
    {
        return $this->getProvidedDependency(TrainingPageDependencyProvider::CLIENT_STORE);
    }
}
