<?php
/*
 * @version $Id: HEADER 15930 2011-10-30 15:47:55Z tsmr $
 -------------------------------------------------------------------------
 certificates plugin for GLPI
 Copyright (C) 2009-2016 by the certificates Development Team.

 https://github.com/InfotelGLPI/certificates
 -------------------------------------------------------------------------

 LICENSE
      
 This file is part of certificates.

 certificates is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 certificates is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with certificates. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

include ('../../../inc/includes.php');

$plugin = new Plugin();
if ($plugin->isActivated("environment"))
   Html::header(PluginCertificatesCertificate::getTypeName(2),'',"assets","pluginenvironmentdisplay","certificates");
else
   Html::header(PluginCertificatesCertificate::getTypeName(2), '', "assets","plugincertificatesmenu");

$certif = new PluginCertificatesCertificate();
$certif->checkGlobal(READ);

if ($certif->canView()) {

   Search::show("PluginCertificatesCertificate");

} else {
   Html::displayRightError();
}

Html::footer();

?>