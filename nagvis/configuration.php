<?php

$this->provideConfigTab('Nagvis', array(
    'title' => 'Nagvis',
    'url' => 'config'
));


$section = $this->menuSection($this->translate('Nagvis'), array(
    'title'    => 'Nagvis',
    'icon'     => 'img/nagvis/icons/nagvis.png',
    'url'      => 'nagvis',
    'priority' => 20
));
