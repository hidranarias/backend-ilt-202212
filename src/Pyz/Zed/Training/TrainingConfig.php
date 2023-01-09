<?php

namespace Pyz\Zed\Training;

use Pyz\Shared\Training\TrainingConstants;

class TrainingConfig extends \Spryker\Zed\Kernel\AbstractBundleConfig
{
    public function getMyDefaultStore(): string
    {

        return $this->get(TrainingConstants::MY_DEFAULT_STORE);
    }
}
