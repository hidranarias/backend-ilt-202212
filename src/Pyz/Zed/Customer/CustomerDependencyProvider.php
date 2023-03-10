<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Customer;

use Spryker\Shared\Newsletter\NewsletterConstants;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\Customer\AvailabilityNotificationSubscriptionCustomerTransferExpanderPlugin;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\CustomerAnonymizer\AvailabilityNotificationAnonymizerPlugin;
use Spryker\Zed\Customer\CustomerDependencyProvider as SprykerCustomerDependencyProvider;
use Spryker\Zed\CustomerGroup\Communication\Plugin\CustomerAnonymizer\RemoveCustomerFromGroupPlugin;
use Spryker\Zed\CustomerUserConnector\Communication\Plugin\CustomerTransferUsernameExpanderPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Newsletter\Communication\Plugin\CustomerAnonymizer\CustomerUnsubscribePlugin;

class CustomerDependencyProvider extends SprykerCustomerDependencyProvider
{
    /**
     * @var string
     */
    public const PYZ_SALES_FACADE = 'sales facade';

    /**
     * @var string
     */
    public const PYZ_NEWSLETTER_FACADE = 'newsletter facade';
    /**
     * @var string
     */
    public const FACADE_TRAINING = 'FACADE_TRAINING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container->set(static::PYZ_SALES_FACADE, function (Container $container) {
            return $container->getLocator()->sales()->facade();
        });

        $container->set(static::PYZ_NEWSLETTER_FACADE, function (Container $container) {
            return $container->getLocator()->newsletter()->facade();
        });

        return $this->addTrainingFacade($container);
    }

    /**
     * @return \Spryker\Zed\Customer\Dependency\Plugin\CustomerAnonymizerPluginInterface[]
     */
    protected function getCustomerAnonymizerPlugins(): array
    {
        return [
            new CustomerUnsubscribePlugin([
                NewsletterConstants::DEFAULT_NEWSLETTER_TYPE,
            ]),
            new RemoveCustomerFromGroupPlugin(),
            new AvailabilityNotificationAnonymizerPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\Customer\Dependency\Plugin\CustomerTransferExpanderPluginInterface[]
     */
    protected function getCustomerTransferExpanderPlugins(): array
    {
        return [
            new CustomerTransferUsernameExpanderPlugin(),
            new AvailabilityNotificationSubscriptionCustomerTransferExpanderPlugin(),
        ];
    }

    protected function addTrainingFacade(Container $container): Container
    {
        $container->set(static::FACADE_TRAINING, function (Container $container) {
            return $container->getLocator()->training()->facade();
        });

        return $container;
    }
}
