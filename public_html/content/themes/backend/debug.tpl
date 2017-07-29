{include file="includes/head.front.tpl"}

<body class="smoothscroll enable-animation">
	<div id="wrapper">

{include file="includes/header.front.tpl"}

{if $breadcrumbs == true }
	{include file=$themes.dir|cat:'includes/breadcrumbs.front.tpl'}
{/if}

{if strpos($view_html , ".tpl") == true}
	{include file=$view_html}
{else}
	{$view_html}
{/if}

{include file="includes/footer.front.tpl"}
	</div>
</body>
</html>