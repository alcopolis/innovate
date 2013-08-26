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
				
				<?php echo form_open($this->uri->uri_string(), 'id="subscriber-form" class="crud"'); ?>
					<div id="subscribe-form" class="form-input left">
						<h1>Pendaftaran Layanan Innovate</h1>
						<?php if(validation_errors() != ''){ ?>
							<div id="validation-msg"><?php echo validation_errors(); ?></div>
							<div id="msg"></div>
						<?php } ?>	
						
						<ul class="form">
							<li class="<?php echo alternator('', 'even'); ?>">
								<label for="name">Nama Lengkap <span>*</span></label>
								<div class="input"><?php echo form_input('name', set_value('name', $subscriber->name), 'class="width-15"'); ?></div>
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
								<label for="area_code">Kode Area <span>*</span></label>
								<div class="input"><?php echo form_input('area_code', set_value('area_code', $subscriber->area_code), 'style="width:30px"'); ?></div>
								<label for="phone">No. Telepon <span>*</span></label>
								<div class="input"><?php echo form_input('phone', set_value('phone', $subscriber->phone), 'class="width-15"'); ?></div>
							</li>
							
							<li class="<?php echo alternator('', 'even'); ?>">
								<label for="mobile">No. Ponsel <span>*</span></label>
								<div class="input"><?php echo form_input('mobile', set_value('mobile', $subscriber->mobile), 'class="width-15"'); ?></div>
							</li>
							
							<li class="<?php echo alternator('', 'even'); ?>" style="background: #EFEFEF;">
								<label for="packages">Pilih paket layanan Innovate yang Anda inginkan.</label>
						
								<div class="input">
									<?php echo form_dropdown('packages-net', $packages->inet, $packages->inet[0], 'class="packages"') ?>
									&nbsp;
									<?php echo form_dropdown('packages-tv', $packages->tv, $packages->inet[0], 'class="packages"') ?>
								</div>
						
								<div id="pack-info">
									<div class="pack-name"></div>
									<div class="pack-desc"></div>
								</div>
							</li>
						</ul>
						
						<ul class="form">
							
						</ul>
						
						<div class="input" style="text-align:center"><?php echo form_submit('subscribe', 'Daftar'); ?></div>
					</div>
				<?php echo form_close(); ?>	
			</div>
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
		
		<script type="text/javascript">
// 			h = $('#subscribe-form').innerHeight();
// 			$('#pack-selection').css('min-height', h + 'px');

			$('.packages').change(function(){
// 				if($(this).val() != 0){
// 					$('#pack-info').show();
// 					var formData = new FormData($('#subscriber-form')[0]);
					
// 					$.ajax({
// 						type: 'POST',
// 						url: 'subscribe/pack_info',
// 						processData: false,
// 						contentType: false,
// 						data:formData,
// 						dataType: 'json',
// 						success: function(respond) {
// // 							var data = respond;
// // 							$('#pack-info h3').html(data.package_name);
// // 							$('#pack-info p').html(data.package_body);

// 							if(respond.bundle){
// 								console.log('Bundle');
// 							}else{
// 								console.log('Single');
// 							}
// 						},
// 					});
// 				}else{
// 					$('#pack-info h3').html('');
// 					$('#pack-info p').html('');
// 					$('#pack-info').hide();
// 				}

				var formData = new FormData($('#subscriber-form')[0]);

				if($(this).val() != 0 || ($(this).val() == 0 && $(this).siblings().val() != 0)){
					$('#pack-info').show();

					var title = '';
					var desc = '';
					var price = '';
					
					$.ajax({
						type: 'POST',
						url: 'subscribe/pack_info',
						processData: false,
						contentType: false,
						data:formData,
						dataType: 'json',
						success: function(respond) {
							console.log(respond);
							
							if(respond.bundle){
								title = '<span class="bundle">Bundle</span>' + respond.data.net.package_name + ' & ' + respond.data.tv.package_name;
								desc = 'Paket bundle layanan <em>' + respond.data.net.package_name + '</em> dengan <em>' + respond.data.tv.package_name + '</em>';
							}else{
								title = respond.data.package_name;
								desc = respond.data.package_body;
							}

							$('#pack-info .pack-name').html(title);
							$('#pack-info .pack-desc').html(desc);
						},
					});
				}else{
					$('#pack-info .pack-name').html('');
					$('#pack-info p').html('');
					$('#pack-info').hide();
				}
			});
		</script>
</body>
</html>