<!-- JS Includes -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="<?php echo $includes_dir;?>js/jquery.tools.tooltips.min.js?v=1.0"></script>

<script src="<?php echo $includes_dir;?>js/global.js?v=1.0"></script>
<?php if (isset($current_url['admin_library']) || isset($current_url['user_guide'])) { ?>
<script src="<?php echo $includes_dir;?>js/admin_global.js?v=1.0"></script>
<?php } ?>

<?php if ($_SERVER['SERVER_NAME'] != 'localhost' && $_SERVER['REMOTE_ADDR'] != '220.233.64.171') { ?>
<script type="text/javascript">
	// Analytics
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-21820925-1']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
<?php } ?>
