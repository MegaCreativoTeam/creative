{include file="includes/data.table.tpl" 
	data=$data 
	table=$table}


{if $search}
	{include file="includes/modal-search.tpl" 
		data=$data 
		table=$table 
		controller='/backend/'|cat:$module|cat:'/'}
{/if}

{include file="includes/scripts.tpl"}	


<script>
	function detalles(e){
		var id = $(e).data('id');
		window.location.href = '/backend/estudiantes/detalle-estudiante/' + id + '/?tokenurl={hash_url()}';
	}
</script>