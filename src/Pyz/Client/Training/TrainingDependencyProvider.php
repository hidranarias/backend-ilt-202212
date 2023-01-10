<?php

namespace Pyz\Client\Training;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class TrainingDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        return $this->addZedRequestClient($container);
    }

    protected function addZedRequestClient(Container $container)
    {
        $container->set(static::CLIENT_ZED_REQUEST, static function (Container $container) {
            return $container->getLocator()->zedRequest()->client();
        });

        return $container;
    }
}
