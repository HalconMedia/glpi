<?php
/*
 * @version $Id: HEADER 15930 2011-10-30 15:47:55Z tsmr $
 -------------------------------------------------------------------------
 financialreports plugin for GLPI
 Copyright (C) 2009-2016 by the financialreports Development Team.

 https://github.com/InfotelGLPI/financialreports
 -------------------------------------------------------------------------

 LICENSE
      
 This file is part of financialreports.

 financialreports is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 financialreports is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with financialreports. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

function plugin_financialreports_install() {
   global $DB;
   
   include_once (GLPI_ROOT."/plugins/financialreports/inc/profile.class.php");
   
   $update=false;
   if (!TableExists("glpi_plugin_state_profiles") 
            && !TableExists("glpi_plugin_financialreports_configs")) {
      
      $DB->runFile(GLPI_ROOT ."/plugins/financialreports/sql/empty-2.3.0.sql");

   } else if (TableExists("glpi_plugin_state_parameters") 
            && !FieldExists("glpi_plugin_state_parameters","monitor")) {
      
      $update=true;
      $DB->runFile(GLPI_ROOT ."/plugins/financialreports/sql/update-1.5.sql");
      $DB->runFile(GLPI_ROOT ."/plugins/financialreports/sql/update-1.6.0.sql");
      $DB->runFile(GLPI_ROOT ."/plugins/financialreports/sql/update-1.7.0.sql");

   } else if (TableExists("glpi_plugin_state_profiles") 
            && FieldExists("glpi_plugin_state_profiles","interface")) {
      
      $update=true;
      $DB->runFile(GLPI_ROOT ."/plugins/financialreports/sql/update-1.6.0.sql");
      $DB->runFile(GLPI_ROOT ."/plugins/financialreports/sql/update-1.7.0.sql");

   } else if (!TableExists("glpi_plugin_financialreports_configs")) {
      
      $update=true;
      $DB->runFile(GLPI_ROOT ."/plugins/financialreports/sql/update-1.7.0.sql");

   }
   
   if ($update) {
      
      //Do One time on 0.78
      $query_="SELECT *
            FROM `glpi_plugin_financialreports_profiles` ";
      $result_=$DB->query($query_);
      if ($DB->numrows($result_)>0) {

         while ($data=$DB->fetch_array($result_)) {
            $query="UPDATE `glpi_plugin_financialreports_profiles`
                  SET `profiles_id` = '".$data["id"]."'
                  WHERE `id` = '".$data["id"]."';";
            $result=$DB->query($query);

         }
      }
      
      $query="ALTER TABLE `glpi_plugin_financialreports_profiles`
               DROP `name` ;";
      $result=$DB->query($query);
      
      Plugin::migrateItemType(
         array(3450=>'PluginFinancialreportsDisposalItem'),
         array("glpi_bookmarks", "glpi_bookmarks_users", "glpi_displaypreferences",
               "glpi_documents_items", "glpi_infocoms", "glpi_logs", "glpi_tickets"),
         array("glpi_plugin_financialreports_disposalitems"));
   }

   //Migrate profiles to the new system
   PluginFinancialreportsProfile::initProfile();
   PluginFinancialreportsProfile::createFirstAccess($_SESSION['glpiactiveprofile']['id']);
   
   $migration = new Migration("2.3.0");
   $migration->dropTable('glpi_plugin_financialreports_profiles');
   
   //2.3.0
   if (TableExists("glpi_plugin_financialreports_disposalitems")) {
      $query_="SELECT *
            FROM `glpi_plugin_financialreports_disposalitems` ";
      $result_=$DB->query($query_);
      if ($DB->numrows($result_)>0) {

         while ($data=$DB->fetch_array($result_)) {
            $query="UPDATE `glpi_infocoms`
                  SET `decommission_date` = '".$data["date_disposal"]."'
                  WHERE `items_id` = '".$data["items_id"]."'
                        AND `itemtype` = '".$data["itemtype"]."';";
            $result=$DB->query($query);

         }
      }
   }
   $migration->dropTable('glpi_plugin_financialreports_disposalitems');
   return true;
}

function plugin_financialreports_uninstall() {
   global $DB;

   $tables = array("glpi_plugin_financialreports_configs",
               "glpi_plugin_financialreports_parameters");

   foreach($tables as $table)
      $DB->query("DROP TABLE IF EXISTS `$table`;");
   
   //old versions	
   $tables = array("glpi_plugin_financialreports_profiles",
               "glpi_plugin_state_profiles",
               "glpi_plugin_state_config",
               "glpi_plugin_state_parameters",
               "glpi_plugin_state_repelled");

   foreach($tables as $table)
      $DB->query("DROP TABLE IF EXISTS `$table`;");
   
   //Delete rights associated with the plugin
   $profileRight = new ProfileRight();
   foreach (PluginFinancialreportsProfile::getAllRights() as $right) {
      $profileRight->deleteByCriteria(array('name' => $right['field']));
   }

   PluginFinancialreportsProfile::removeRightsFromSession();
   
   return true;
}


// Define database relations
function plugin_financialreports_getDatabaseRelations() {

   $plugin = new Plugin();

   if ($plugin->isActivated("financialreports"))
      return array (
         "glpi_states" => array ("glpi_plugin_financialreports_configs" => "states_id")
      );
   else
      return array ();
}

?>