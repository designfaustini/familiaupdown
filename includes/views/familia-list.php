<div class="wrap">
    <h2><?php _e( 'Família Up Down', 'designfaustini' ); ?> <a href="<?php echo admin_url( 'admin.php?page=familiaupdown&action=new' ); ?>" class="add-new-h2"><?php _e( 'Add New', 'designfaustini' ); ?></a></h2>

    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">

        <?php
        $list_table = new FamiliaUpDown_List_Table();
        $list_table->prepare_items();
        $list_table->search_box( 'search', 'search_id' );
        $list_table->display();
        ?>
    </form>
</div>