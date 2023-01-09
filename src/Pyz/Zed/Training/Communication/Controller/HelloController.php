<?php

namespace Pyz\Zed\Training\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

class HelloController extends AbstractController
    /**
     * @return array
     * @method \Pyz\Zed\Training\TrainingConfig getConfig()
     */

{
    /**
     * @return array
     */
    public function indexAction()
    {
        $mystore = $this->getFactory()->getConfig()->getMyDefaultStore();
        return $this->viewResponse([
            'helloWorldText' => 'Training',
            'store' => $mystore
        ]);
    }
}
