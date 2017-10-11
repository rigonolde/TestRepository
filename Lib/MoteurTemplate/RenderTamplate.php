<?php

namespace Lib\MoteurTemplate;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RenderTamplate
 *
 * @author josio
 */
class RenderTamplate
{

    public function renderView($view, $params = array())
    {
        $pathView = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . trim($view);
        if (file_exists($pathView)) {
            foreach ($params as $key => $value) {
                ${$key} = $value;
            }
            unset($params);
            include($pathView);
        } else {
            unset($params);
            echo "Not found view" . $view;
        }
    }

    public function renderJson($data)
    {
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($data);
    }

    public function isAjax()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

}
