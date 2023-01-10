<?php

namespace Pyz\Yves\CustomerPage\Form\Transformer;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Client\Training\TrainingClientInterface;
use Symfony\Component\Form\DataTransformerInterface;

class AntelopeTransformer implements DataTransformerInterface
{
    protected TrainingClientInterface $trainingClient;

    public function __construct(TrainingClientInterface $trainingClient)
    {
        $this->trainingClient = $trainingClient;
    }

    public function transform($value)
    {
        if (!$value) {
            return '';
        }

        $antelopeResponseTransfer = $this->trainingClient
            ->findAntelope((new AntelopeCriteriaTransfer())->setIdAntelope($value));

        if (!$antelopeResponseTransfer->getAntelope()) {
            return '';
        }

        return $antelopeResponseTransfer->getAntelope()->getName();
    }

    public function reverseTransform($value)
    {
        if (!$value) {
            return null;
        }

        $antelopeResponseTransfer = $this->trainingClient
            ->findAntelope((new AntelopeCriteriaTransfer())->setName($value));

        if ($antelopeResponseTransfer->getAntelope()) {
            return $antelopeResponseTransfer->getAntelope()->getIdAntelope();
        }

        $antelopeTransfer = new AntelopeTransfer();
        $antelopeTransfer->setName($value);

        return $this->trainingClient
            ->createAntelope($antelopeTransfer)->getIdAntelope();
    }
}
