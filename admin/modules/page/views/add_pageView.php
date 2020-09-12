<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section clearfix" id="title-page">
                <a href="<?php echo base_url("?mod=page&action=listPage") ?>" class="btn-back float-left mr-3" title="Quay về"><i class="fas fa-arrow-left"></i></a>
                <h3 id="index" class="">Thêm Trang</h3>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php
                    echo form_success("success");
                    ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Tiêu Đề Trang</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value("title"); ?>">
                            <?php echo form_error("title"); ?>
                        </div>
                        <div class="form-group">
                            <label for="slug">Link Thân Thiện</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="<?php echo set_value("slug"); ?>">
                            <?php echo form_error("slug"); ?>
                        </div>
                        <div class="form-group">
                            <label for="content">Chi Tiết Trang</label>
                            <textarea name="content" id="content" class="ckeditor"><?php echo set_value("content"); ?></textarea>
                            <?php echo form_error("content"); ?>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div id="uploadFile" class="position-relative">
                                <input type="file" name="thumbnail[]" id="upload-thumb" class="my-3 d-none">
                                <button id="btn_upload" class="position-absolute"><i class="fas fa-cloud-upload-alt"></i></button>
                                <img src="public/images/img-thumb.png" id="thumb_preview">
                            </div>
                            <?php echo form_error('file'); ?>
                        </div>
                        <select name="status" class="form-control w-auto" id="">
                            <option value="show">Công khai</option>
                            <option value="hide">Chờ duyệt</option>
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