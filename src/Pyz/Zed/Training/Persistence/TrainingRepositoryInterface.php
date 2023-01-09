<?php

namespace Pyz\Zed\Training\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface TrainingRepositoryInterface
{
    public function findAntelope(AntelopeCriteriaTransfer $antelopeCriteria): ?AntelopeTransfer;
}
