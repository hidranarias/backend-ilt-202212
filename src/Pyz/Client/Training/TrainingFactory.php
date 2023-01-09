<?php

namespace Pyz\Client\Training;

use Pyz\Client\Training\Stub\TrainingStub;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class TrainingFactory extends AbstractFactory
{
    public function createTrainingStub(): TrainingStub
    {
        return new TrainingStub(
            $this->getZedRequestClient()
        );
    }

    public function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
