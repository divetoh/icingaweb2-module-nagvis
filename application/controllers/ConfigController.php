<?php

use Icinga\Web\Controller\ModuleActionController;
use Icinga\Module\Nagvis\Forms\Config\BackendConfigForm;

class Nagvis_ConfigController extends ModuleActionController
{

    public function indexAction()
    {
        $form = new BackendConfigForm();
        $form->setIniConfig($this->Config());
        $form->handleRequest();

        $this->view->form = $form;
        $this->view->tabs = $this->Module()->getConfigTabs()->activate('Nagvis');
    }
}
