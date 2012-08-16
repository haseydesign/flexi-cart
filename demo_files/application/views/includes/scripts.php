<!-- JS Includes -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="<?php echo $includes_dir;?>js/jquery.tools.tooltips.min.js?v=1.0"></script>

<script src="<?php echo $includes_dir;?>js/global.js?v=1.0"></script>
<?php if (isset($current_url['admin_library']) || isset($current_url['user_guide'])) { ?>
<script src="<?php echo $includes_dir;?>js/admin_global.js?v=1.0"></script>
<?php } ?>