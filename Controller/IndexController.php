<?php

namespace Controller;

require_once("Lib/MoteurTemplate/RenderTamplate.php");
require_once('DBM/category.php');
require_once('Manager/DBManager.php');

/**
 * Description of IndexController
 *
 * @author josio
 */
class IndexController extends \Lib\MoteurTemplate\RenderTamplate
{

    public function indexAction()
    {
        $this->renderView('View/index.php');
    }

}
