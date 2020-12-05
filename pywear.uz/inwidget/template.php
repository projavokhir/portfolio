<?php


if(!$inWidget instanceof \inWidget\Core) {
	throw new \Exception('inWidget object was not initialised.');
}
$username = $inWidget->data->username;
?>
<?php

echo '<div class="feed flex-container">';
if(count($inWidget->data->images) != 0)
	for($i = 0; $i < count($inWidget->data->images); $i++){
		$cap = (mb_strlen($inWidget->data->images[$i]->text) > 70) ? mb_substr($inWidget->data->images[$i]->text, 0, 70)."..." : $inWidget->data->images[$i]->text;
		echo '<a href="'.$inWidget->data->images[$i]->link.'" target="_blank">
		 	 			<div class="img-wr">
		 	 				<img src="'.$inWidget->data->images[$i]->large.'" alt="Instagram">
						</div>
				</a>';		
	}
echo "</div>";
?>