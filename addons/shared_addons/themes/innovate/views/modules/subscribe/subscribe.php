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
    				TelkomVision berhak secara sepihak menolak permohonan calon pelanggan.</p>
    				<p>Pelanggan akan dikenakan biaya commitment fee sebesar Rp.125.000,- [Seratus Dua Puluh Lima Ribu Rupiah] apabila pelanggan memutuskan untuk berhenti berlangganan.
    				Harga paket dan minipack Belum Termasuk PPN.</p>
				</div>
				
				<div id="subscribe-form" class="form-input left">
				
					<?php if(validation_errors() != ''){ ?>
						<div id="validation-msg"><?php echo validation_errors(); ?></div>
					<?php } ?>	
					
					<?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?>
					<ul id="form">
						<li class="<?php echo alternator('', 'even'); ?>">
							<label for="first_name">Nama Depan <span>*</span></label>
							<div class="input"><?php echo form_input('first_name', set_value('first_name', $subscriber->first_name), 'class="width-15"'); ?></div>
							<label for="last_name">Nama Belakang <span>*</span></label>
							<div class="input"><?php echo form_input('last_name', set_value('last_name', $subscriber->last_name), 'class="width-15"'); ?></div>
						</li>
						
						<li class="<?php echo alternator('', 'even'); ?>">
							<label for="email">Email <span>*</span></label>
							<div class="input"><?php echo form_input('email', set_value('email', $subscriber->email), 'class="width-15"'); ?></div>
						</li>
						
						<li class="<?php echo alternator('', 'even'); ?>">
							<label for="address">Alamat Pemasangan <span>*</span></label>
							<div class="textarea"><?php echo form_textarea('address', set_value('address', $subscriber->address), 'style="width:95%"'); ?></div>
						</li>
						
						<li class="<?php echo alternator('', 'even'); ?>">
							<p>Masukkan kode area dan nomor telepon.</p>
							<label for="area_code">Kode Area <span>*</span></label>
							<div class="input"><?php echo form_input('area_code', set_value('area_code', $subscriber->area_code), 'style="width:30px"'); ?></div>
							<label for="phone">No. Telepon <span>*</span></label>
							<div class="input"><?php echo form_input('phone', set_value('phone', $subscriber->phone), 'class="width-15"'); ?></div>
						</li>
						
						<li class="<?php echo alternator('', 'even'); ?>">
							<label for="mobile">No. HP <span>*</span></label>
							<div class="input"><?php echo form_input('mobile', set_value('mobile', $subscriber->mobile), 'class="width-15"'); ?></div>
						</li>
					</ul>
					<div class="input"><?php echo form_submit('subscribe', 'Daftar'); ?></div>
					<?php echo form_close(); ?>
				</div>	
			</div>
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>