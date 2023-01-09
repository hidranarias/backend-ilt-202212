<?php

namespace Pyz\Zed\Training\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Training\Persistence\TrainingPersistenceFactory getFactory()
 */
class TrainingRepository extends AbstractRepository implements TrainingRepositoryInterface
{
    public function findAntelope(AntelopeCriteriaTransfer $antelopeCriteria): ?AntelopeTransfer
    {
        $idAntelope = $antelopeCriteria->getIdAntelope();
        $name = $antelopeCriteria->getName();
        if (!$idAntelope && !$name) {
            return null;
        }
        $antelopeQuery = $this->getFactory()
            ->createAntelopeQuery();

        if ($idAntelope !== null) {
            $antelopeQuery = $antelopeQuery->filterByIdAntelope($idAntelope);
        } else {
            $antelopeQuery = $antelopeQuery->filterByName($name);
        }

        $antelopeEntity = $antelopeQuery->findOne();

        if (!$antelopeEntity) {
            return null;
        }

        $antelopeTransfer = new AntelopeTransfer();
        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }
}
