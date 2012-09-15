<script>
	// Hide content onload, prevents JS flicker
	document.body.className += ' js-enabled';
</script>

<div id="header_wrap">
	<div id="header">
		<h1 id="logo">
			<a href="<?php echo $base_url; ?>" title="flexi cart">
				<img src="<?php echo $includes_dir;?>images/logo.png" alt="flexi cart"/>
				<span class="img_rep">flexi cart</span> 
			</a>
		</h1>
		 
		<ul id="nav">
			<li>
				<a href="<?php echo $base_url; ?>">Home</a>
			</li>
			<li>
				<a href="<?php echo $base_url; ?>lite_library/features">Features</a>
			</li>
			<li>
				<a href="<?php echo $base_url; ?>lite_library/demo">Demo</a>
			</li>
			<li>
				<a href="<?php echo $base_url; ?>user_guide/index">User Guide</a>
			</li>
			<li>
				<a href="<?php echo $base_url; ?>lite_library/support">Support</a>
			</li>
			<li>
				<a href="https://github.com/haseydesign/flexi-cart">Download</a>
			</li>
		</ul>

		<a href="http://haseydesign.com/flexi-auth/" id="flexi_auth_ribbon">
			<div class="ribbon_text">			
				<p>
					Need a New<br/>
					CodeIgniter<br/>
					User Login<br/>
					Library?
				</p>
				<h6>flexi auth</h6>
			</div>
		</a>		
	</div>
</div>