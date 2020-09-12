<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <div class="form-group">
                            <label for="title">Tên danh mục</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value("title"); ?>">
                            <?php
                            echo  form_error("title");
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="title">Slug ( Friendly_url )</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="<?php echo set_value("slug"); ?>">
                            <?php
                            echo  form_error("slug");
                            ?>
                        </div>
                        <label>Danh mục cha</label>
                        <?php
                        $cat_parent = !empty($cat_parent) ? $cat_parent['title'] : NULL;
                        $cat = $cat ?? NULL;
                        echo get_cat_parents($cat, $cat_parent, $cats);
                        echo form_error('parent_id');
                        ?>
                        <button type="submit" name="btn-add" id="btn-add" class="btn btn-success">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>