<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\Form;

use SprykerShop\Yves\CustomerPage\Form\FormFactory as SprykerFormFactory;
use Symfony\Component\Form\FormInterface;

class FormFactory extends SprykerFormFactory
{
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getProfileForm(): FormInterface
    {
        return $this->getFormFactory()->create(ProfileForm::class);
    }
}
