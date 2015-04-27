<?php

use Icinga\Web\Controller\ModuleActionController;

class Nagvis_IndexController extends ModuleActionController
{

    public function indexAction() {
        $this->view->url = $this->config()->get('nagvis','nagvis_url','');
        $this->view->map = $this->params->get('map');
        if ($this->view->map!=""){
            $this->view->map_get = '?map='.$this->params->get('map');
        } else {
            $this->view->map_get = '';
        }
    }
}
