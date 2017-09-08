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

$(document).ready(function(){
    $( '#autoiniciar' ).change(function(e){
        /*var val  = $( '#autoiniciar' ).val();
        if( val == 1){
            $("#desde, #hasta").parent().show();
            $("#desde").focus();
        } else {
            $("#desde, #hasta").parent().hide();
        }*/
    });
});

</script>