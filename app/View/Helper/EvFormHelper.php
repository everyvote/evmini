<?php
/**
 * Description of EvFormHelper
 * 
 * This helper ought to provide a nice way to access reusable
 * form components.  For example, the first component is a selector
 * and can be used to select different model items from the database.
 *
 * @author vincent
 */

class EvFormHelper extends AppHelper {
	
	
	/**
	 * selector form
	 * 
	 * Displays a widget that will select a model element.
	 * Going to use JQuery Autocomplete for simplicity. 
	 * 
	 * Assumes that it can find:
	 * [{id, name}] @ /<modelname>/selectorJSON
	 * There should be a method in AppController which will handle this,
	 * but one may need to override it in specific controllers.
	 * 
	 * Perhaps this combobox could be implemented later: 
	 * http://jsfiddle.net/and7ey/TFerw/3/
	 * 
	 * @param string $model
	 *		The model to use-- such as Constituency or Election
	 * 
	 * @param string $pfx
	 *		A prefix to append to the input name.
	 *		$pfx = "_add" will cause the form's name to be Constituency_addValue
	 * 
	 * @param string $class
	 *		Attach a class name to the selector.
	 * 
	 * @param javascript $action
	 *		JavaScript statements that should be performed upon selection.
	 *		Important vars: ui.item.label and ui.item.id
	 * 
	 */
	public function selector($model, $pfx, $class = "", $action ="" ) { 

		?>

		<div id="<?=$model.$pfx?>" class="SelectorHelper"> 
			<input type="text" <?= ($class != "")? ('class="'.$class.'"') : ('') ?> />
			<input id="<?=$model.$pfx?>Value" name="<?=$model.$pfx?>Value" type="hidden"/>
		</div>


		<script>
		$(document).ready(function(){
			
			$("#<?=$model.$pfx?> input[type=text]").autocomplete({
				  source: "<?=Router::url('/', false)?>/<?=Inflector::tableize($model)?>/selectorJSON",
				  minLength: 1,
				  select: function( event, ui ) {
					
					$("#<?=$model.$pfx?>Value")[0].setAttribute('value', ui.item.id);
					<?= ($action != "") ? '(function(){'.$action.'}).call();': ""?>
			  
				  }
				  
				});
				
			});
		</script> 
		<?php
		
	}

}

?>
