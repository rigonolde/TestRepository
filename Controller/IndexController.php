<?php

namespace Controller;

require_once($_SERVER["DOCUMENT_ROOT"] . "/Lib/MoteurTemplate/RenderTamplate.php");
require_once($_SERVER["DOCUMENT_ROOT"] . '/DBM/category.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/Manager/DBManager.php');

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
