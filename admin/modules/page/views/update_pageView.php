<?php
get_header();
// check status page
$selected = ['show' => '','hide' => ''];
if (array_key_exists($page['status'], $selected)) {
    $selected[$page['status']] = 'selected';
};
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật sản phẩm</h3>
                    <a href="<?php echo base_url("?mod=page&action=listPage") ?>" title="Thêm mới sản phẩm" id="add-new" class="fl-left"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php
                    echo form_success("success");
                    ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Tiêu Đề Trang</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo $page["title"]; ?>">
                            <?php echo form_error("title"); ?>
                        </div>
                        <div class="form-group">
                            <label for="slug">Link Thân Thiện</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="<?php echo $page["slug"]; ?>">
                            <?php echo form_error("slug"); ?>
                        </div>
                        <div class="form-group">
                            <label for="content">Chi Tiết Trang</label>
                            <textarea name="content" id="content" class="ckeditor"><?php echo $page["content"]; ?></textarea>
                            <?php echo form_error("content"); ?>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div id="uploadFile" class="position-relative">
                                <input type="file" name="thumbnail[]" id="upload-thumb" class="my-3 d-none">
                                <a name="btn_upload" id="btn_upload" class="position-absolute"><i class="fas fa-cloud-upload-alt"></i></a>
                                <img src="<?php echo $page['thumbnail']; ?>" id="thumb_preview">
                            </div>
                            <?php echo form_error('thumbnail'); ?>
                        </div>
                        <select name="status" class="form-control w-auto" id="">
                            <option value="show" <?php echo $selected['show']; ?>>Công khai</option>
                            <option value="hide" <?php echo $selected['hide']; ?>>Chờ duyệt</option>
                        </select>
                        <div class="action">
                            <a href="<?php echo base_url("?mod=page&action=listPage"); ?>" class="btn btn-outline-info">Quay về</a>
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