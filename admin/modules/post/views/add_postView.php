<?php
get_header();
// check status page
$status = empty($status) ? '' : $status;
$selected = ['show' => '', 'hide' => ''];
if (array_key_exists($status, $selected)) {
    $selected[$status] = 'selected';
};
global $thumb_post;
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section clearfix" id="title-page">
                <a href="<?php echo base_url("?mod=post") ?>" class="btn-back float-left"><i class="fas fa-arrow-left"></i></a>
                <h3 id="index" class="mx-5">Thêm Bài Viết</h3>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title'); ?>">
                            <?php
                            echo form_error('title');
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="title">Slug ( Friendly_url )</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="<?php echo set_value('slug'); ?>">
                            <?php
                            echo form_error('slug');
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="desc">Mô tả</label>
                            <textarea name="desc" id="desc" class="form-control"><?php echo set_value('desc'); ?></textarea>
                            <?php
                            echo form_error('desc');
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea name="content" id="content" class="ckeditor"><?php echo set_value('content'); ?></textarea>
                            <?php
                            echo form_error('content');
                            // khai báo rỗng nếu không có
                            $thumb_post = empty($thumbnail) ? "public/images/img-thumb.png" : $thumbnail;
                            ?>
                        </div>
                        <label for="upload-thumb">Click vào ảnh để upload</label>
                        <div id="uploadFile" class="position-relative">
                            <input type="file" name="thumbnail[]" id="upload-thumb" class="my-3 d-none">
                            <a id="btn_upload" class="position-absolute"><i class="fas fa-cloud-upload-alt"></i></a>
                            <img src="<?php echo $thumbnail; ?>" id="thumb_preview">
                            <?php
                            echo form_error('thumbnail');
                            ?>
                        </div>
                        <label>Danh mục cha</label>
                        <?php
                        $cat_parent = $cat_parent ?? NULL;
                        $cat = $cat ?? NULL;
                        echo get_cat_parents($cat, $cat_parent, $cats);
                        echo form_error("parent_id");
                        ?>
                        <select name="status" class="form-control w-auto" id="">
                            <option value="show" <?php echo $selected['show']; ?>>Công khai</option>
                            <option value="hide" <?php echo $selected['hide']; ?>>Chờ duyệt</option>
                        </select>
                        <div class="action">
                            <a href="<?php echo base_url("?mod=post"); ?>" class="btn btn-outline-info float-left mr-3">Quay về</a>
                            <button type="submit" name="btn_add" class="btn btn-outline-success" id="btn_add">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<script>
    $(document).ready(function() {
        $("#btn_upload").click(function() {
            $("#upload-thumb").trigger("click")
            return false;
        })
    })
</script>