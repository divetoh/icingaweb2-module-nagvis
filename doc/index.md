# icingaweb2-module-nagvis

## Overview

Little module for icingaweb2, to show nagvis in iframe:

## Install

- Copy 'nagvis' to incingaweb2 modules directory (e.g. /srv/icinga_web2/modules/)
- Open incingaweb2 in browser, go to system\modules menu, enable nagvis module
- In module configuration tab set URL of your nagvis interface

## NagVis configuration

### Link to object configuration

You need to set correct url for hosts, services, hostgroups and service groups in nagvis configuration. Parameter 'urltarget' must be set to "_parent", otherwise icinga web interface will be open inside the frame.

Configuration example:
````
    hosturl="/icingaweb2/monitoring/host/show?host=[host_name]"
    hostgroupurl="/icingaweb2/monitoring/list/hosts?hostgroup=[hostgroup_name]"
    serviceurl="/icingaweb2/monitoring/service/show?host=[host_name]&service=[service_description]"
    servicegroupurl="/icingaweb2/monitoring/list/services?servicegroup=servicegroup_name"
    urltarget="_parent"
````
### Autentication

You can configure nagvis web-interface for access without autentication.

Example for apache:
````
    Listen 80
    Listen 81
    <VirtualHost *:80>
      <location /nagvis>
        RequestHeader set Cookie "nagvis_session=1"
        SetEnv REMOTE_USER guest
      </location>
    </VirtualHost>
````
With this config:
* http://monitoring/nagvis - automaticaly sign in with user 'guest'
* http://monitoring:81/nagvis - show login window

Note:
If nagvis and incingaweb2 have same ip and port, then browser url will be changed after opening any nagvis map, so you will have direct link to map. 

### Hide menu

There is no way to hide nagvis menu for one user (or i'm don't find it?). You can patch source code, in files:
* /usr/share/nagvis/share/frontend/nagvis-js/classes/FrontendModMap.php
* /usr/share/nagvis/share/frontend/nagvis-js/classes/FrontendModOverview.php
* /usr/share/nagvis/share/frontend/nagvis-js/classes/FrontendModUrl.php

Replace:
````
    $INDEX->setHeaderMenu($HEADER->__toString());
````
With:
````
    global $AUTH;
    if ($AUTH->getUser()!='guest') $INDEX->setHeaderMenu($HEADER->__toString());
````
Note: This is actual for nagvis version 1.7.10.