<?php

namespace Icinga\Module\Nagvis\Forms\Config;

use Icinga\Web\Notification;
use Icinga\Forms\ConfigForm;

class BackendConfigForm extends ConfigForm
{
    public function init()
    {
        $this->setName('form_config_nagvis_backend');
        $this->setSubmitLabel(mt('nagvis', 'Save Changes'));
    }

    public function onSuccess()
    {
        $this->config->setSection('nagvis', $this->getValues());

        if ($this->save()) {
            Notification::success(mt('nagvis', 'New Nagvis URL stored'));
        } else {
            return false;
        }
    }

    public function onRequest()
    {
        $this->populate($this->config->getSection('nagvis')->toArray());
    }

    public function createElements(array $formData)
    {
        $this->addElement(
            'text',
            'nagvis_url',
            array(
                'allowEmpty'    => true,
                'value'         => 'http://url/',
                'label'         => mt('nagvis', 'Nagvis URL'),
                'description'   => mt('nagvis', 'URL to Nagvis web-interface. Example: http://monitoring/nagvis/')
            )
        );
    }
}
