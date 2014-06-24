<fieldset>
	<style type="text/css">
		.left{float:left;}
		.right{float:right}
		ul#pack-group-list > li{border-bottom:none; margin:20px 0; background:#EEE; border-radius:5px; box-shadow:0 0 2px #999;}
		ul#pack-group-list li ul{padding:0; margin:10px}
	</style>

	<div style="margin-bottom:20px;"><a onClick="add_group()" class="add btn blue">Add New</a></div>
	
	<ul id="pack-group-list">
		<?php foreach($pack_group as $g){ ?>
			<li>
				<ul id="group-<?php echo $g->id; ?>" class="group-form">
					<li class="clearfix">
						<div class="input small-side left" style="max-width:180px; margin-top:20px; font-size:2em;"><?php echo $g->name; ?></div>
						<div class="right" style="max-width:180px; margin-top:10px;"><a data-id="<?php echo $g->id?>" onClick="update_group($(this).attr('data-id'))" class="btn blue">Save Changes</a></div>
					</li>
					<li class="editor">
						<?php echo form_textarea(array('id' => $g->slug . '-body', 'value' => set_value( $g->slug . '-body', $g->body), 'name' =>  $g->slug . '-body', 'rows' => 10)) ?>
						<div class="msg" style="opacity:0;"></div>
					</li>
				</ul>
			</li>
		<?php } ?>
	</ul>
</fieldset>