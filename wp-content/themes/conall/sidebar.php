<?php
$sidebar = conall_edge_get_sidebar();
?>
<div class="edgtf-column-inner">
    <aside class="edgtf-sidebar">
        <?php
            if (is_active_sidebar($sidebar)) {
                dynamic_sidebar($sidebar);
            }
        ?>
    </aside>
</div>