<?php

namespace Pyz\Zed\Training\Persistence;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class TrainingPersistenceFactory extends AbstractPersistenceFactory
{
    public function createAntelopeQuery(): PyzAntelopeQuery
    {
        return PyzAntelopeQuery::create();
    }
}
