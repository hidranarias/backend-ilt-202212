<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Training\Communication\Controller;

use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Pyz\Zed\Training\Business\TrainingFacadeInterface getFacade()
 * @method \Pyz\Zed\Training\Persistence\TrainingRepositoryInterface getRepository()
 */
class HelloController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $antelopeTransfer = new AntelopeTransfer();
        $antelopeTransfer->setName('Oskar');

        return $this->viewResponse([
            'antelope' => $antelopeTransfer,
        ]);
    }
}
