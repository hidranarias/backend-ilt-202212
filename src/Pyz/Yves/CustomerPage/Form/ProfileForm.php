<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\Form;

use SprykerShop\Yves\CustomerPage\Form\ProfileForm as SprykerProfileForm;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageFactory getFactory()
 */
class ProfileForm extends SprykerProfileForm
{
    /**
     * @var string
     */
    public const FIELD_ANTELOPE = 'fk_antelope';

    /**
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $this->addAntelopeField($builder);
    }

    public function addAntelopeField(FormBuilderInterface $builder): self
    {
        $builder->add(self::FIELD_ANTELOPE, TextType::class, [
            'label' => 'customer.profile.antelope',
            'required' => true,
            'constraints' => [
                $this->createNotBlankConstraint(),
            ],
        ]);

        $builder->get(self::FIELD_ANTELOPE)->addModelTransformer(
            $this->getFactory()->createAntelopeTransformer()
        );

        return $this;
    }
}
