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
			<div id="banner"></div>
			<div id="body-wrapper" class="clearfix">		
				<div id="subscribe-ack" class="left">	
					<h1>Pendaftaran Layanan Innovate</h1>
					<h3 style="margin-top:40px;">Perhatian</h3>
    				<p>Calon pelanggan bertanggung jawab penuh terhadap kebenaran dari seluruh data dan informasi yg disampaikan didalam formulir pendaftaran.
    				Innovate berhak secara sepihak menolak permohonan calon pelanggan.</p>
				</div>
				
				<?php echo form_open('subscribe', 'id="subscriber-form" class="crud"'); ?>
					<div id="form-container" class="left">
						<div id="subscribe-form" class="form-input clearfix">
							<ul class="form">
								<li>
									<label for="first_name">Nama Depan</label>
									<div class="input"><?php echo form_input('first_name', set_value('first_name', $subscriber->first_name), 'class="width-15"'); ?><?php echo form_error('first_name'); ?></div>
								</li>
								
								<li>
									<label for="last_name">Nama Belakang</label>
									<div class="input"><?php echo form_input('last_name', set_value('last_name', $subscriber->last_name), 'class="width-15"'); ?><?php echo form_error('last_name'); ?></div>
								</li>
								
								<li>
									<label for="email">Email</label>
									<div class="input"><?php echo form_input('email', set_value('email', $subscriber->email), 'class="width-15"'); ?><?php echo form_error('email'); ?></div>
								</li>
								
								<li>
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
								
								<li>
									<label for="city">Kota</label>
									<div class="input"><?php echo form_input('city', set_value('city', $subscriber->city), 'class="width-15"'); ?><?php echo form_error('city'); ?></div>
								</li>
								
								<li>
									<table cellspacing="10">
										<tr>
											<td><label for="area_code">Kode Area</label></td>
											<td><label for="phone">No. Telepon</label></td>
										</tr>
										<tr>
											<td><div class="input"><?php echo form_input('area_code', set_value('area_code', $subscriber->area_code), 'style="width:60px" maxlength="4"'); ?><?php echo form_error('area_code'); ?><small>cth: 021</small></div></td>
											<td><div class="input"><?php echo form_input('phone', set_value('phone', $subscriber->phone), 'class="width-15"'); ?><?php echo form_error('phone'); ?> <small>cth: 3912626</small></div></td>
										</tr>
									</table>
								</li>
								
								<li>
									<label for="mobile">No. Ponsel</label>
									<div class="input"><?php echo form_input('mobile', set_value('mobile', $subscriber->mobile), 'class="width-15"'); ?><?php echo form_error('mobile'); ?> <small>cth: 0812345676</small></div>
								</li>
								
								<li>
									<div class="input" style="margin:30px 20px 20px 0;"><?php echo form_submit('subscribe', 'Daftar'); ?></div>
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