<?php

namespace NethServer\Module\UpgradeTool;

/*
 * Copyright (C) 2018 Nethesis S.r.l.
 * http://www.nethesis.it - nethserver@nethesis.it
 *
 * This script is part of NethServer.
 *
 * NethServer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License,
 * or any later version.
 *
 * NethServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with NethServer.  If not, see COPYING.
 */

 use Nethgui\System\PlatformInterface as Validate;

 /**
  * @author Davide Principi <davide.principi@nethesis.it>
  */
class Reboot extends \Nethgui\Controller\AbstractController
{
    public function process()
    {
        parent::process();
        if($this->getRequest()->isMutation()) {
            $this->getPlatform()->exec('/usr/bin/sudo /sbin/reboot');
            sleep(3600); // long wait until the httpd-admin service is stopped
        }
    }
    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        if($this->getRequest()->isValidated()) {
            $view->getCommandList()->show();
        }
    }
}