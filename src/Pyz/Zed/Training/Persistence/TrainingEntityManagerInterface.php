<?php

namespace Pyz\Zed\Training\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;

interface TrainingEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;
}
