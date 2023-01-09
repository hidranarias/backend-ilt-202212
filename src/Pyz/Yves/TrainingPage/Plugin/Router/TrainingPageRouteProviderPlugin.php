<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\TrainingPage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class TrainingPageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    /**
     * @var string
     */
    public const ROUTE_NAME_TRAINING_ANTELOPE_NAME = 'training/antelope/_name_';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        return $this->addTrainingAntelopeGetRoute($routeCollection);
    }

    private function addTrainingAntelopeGetRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('training/antelope/{name}', 'TrainingPage', 'Antelope', 'getAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_TRAINING_ANTELOPE_NAME, $route);

        return $routeCollection;
    }
}
