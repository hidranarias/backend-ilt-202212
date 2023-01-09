<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Training\Business\Reader;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Pyz\Zed\Training\Persistence\TrainingRepositoryInterface;

class AntelopeReader
{
    protected TrainingRepositoryInterface $trainingRepository;

    public function __construct(TrainingRepositoryInterface $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    public function findAntelope(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeResponseTransfer
    {
        $antelopeTransfer = $this->trainingRepository
            ->findAntelope($antelopeCriteria);

        $antelopeResponseTransfer = new AntelopeResponseTransfer();
        $antelopeResponseTransfer
            ->setIsSuccessful(false);

        if ($antelopeTransfer) {
            $antelopeResponseTransfer
                ->setAntelope($antelopeTransfer)
                ->setIsSuccessful(true);
        }

        return $antelopeResponseTransfer;
    }
}
