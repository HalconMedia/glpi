<h1>Please login</h1><?php  if (isset($errors)) : ?><?php  if (isset($errors)) : ?><div data-alert class="alert-box alert"><a href="#" class="close">×</a><ul><?php  foreach ($errors as $err) : ?><li><?php  echo $err?></li><?php  endforeach;?></ul></div><?php  endif;?><?php  endif; ?><form id="form-start-chat" method="post" action="/x/plugins/chat/front/index.php/site_admin/user/login"><label>Username</label><input type="text" name="Username" value="" /><label>Password</label><input type="password" class="inputfield" name="Password" value="" /><label class="mb6"><input class="input-checkbox" type="checkbox" name="rememberMe" value="1">Remember me</label><input type="submit" class="small round button" value="Login" name="Login" />&nbsp;<a class="fs11" href="/x/plugins/chat/front/index.php/site_admin/user/forgotpassword">Password reminder</a><input type="hidden" name="redirect" value="<?php  echo htmlspecialchars($redirect_url);?>" /></form>