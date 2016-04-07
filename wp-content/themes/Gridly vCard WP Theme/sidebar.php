<?php
    if (is_active_sidebar('vcard_bottom_sidebar')) :
        require_once(get_template_directory().'/include/class-vcard-sidebar-printer.php');
?>
        <div id="sidebar">
        	<div class="plain-content">
		        <?php
		           Neuethemes_vCardSidebarPrinter::display('vcard_bottom_sidebar');
		        ?>
		    </div>
        </div>

<?php endif; ?>
