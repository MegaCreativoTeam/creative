{assign var=auth value=Session::auth()}

<aside class="main-sidebar">
<section class="sidebar">
	<div class="user-panel" style="min-height: 60px">
		<div class="pull-left image">
			<img id="user_img_menu" src="{$theme.img|cat:'user.backend.png'}" class="user-image img-circle" alt="" style="background-color: #fff">
		</div>
		<div class="info">
			<p>{$auth.description|upper}</p>
			<a href="#"><span class="fa fa-circle" style="color:#56b726"></span>{if $auth.profile_name}{$auth.profile_name}{/if}</a>
		</div>
	</div> 

	<ul class="user-links list-unstyled">
		<li><a href="#" title="Edit profile"> <i class="fa fa-user"></i> {Lang::get('my_profile')}</a></li> 
		<li><a href="#" title="Edit profile"> <i class="fa fa-envelope-o"></i> {Lang::get('messages')}</a></li> 
		<li class="logout-link"> <a href="#" {Helper::get('html')->tooltip(Lang::get('exit'))}> <i class="fa fa-power-off"></i> </a> </li> 
	</ul>

	<ul class="sidebar-menu">
		
	{if isset($menu) && count($menu)}
		{foreach $menu as $module_name => $module_attr}
		
			{if $module_attr.module==$auth.ambit}

				{if isset($module_attr.submodules) && count($module_attr.submodules)}

					{if Acl::access_view_module($module_name)==true}

						<li id="{$module_name}" class="treeview{if isset($options.active_menu) AND $options.active_menu==$module_name} active{/if}">
							<a href="#">
								<i class="{$module_attr.icon|default:'fa fa-circle'}"></i>
								<span>{$module_attr.text}</span>
								<span class="pull-right-container">
									<span class="fa fa-angle-right pull-right"></span>
								</span>
							</a>
							<ul class="treeview-menu">
								{foreach $module_attr.submodules as $module_ix => $module}
									{if Acl::access_view_module($module_ix)==true}
										<li id="{$module_ix}">
											<a href="/{$module_attr.module}/{if isset($module.alias_url)}{$module.alias_url}{else}{$module_name}/{$module_ix}{/if}/?tokenurl={hash_url()}">
												<i class="{$module.icon|default:'fa fa-caret-right'}"></i> <span>{$module.text}</span>
											</a>
										</li>
									{/if}
								{/foreach}							
							</ul>
						</li>

					{/if}

				{else}

					{if Acl::access_view_module($module_name)==true}
						<li id="{$module_name}">
							<a href="/{$module_attr.module}/{$module_name}/?tokenurl={hash_url()}">
								<i class="{$module_attr.icon}"></i> <span>{$module_attr.text}</span>
							</a>
						</li>
					{/if}

				{/if}

			{/if}

		{/foreach}
	{/if}

	</ul>
</section>
</aside>