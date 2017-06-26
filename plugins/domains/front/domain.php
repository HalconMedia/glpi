<?php
/*
 * @version $Id: HEADER 15930 2011-10-30 15:47:55Z tsmr $
 -------------------------------------------------------------------------
 domains plugin for GLPI
 Copyright (C) 2009-2016 by the domains Development Team.

 https://github.com/InfotelGLPI/domains
 -------------------------------------------------------------------------

 LICENSE
      
 This file is part of domains.

 domains is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 domains is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with domains. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

include ('../../../inc/includes.php');

$plugin = new Plugin();
if ($plugin->isActivated("environment"))
   Html::header(PluginDomainsDomain::getTypeName(2),'',"assets","pluginenvironmentdisplay","domains");
else
   Html::header(PluginDomainsDomain::getTypeName(2),'',"assets","plugindomainsmenu");

$domain = new PluginDomainsDomain();

if ($domain->canView() || Session::haveRight("config",CREATE)) {
      
   Search::show("PluginDomainsDomain");

} else {
   Html::displayRightError();
}

Html::footer();

?>