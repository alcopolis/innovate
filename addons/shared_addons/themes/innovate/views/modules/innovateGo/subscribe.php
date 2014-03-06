<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
</head>
<body id="top" class="subscribe">

		{{ integration:analytics }}
		
		<header class="wrapper">				
			{{ theme:partial name="header" }}
		</header>
				
		<div id="content" class="wrapper clear">
			<div id="body-wrapper" class="clearfix">
				
				<div id="subscribe-ack" class="left">
					<h1>Perhatian</h1>
    				<p>Calon pelanggan bertanggung jawab penuh terhadap kebenaran dari seluruh data dan informasi yg disampaikan didalam formulir pendaftaran.
    				Innovate berhak secara sepihak menolak permohonan calon pelanggan.</p>
				</div>
				
				<?php echo form_open('subscribe', 'id="subscriber-form" class="crud"'); ?>
					<div id="form-container" class="left">
						<h1>Pendaftaran Layanan Innovate</h1>
						<div id="subscribe-form" class="form-input clearfix">
							<ul class="form">
								<li class="<?php echo alternator('', 'even'); ?>">
									<label for="name">Nama Lengkap</label>
									<div class="input"><?php echo form_input('name', set_value('name', $subscriber->name), 'class="width-15"'); ?><?php echo form_error('name'); ?></div>
								</li>
								
								<li class="<?php echo alternator('', 'even'); ?>">
									<label for="email">Email</label>
									<div class="input"><?php echo form_input('email', set_value('email', $subscriber->email), 'class="width-15"'); ?><?php echo form_error('email'); ?></div>
								</li>
								
								<li class="<?php echo alternator('', 'even'); ?>">
									<label for="address">Alamat Pemasangan</label>
									<div class="input">
										<?php
											$txtarea = array(
												'name' => 'address',
												'value' => set_value('address', $subscriber->address),
												'rows' => '5',
												'cols' => '50'
											);
										 	
											echo form_textarea($txtarea);
											echo form_error('address');
										?>
									</div>
								</li>
								
								<li class="<?php echo alternator('', 'even'); ?>">
									<label for="area_code">Kode Area</label>
									<div class="input"><?php echo form_input('area_code', set_value('area_code', $subscriber->area_code), 'style="width:30px"'); ?><?php echo form_error('area_code'); ?></div>
									<label for="phone">No. Telepon <span>*</span></label>
									<div class="input"><?php echo form_input('phone', set_value('phone', $subscriber->phone), 'class="width-15"'); ?><?php echo form_error('phone'); ?></div>
								</li>
								
								<li class="<?php echo alternator('', 'even'); ?>">
									<label for="mobile">No. Ponsel</label>
									<div class="input"><?php echo form_input('mobile', set_value('mobile', $subscriber->mobile), 'class="width-15"'); ?><?php echo form_error('mobile'); ?></div>
								</li>
								
								<li class="<?php echo alternator('', 'even'); ?>" style="border-top:1px dotted #CCC;">
									<div class="input clearfix">
										<div class="" style="margin:20px 20px 40px 20px;">
											<label for="packages" style="font-size:16px;"><em>Paket Layanan Innovate</em></label>
											<br/><small>Pilih layanan internet dan televisi untuk melanjutkan proses pendaftaran.</small><br/><br/>
											<?php echo form_dropdown('packages-net', $packages->inet, $pack_config['net'], 'class="packages"') ?>
											&nbsp; &amp; &nbsp;
											<?php echo form_dropdown('packages-tv', $packages->tv, $pack_config['tv'], 'class="packages"') ?>
											<div id="pack-info">
												<div id="pack-name"><?php echo isset($pack_title) ? $pack_title : ''; ?></div>
												<div id="pack-desc"><?php echo isset($pack_desc) ? $pack_desc : ''; ?></div>
												<div id="additional-info"><?php echo isset($pack_add) ? $pack_add : ''; ?></div>
											</div>
										</div>
										<div class="input" style="margin:30px 20px 20px 20px;"><?php echo form_submit('subscribe', 'Daftar'); ?></div>
									</div>
								</li>
							</ul>
						</div>	
						
					</div>
				<?php echo form_close(); ?>	
			</div>
		</div>

		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>