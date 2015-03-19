


<?php if($product->body != ''){ ?>
	<div id="prod-content" class="clearfix">
		<?php if(isset($packages)){ ?>
			<div id="prod-info" class="clearfix">
				<?php echo $product->body; ?>
			</div>
		<?php }else{ ?>
			<div  style="color:#0B5EBA; text-shadow:none; padding:40px 0;" class="package clearfix">
				<?php echo $product->body; ?>
		<?php } ?>
	</div>
<?php } ?>


<?php if(isset($packages)){ ?>
	<div class="package">
		<ul id="pack-nav" class="clearfix">
			<?php foreach($packages as $pack){ ?>
				<li><a href="#<?php echo $pack['data']->slug; ?>"><?php echo $pack['data']->name; ?></a></li>
			<?php } ?>
			
			<?php if($bundle->status == '1'){ ?>
				<li class="bundle-nav"><a href="#bundle">Bundle</a></li>
			<?php } ?>	
		</ul>
		
		<?php foreach($packages as $pack){ ?>
			<div id="<?php echo $pack['data']->slug; ?>" class="pack-container clearfix">
				{{ if alcopolis:device == 'computer' }}
					<div class="data left">
				{{ else }}
					<div class="data">
				{{ endif }}
						<?php echo $pack['data']->body; ?>
					</div>
				
				{{ if alcopolis:device == 'computer' }}
					<div class="packs right clearfix">
				{{ else }}
					<div class="packs clearfix">
				{{ endif }}
						<?php foreach($pack['pack'] as $p){ ?>
							<div id="<?php echo $p->slug; ?>" class="pack-item left">
								<h5 class="pack-name"><?php echo $p->name; ?></h5>
								<section style="margin:10px; text-align: center; "><?php echo $p->body; ?></section>
								<h6 class="pack-price"><?php echo 'Rp ' . $p->price; ?></h6>
							</div>
						<?php } ?>
					</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>


	
<div id="toc" class="clearfix">
	<?php if($product->terms != ''){ ?>
		<div id="terms" class="left">
			<h6>Syarat &amp; Ketentuan</h6>
			<?php echo $product->terms; ?>	
		</div>
		<div id="cs-support" class="right">
			<img alt="Customer care" src="{{theme:image_path}}cs.png" style="width:64px;"/>
			<p style="margin:10px 0; padding:0;">Untuk Informasi Lebih Lanjut<br/>
			Hubungi Customer Care Kami</p>
			<h3 style="padding:0;">[021] 5055 6182</h3>
		</div>
	<?php }else{ ?>
		<div id="cs-support">
			<img alt="Customer care" src="{{theme:image_path}}cs.png" style="width:64px;"/>
			<p style="margin:10px 0; padding:0;">Untuk Informasi Lebih Lanjut<br/>
			Hubungi Customer Care Kami</p>
			<h3 style="padding:0;">[021] 5055 6182</h3>
		</div>
	<?php } ?>
</div>
