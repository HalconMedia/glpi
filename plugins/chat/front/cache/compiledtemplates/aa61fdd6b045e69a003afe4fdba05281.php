<!DOCTYPE html><html lang="en" dir="ltr" ng-app="lhcApp"><head><title><?php  if (isset($Result['path'])) : ?><?php $ReverseOrder = $Result['path']; krsort($ReverseOrder); foreach ($ReverseOrder as $pathItem) : ?><?php  echo htmlspecialchars($pathItem['title']).' '?>&laquo;<?php  echo ' ';endforeach;?><?php  endif; ?><?php  echo htmlspecialchars('Live Helper Chat - live support')?></title><meta http-equiv="content-type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"><link rel="icon" type="image/png" href="/x/plugins/chat/front/design/defaulttheme/images/favicon.ico" /><link rel="shortcut icon" type="image/x-icon" href="/x/plugins/chat/front/design/defaulttheme/images/favicon.ico"><meta name="Keywords" content="" /><meta name="Description" content="" /><meta name="robots" content="noindex, nofollow"><meta name="copyright" content="Remigijus Kiminas, livehelperchat.com"><?php  if ('ltr' == 'ltr' || 'ltr' == '') : ?><link rel="stylesheet" type="text/css" href="/x/plugins/chat/front/cache/compiledtemplates/eb9f887f281d10fe4bb8e88a74722264.css" /><?php  else : ?><link rel="stylesheet" type="text/css" href="/x/plugins/chat/front/cache/compiledtemplates/11ec9313d7cd611bf4ac7c5439f74446.css" /><?php  endif;?><!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="/x/plugins/chat/front/cache/compiledtemplates/ed868cc4f0f452179fa4da29f6f20a5c.css" /><![endif]--><?php  echo isset($Result['additional_header_css']) ? $Result['additional_header_css'] : ''?><?php   ?><script type="text/javascript">var WWW_DIR_JAVASCRIPT = '/x/plugins/chat/front/index.php/site_admin/';var WWW_DIR_JAVASCRIPT_FILES = '/x/plugins/chat/front/design/defaulttheme/sound';var WWW_DIR_JAVASCRIPT_FILES_NOTIFICATION = '/x/plugins/chat/front/design/defaulttheme/images/notification';var confLH = {};<?php  $soundData = array (0 => false,'repeat_sound' => 1,'repeat_sound_delay' => 5,'show_alert' => false,'new_chat_sound_enabled' => true,'new_message_sound_admin_enabled' => true,'new_message_sound_user_enabled' => true,'online_timeout' => 300,'check_for_operator_msg' => 10,'back_office_sinterval' => 10,'chat_message_sinterval' => 3.5,'long_polling_enabled' => false,'polling_chat_message_sinterval' => 1.5,'polling_back_office_sinterval' => 5,'connection_timeout' => 30,'browser_notification_message' => false,); ?>confLH.back_office_sinterval = <?php  echo (int)($soundData['back_office_sinterval']*1000) ?>;confLH.chat_message_sinterval = <?php  echo (int)($soundData['chat_message_sinterval']*1000) ?>;confLH.new_chat_sound_enabled = <?php  echo (int)erLhcoreClassModelUserSetting::getSetting('new_chat_sound',(int)($soundData['new_chat_sound_enabled'])) ?>;confLH.new_message_sound_admin_enabled = <?php  echo (int)erLhcoreClassModelUserSetting::getSetting('chat_message',(int)($soundData['new_message_sound_admin_enabled'])) ?>;confLH.new_message_sound_user_enabled = <?php  echo (int)erLhcoreClassModelUserSetting::getSetting('chat_message',(int)($soundData['new_message_sound_user_enabled'])) ?>;confLH.new_message_browser_notification = <?php  echo isset($soundData['browser_notification_message']) ? (int)($soundData['browser_notification_message']) : 0 ?>;confLH.transLation = {'new_chat':'New chat request'};confLH.csrf_token = '<?php  echo erLhcoreClassUser::instance()->getCSFRToken()?>';confLH.repeat_sound = <?php  echo (int)$soundData['repeat_sound']?>;confLH.repeat_sound_delay = <?php  echo (int)$soundData['repeat_sound_delay']?>;confLH.show_alert = <?php  echo (int)$soundData['show_alert']?>;</script><script type="text/javascript" src="/x/plugins/chat/front/cache/compiledtemplates/463a6278d9024d3d0dd9af2b4cac63cc.js"></script><?php  echo isset($Result['additional_header_js']) ? $Result['additional_header_js'] : ''?><?php   ?></head><body ng-controller="LiveHelperChatCtrl as lhc"><?php  $currentUser = erLhcoreClassUser::instance(); ?><nav class="top-bar"><ul class="title-area"><li class="name"><h1><a href="/x/plugins/chat/front/index.php/site_admin/" title="<?php  echo htmlspecialchars('Live Helper Chat')?>"><img src="/x/plugins/chat/front/design/defaulttheme/images/general/logo.png" alt="<?php  echo htmlspecialchars('Live Helper Chat')?>" title="<?php  echo htmlspecialchars('Live Helper Chat')?>"></a></h1></li><li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li></ul><section class="top-bar-section"><ul class="right"><?php  if ($currentUser->hasAccessTo('lhchat','use')) : ?><li class="li-icon"><a href="javascript:void(0)" onclick="javascript:lhinst.chatTabsOpen()"><i class="icon-chat"></i></a></li><li class="divider"></li><li><a href="/x/plugins/chat/front/index.php/site_admin/chat/lists" >Chats list</a></li><?php  if ($currentUser->hasAccessTo('lhchat','use_onlineusers')) : ?><li><a href="/x/plugins/chat/front/index.php/site_admin/chat/onlineusers">Online visitors</a></li><?php  endif;?><li class="divider"></li><?php  endif;?><?php   $useQuestionary = $currentUser->hasAccessTo('lhquestionary','manage_questionary'); $useFaq = $currentUser->hasAccessTo('lhfaq','manage_faq'); $useChatbox = $currentUser->hasAccessTo('lhchatbox','manage_chatbox'); $useBo = $currentUser->hasAccessTo('lhbrowseoffer','manage_bo'); $useFm = $currentUser->hasAccessTo('lhform','manage_fm'); $useDoc = $currentUser->hasAccessTo('lhdocshare','manage_dc'); ?><?php  if ($useDoc || $useFm || $useBo || $useChatbox || $useFaq || $useQuestionary) : ?><li class="has-dropdown"><a href="#">Extra modules</a><ul class="dropdown"><?php  if ($useQuestionary) : ?><li><a href="/x/plugins/chat/front/index.php/site_admin/questionary/list">Questionary</a></li><?php  endif;?><?php  if ($useFaq) : ?><li><a href="/x/plugins/chat/front/index.php/site_admin/faq/list">FAQ</a></li><?php  endif;?><?php  if ($useChatbox) : ?><li><a href="/x/plugins/chat/front/index.php/site_admin/chatbox/configuration">Chatbox</a></li><?php  endif; ?><?php  if ($useBo) : ?><li><a href="/x/plugins/chat/front/index.php/site_admin/browseoffer/index">Browse offers</a></li><?php  endif; ?><?php  if ($useFm) : ?><li><a href="/x/plugins/chat/front/index.php/site_admin/form/index">Forms</a></li><?php  endif;?><?php  if ($useDoc) : ?><li><a href="/x/plugins/chat/front/index.php/site_admin/docshare/index">Documents</a></li><?php  endif; ?></ul></li><li class="divider"></li><?php  endif; ?><?php  if ($currentUser->hasAccessTo('lhsystem','use')) : ?><li class="li-icon"><a href="/x/plugins/chat/front/index.php/site_admin/system/configuration"><i class="icon-tools"></i></a></li><?php  endif; ?><?php  $hideULSetting = true;?><?php $soundData = erLhcoreClassModelChatConfig::fetch('sync_sound_settings')->data; $soundMessageEnabled = erLhcoreClassModelUserSetting::getSetting('chat_message',(int)($soundData['new_message_sound_admin_enabled'])); $soundNewChatEnabled = erLhcoreClassModelUserSetting::getSetting('new_chat_sound',(int)($soundData['new_chat_sound_enabled'])); $canChangeOnlineStatus = false; $currentUser = erLhcoreClassUser::instance(); if ( $currentUser->hasAccessTo('lhuser','changeonlinestatus') ) { $canChangeOnlineStatus = true; if ( !isset($UserData) ) { $UserData = $currentUser->getUserData(true); } } $canChangeVisibilityMode = false; if ( $currentUser->hasAccessTo('lhuser','changevisibility') ) { $canChangeVisibilityMode = true; if ( !isset($UserData) ) { $UserData = $currentUser->getUserData(true); } } ?><?php  if ($currentUser->hasAccessTo('lhchat','use') ) : ?><?php  if (!isset($hideULSetting)) : ?><ul class="no-bullet inline-list user-settings-list"><?php  endif;?><li class="li-icon"><a href="#"><i class="icon-sound<?php  $soundMessageEnabled == 0 ? print ' icon-mute' : ''?>" onclick="return lhinst.disableChatSoundAdmin($(this))" title="Enable/Disable sound about new messages from users"></i></a></li><li class="li-icon"><a href="#"><i class="icon-sound<?php  $soundNewChatEnabled == 0 ? print ' icon-mute' : ''?>" onclick="return lhinst.disableNewChatSoundAdmin($(this))" title="Enable/Disable sound about new pending chats"></i></a></li><?php  if ($canChangeVisibilityMode == true) : ?><li class="li-icon"><a href="#"><i class="icon-cloud<?php  $UserData->invisible_mode == 1 ? print ' user-online-disabled' : ''?>" title="Change my visibility to visible/invisible" onclick="return lhinst.changeVisibility($(this))"></i></a></li><?php  endif;?><?php  if ($canChangeOnlineStatus == true) : ?><li class="li-icon"><a href="#"><i class="icon-user<?php  $UserData->hide_online == 1 ? print ' user-online-disabled' : ''?>" title="Change my status to online/offline" onclick="return lhinst.disableUserAsOnline($(this))"></i></a></li><?php  endif;?><?php  if (!isset($hideULSetting)) : ?></ul><?php  endif;?><?php  endif;?><?php $currentUser = erLhcoreClassUser::instance(); $UserData = $currentUser->getUserData(true); ?><li class="divider"></li><li><a href="/x/plugins/chat/front/index.php/site_admin/user/account" title="Account"><?php  echo htmlspecialchars($UserData->name),' ',htmlspecialchars($UserData->surname)?></a></li><li class="li-icon"><a href="/x/plugins/chat/front/index.php/site_admin/user/logout" title="Logout"><i class="icon-logout"></i></a></li><?php  unset($currentUser);unset($UserData);?></ul></section></nav><div class="row pt10 border-top-grey"><div class="columns large-12"><?php  if (isset($Result['path'])) : $pathElementCount = count($Result['path'])-1; if ($pathElementCount >= 0): ?><ul  class="breadcrumbs" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
<li><a rel="home" itemprop="url" href="/x/plugins/chat/front/index.php/site_admin/"><span itemprop="title">Home</span></a></li><?php  foreach ($Result['path'] as $key => $pathItem) : if (isset($pathItem['url']) && $pathElementCount != $key) { ?><li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php  echo $pathItem['url']?>" itemprop="url"><span itemprop="title"><?php  echo htmlspecialchars($pathItem['title'])?></span></a></li><?php  } else { ?><li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php  echo htmlspecialchars($pathItem['title'])?></span></li><?php  }; ?><?php  endforeach; ?>
</ul><?php  endif; ?><?php  endif;?><?php  $canUseChat = erLhcoreClassUser::instance()->hasAccessTo('lhchat','use'); ?><div class="row"><div class="columns large-<?php  $canUseChat == true ? print '9' : print '12'; ?>"><?php  echo $Result['content']; ?></div><?php  if ($canUseChat == true) : $pendingTabEnabled = (int)erLhcoreClassModelUserSetting::getSetting('enable_pending_list',1); $activeTabEnabled = (int)erLhcoreClassModelUserSetting::getSetting('enable_active_list',1); $closedTabEnabled = (int)erLhcoreClassModelUserSetting::getSetting('enable_close_list',0); $unreadTabEnabled = (int)erLhcoreClassModelUserSetting::getSetting('enable_unread_list',1); ?><div class="columns large-3" id="right-column-page" ng-cloak><div class="section-container auto" data-section="auto"><section><p class="title" data-section-title><a title="Chats transferred to you directly" href="#panel1"><i class="icon-user"></i><span class="tru-cnt"></span></a></p><div class="content" data-section-content><div id="right-transfer-chats"><ul class="no-bullet small-list"><li ng-repeat="chat in transfer_chats.list track by chat.id"><img class="action-image right-action-hide" align="absmiddle" ng-click="lhc.startChatTransfer(chat.id,chat.nick,chat.transfer_id)" src="/x/plugins/chat/front/design/defaulttheme/images/icons/accept.png" alt="Accept chat" title="Accept chat"><img class="action-image" align="absmiddle" ng-click="lhc.startChatNewWindowTransfer(chat.id,chat.nick,chat.transfer_id)" src="/x/plugins/chat/front/design/defaulttheme/images/icons/application_add.png" alt="Open in a new window" title="Open in a new window"> {{chat.id}}. {{chat.nick}} ({{chat.time_front}})</li></ul><p ng-show="transfer_chats.list.length == 0">Empty...</p></div></div></section><section><p class="title" data-section-title><a href="#panel2" title="Transferred to your department"><i class="icon-users"></i><span class="trd-cnt"></span></a></p><div class="content" data-section-content><div id="right-transfer-departments"><ul class="no-bullet small-list"><li ng-repeat="chat in transfer_dep_chats.list"><img class="action-image right-action-hide" align="absmiddle" ng-click="lhc.startChatTransfer(chat.id,chat.nick,chat.transfer_id)" src="/x/plugins/chat/front/design/defaulttheme/images/icons/accept.png" alt="Accept chat" title="Accept chat"><img class="action-image" align="absmiddle" ng-click="lhc.startChatNewWindowTransfer(chat.id,chat.nick,chat.transfer_id)" src="/x/plugins/chat/front/design/defaulttheme/images/icons/application_add.png" alt="Open in a new window" title="Open in a new window"> {{chat.id}}. {{chat.nick}} ({{chat.time_front}})</li></ul><p ng-show="transfer_dep_chats.list.length == 0">Empty...</p></div></div></section></div><?php  if ($pendingTabEnabled == true) : ?><div ng-show="pending_chats.list.length > 0"><h5><a href="/x/plugins/chat/front/index.php/site_admin/chat/pendingchats">Pending chats</a></h5><div id="right-pending-chats"><ul class="no-bullet small-list"><li ng-repeat="chat in pending_chats.list track by chat.id"><span ng-if="chat.country_code != undefined"><img ng-src="/x/plugins/chat/front/design/defaulttheme/images/flags/{{chat.country_code}}.png" alt="{{chat.country_name}}" title="{{chat.country_name}}" /></span><i class="icon-user icon-user-assigned" ng-show="chat.user_name" title="Assigned operator - {{chat.user_name}}"></i><a class="icon-info" title="ID - {{chat.id}}" ng-click="lhc.previewChat(chat.id)"></a><a class="icon-reply" title="Redirect user to contact form." ng-click="lhc.redirectContact(chat.id,'Are you sure?')" ></a><a class="right-action-hide icon-chat" ng-click="lhc.startChat(chat.id,chat.nick)" title="Accept chat"></a><a title="Open in a new window" class="icon-popup" ng-click="lhc.startChatNewWindow(chat.id,chat.nick)"></a>{{chat.nick}}, {{chat.time_created_front}}, {{chat.department_name}}</li></ul><p ng-show="pending_chats.list.length == 0">Empty...</p></div><hr></div><?php  endif;?><?php  if ($activeTabEnabled == true) : ?><div ng-show="active_chats.list.length > 0"><h5><a href="/x/plugins/chat/front/index.php/site_admin/chat/activechats">Active chats</a></h5><div id="right-active-chats"><ul class="no-bullet small-list"><li ng-repeat="chat in active_chats.list track by chat.id" ><span ng-if="chat.country_code != undefined"><img ng-src="/x/plugins/chat/front/design/defaulttheme/images/flags/{{chat.country_code}}.png" alt="{{chat.country_name}}" title="{{chat.country_name}}" /></span><a class="icon-info" title="ID - {{chat.id}}, {{chat.user_name}}" ng-click="lhc.previewChat(chat.id)" ></a><a class="right-action-hide icon-chat" ng-click="lhc.startChat(chat.id,chat.nick)" title="Add chat"></a><a class="icon-popup" ng-click="lhc.startChatNewWindow(chat.id,chat.nick)" title="Open in a new window"></a> {{chat.nick}}, {{chat.time_created_front}}, {{chat.department_name}}</li></ul><p ng-show="active_chats.list.length == 0">Empty...</p></div><hr></div><?php  endif;?><?php  if ($unreadTabEnabled == true) : ?><div ng-show="unread_chats.list.length > 0"><h5><a href="/x/plugins/chat/front/index.php/site_admin/chat/unreadchats">Unread messages</a></h5><div id="right-unread-chats"><ul class="no-bullet small-list"><li ng-repeat="chat in unread_chats.list track by chat.id"  ><span ng-if="chat.country_code != undefined"><img ng-src="/x/plugins/chat/front/design/defaulttheme/images/flags/{{chat.country_code}}.png" alt="{{chat.country_name}}" title="{{chat.country_name}}" /></span><a class="icon-info" title="ID - {{chat.id}}" ng-click="lhc.previewChat(chat.id)" ></a><a class="right-action-hide icon-chat" ng-click="lhc.startChat(chat.id,chat.nick)" title="Add chat"></a><a class="icon-popup" ng-click="lhc.startChatNewWindow(chat.id,chat.nick)" title="Open in a new window"></a> {{chat.nick}}, {{chat.time_created_front}}, {{chat.department_name}} | <b>{{chat.unread_time.hours}} h. {{chat.unread_time.minits}} m. {{chat.unread_time.seconds}} s. ago.</b></li></ul><p ng-show="unread_chats.list.length == 0">Empty...</p></div><hr></div><?php  endif;?><?php  if ($closedTabEnabled == true) : ?><div ng-show="closed_chats.list.length > 0"><h5><a href="/x/plugins/chat/front/index.php/site_admin/chat/closedchats">Closed chats</a></h5><div id="right-closed-chats"><ul class="no-bullet small-list"><li ng-repeat="chat in closed_chats.list track by chat.id" ><span ng-if="chat.country_code != undefined"><img ng-src="/x/plugins/chat/front/design/defaulttheme/images/flags/{{chat.country_code}}.png" alt="{{chat.country_name}}" title="{{chat.country_name}}" /></span><a class="icon-info" title="ID - {{chat.id}}" ng-click="lhc.previewChat(chat.id)" ></a><a class="right-action-hide icon-chat" ng-click="lhc.startChat(chat.id,chat.nick)" title="Add chat"></a><a class="icon-popup" ng-click="lhc.startChatNewWindow(chat.id,chat.nick)" title="Open in a new window"></a> {{chat.nick}}, {{chat.time_created_front}}, {{chat.department_name}}</li></ul><p ng-show="closed_chats.list.length == 0">Empty...</p></div></div><?php  endif;?></div><?php  endif; ?></div><div class="mt10"><div class="row mt10 footer-row"><div class="columns twelve"><p class="right"><a target="_blank" href="http://livehelperchat.com">Live Helper Chat &copy; <?php  echo date('Y')?></a></p>
<p><a href="http://livehelperchat.com"><?php  echo htmlspecialchars('Live Helper Chat')?></a></p>
</div></div></div><script type="text/javascript" language="javascript" src="/x/plugins/chat/front/cache/compiledtemplates/8ed60d29541c23da95d98354ab67cddb.js"></script><?php  echo isset($Result['additional_footer_js']) ? $Result['additional_footer_js'] : ''?><?php   ?></div></div><?php  if (false == true) { $debug = ezcDebug::getInstance(); echo $debug->generateOutput(); } ?></body></html>