	<div class="habblet" id="my-tags-list"> 
	
	<?php
	
	$tags = uberUsers::GetUserTags(USER_ID);
	$tagCount = count($tags);	
	
	if ($tagCount > 0)
	{
		echo '<ul class="tag-list make-clickable">' . LB;
		
		foreach ($tags as $id => $tag)
		{
			echo '                    <li><a href="%www%/tag/' . $tag . '" class="tag" style="font-size:10px">' . $tag . '</a> 
                        <div class="tag-id" style="display:none">' . $id . '</div><a class="tag-remove-link"
                        title="Remover etiqueta"
                        href="#"></a></li>' . LB;
		}
		
		echo '</ul>' . LB;
	}
	
	if ($tagCount >= 20)
	{
		echo '<div class="add-tag-form">Voc� passou dos limites de etiquetas ! Atualmente, voc� poder� usar somente 20 etiquetas.</div>';
	}
	else
	{
		echo '<form method="post" action="/myhabbo/tag/add" onsubmit="TagHelper.addFormTagToMe();return false;" > 
    <div class="add-tag-form clearfix"> 
		<a  class="new-button" href="#" id="add-tag-button" onclick="TagHelper.addFormTagToMe();return false;"><b>Adicionar</b><i></i></a>
        <input type="text" id="add-tag-input" maxlength="20" style="float: right"/> 
        <em class="tag-question">';
		
		$possibleQuestions = Array();
		$possibleQuestions[] = "Qual � a sua comida favorita?";
		$possibleQuestions[] = "Qual � a pessoa que voc� mais admira ?";
		$possibleQuestions[] = "Qual a m�sica que voc� mais gosta?";
		$possibleQuestions[] = "Qual � o seu esporte favorito?";
		$possibleQuestions[] = "Qual � a sua atriz favorita?";
		$possibleQuestions[] = "Qual � a sua cor favorita?";
		$possibleQuestions[] = "Qual � a sua banda favorita?";
		$possibleQuestions[] = "Sua m�e te ama?";
		$possibleQuestions[] = "Voc� tem um orkut?";
		$possibleQuestions[] = "Voc� gosta de conversar pelo MSN?";
		$possibleQuestions[] = "Qual o seu desenho predileto?";
		
		echo $possibleQuestions[rand(0, count($possibleQuestions) - 1)];
		

		echo '</em> 
    </div> 
    <div style="clear: both"></div> 
    </form>';
	}
	
	?>

</div> </div>
 
<script type="text/javascript"> 
<?php if (!isset($habbletmode)){ echo 'document.observe("dom:loaded", function() {'; } ?>
    TagHelper.setTexts({
        tagLimitText: "Voc� passou dos limites ! Remova alguma etiqueta para adicionar uma nova.",
        invalidTagText: "Etiqueta inv�lida",
        buttonText: "OK"
    });
	
<?php

if (isset($habbletmode))
{
	echo 'TagHelper.bindEventsToTagLists();';
}
else
{
    echo "TagHelper.init('" . USER_ID . "');";
	echo "});";
}

?>
</script> 
