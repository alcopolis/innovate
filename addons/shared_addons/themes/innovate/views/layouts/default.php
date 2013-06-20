<!DOCTYPE html>
<html>
<head>
	<?php if ( ! $this->settings->frontend_enabled && (empty($this->current_user) or $this->current_user->group != 'admin')){ ?>
		{{ theme:partial name="maintenance" }}
	<?php }else{ ?>
		{{ theme:partial name="metadata" }}
	<?php } ?>
</head>
<body id="top">
	<?php if ( ! $this->settings->frontend_enabled && (empty($this->current_user) or $this->current_user->group != 'admin')){ ?>
	 	{{ theme:partial name="site_down" }}
	<?php }else{ ?>

		<div id="pageWrapper">
			{{ integration:analytics }}
						
			<div class="partialWrapper">				
				{{ theme:partial name="header" }}
			</div>
									
			<div class="contentWrapper scroll">
				<div>{{ asset:image file="theme::tes-content.jpg" alt="Tes content" }}</div>
				<div>
					<h1>Lorem ipsum</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
				</div>
				<div>{{ asset:image file="theme::tes-content-2.jpg" alt="Tes content 2" }}</div>
				<div>
					<h1>Lorem ipsum 2</h1>
					<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
				</div>
			</div>
			
			<div class="partialWrapper">
				{{ theme:partial name="footer" }}
			</div>
		</div>
	
	<?php } ?>
</body>
</html>