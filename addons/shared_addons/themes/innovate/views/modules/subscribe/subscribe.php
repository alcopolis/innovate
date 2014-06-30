<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
    
    <script type="text/javascript">
		$(document).ready(function(){
			if($('select#basic').length > 0){
				$('select#basic').change(function(){
					if($(this).val() != ''){
						$(this).siblings('select.packs').removeAttr('disabled');
					}else{
						$(this).siblings('select.packs').attr('disabled', 'disabled');
					}
				});
			}
		})
	</script>
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
									<label for="area_code">Kode Area Telepon</label>
									<div class="input"><?php echo form_input('area_code', set_value('area_code', $subscriber->area_code), 'style="width:80px" maxlength="4"'); ?><?php echo form_error('area_code'); ?><small>ex: 021</small></div>
									<label for="phone">No. Telepon <span>*</span></label>
									<div class="input"><?php echo form_input('phone', set_value('phone', $subscriber->phone), 'class="width-15"'); ?><?php echo form_error('phone'); ?> <small>ex: 31998600</small></div>
								</li>
								
								<li class="<?php echo alternator('', 'even'); ?>">
									<label for="mobile">No. Ponsel</label>
									<div class="input"><?php echo form_input('mobile', set_value('mobile', $subscriber->mobile), 'class="width-15"'); ?><?php echo form_error('mobile'); ?> <small>ex: 0812345676</small></div>
								</li>
								
                                <li class="<?php echo alternator('', 'even'); ?>">
                                	<div class="input" style="margin:20px 0 0 0; padding:20px 0; border-top:1px solid #CCC;">
                                    	<p>Pilih paket layanan yang Anda inginkan.</p>
                                    	{{subscribe:select_pack product-slug="duo-play" packages-group="duo-play|ala-carte" }}
                                        <div id="pack-msg"></div>
                                    </div>
                                </li>
                                
								<li class="<?php echo alternator('', 'even'); ?>">
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