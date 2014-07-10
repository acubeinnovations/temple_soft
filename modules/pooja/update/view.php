<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
 ?>

<h3>Add Pooja</h3>

 <form id="" name="" method="POST" action="" data-abide >
 	<fieldset>
 		

 		<div class="row">
 			<div class="large-8 columns">
 				<p class="note"><?php echo $transMSG; ?></p>
 			</div>
 		</div>

 		<div class="row">
 			<div class="medium-4 columns">
 				<label for="pooja">Pooja <small>required</small>
 					<input type="text" name="name" id="pooja" value="<?php echo $pooja->name;?>" required <?php echo ($transMSG)?"readonly":"";?>/>
 				</label>
 			</div>

 			<div class="medium-4 columns">
	 			<label for="ledger">For Ledger
	 				<?php echo populate_list_array("lstledger", $ledgers, 'id','name', $ledger->parent_sub_ledger_id,$disable=false);?>
	 			</label>
	 		</div>

 		</div>

		<div class="row">
 			<div class="medium-4 columns">
 				<label for="rate">Rate <small>required</small>
 				<input type="number" required pattern="[0-9]+[.[0-9]+]?" name="rate" id="rate" value="<?php echo $pooja->rate;?>"  />
 				</label>
 			</div>

 			<div class= "medium-4 columns">
 				<label for="listpooja">Status <small>required</small>
				<?php echo populate_list_array("listpooja", $g_ARRAY_LIST_STATUS, 'id','name', $pooja->status_id,$disable=false,false);?>
 				</label>
 			</div>
 		</div>

 		<div class="row">
 			<div class="text-center">
 				<input class="tiny button"  value="submit" name="submit" type="submit"/>
 				<input type="hidden" name="h_id" value="<?php echo $pooja->id; ?>" />

 			</div>
 		</div>

 	</fieldset>
 </form>

