<?php
get_header();
// check status page
$status = $status ?? NULL;
$selected = ['show' => '', 'hide' => ''];
if (array_key_exists($status, $selected)) {
    $selected[$status] = 'selected';
};
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right position-relative">
            <div class="section clearfix" id="title-page">
                <a href="<?php echo base_url("?mod=product&action=listProduct") ?>" class="btn-back float-left mr-3"><i class="fas fa-arrow-left"></i></a>
                <h3 id="index" class="">Thêm sản phẩm</h3>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="form-group">
                            <label for="title">Tên sản phẩm</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value("title"); ?>">
                            <?php
                            echo form_error("title");
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="code">Mã sản phẩm</label>
                            <input type="text" name="code" id="code" class="form-control" value="<?php echo set_value("code"); ?>">
                            <?php
                            echo form_error("code");
                            ?>
                        </div>
                        <ul class="form-group d-flex">
                            <li class="box-price">
                                <label for="price">Giá mới sản phẩm</label>
                                <input type="text" name="price" id="price-new" class="form-control" class="" value="<?php echo set_value('price'); ?>">
                                <?php
                                echo form_error("price");
                                ?>
                            </li>
                            <li class="box-price">
                                <label for="price_old">Giá cũ sản phẩm</label>
                                <input type="text" name="price_old" id="price_old" class="text-danger font-italic form-control mx-2" value="<?php echo set_value('price_old'); ?>">
                                <?php
                                echo form_error("price_old");
                                ?>
                            </li>
                        </ul>
                        <ul class="form-group d-flex flex-wrap">
                            <li class="box">
                                <label for="brand">Thương hiệu</label>
                                <input type="text" name="brand" id="brand" class="form-control" class="text-danger font-italic" value="<?php echo set_value("brand"); ?>">
                                <?php
                                echo form_error("brand");
                                ?>
                            </li>
                            <li class="box">
                                <label for="origin">Nguồn gốc</label>
                                <input type="text" name="origin" id="origin" class="text-danger form-control font-italic mx-2 w-75" value="<?php echo set_value("origin"); ?>">
                                <?php
                                echo form_error("origin");
                                ?>
                            </li>
                            <li class="box w-25">
                                <label for="qty">Số lượng hiện có</label>
                                <input type="text" name="qty" id="qty" class="w-100 form-control" value="<?php echo set_value("qty"); ?>">
                                <?php
                                echo form_error("qty");
                                ?>
                            </li>
                        </ul>
                        <div class="form-group">
                            <label for="desc">Mô tả ngắn</label>
                            <textarea name="desc" id="desc" class="form-control"><?php echo set_value("desc"); ?></textarea>
                            <?php
                            echo form_error("desc");
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="content">Chi tiết</label>
                            <textarea name="content" id="content" class="ckeditor"><?php echo set_value("content"); ?></textarea>
                            <?php
                            echo form_error("content");
                            ?>
                        </div>
                        <div class="form row">
                            <div class="form-group col-md-4 ">
                                <label>Danh mục sản phẩm</label>
                                <?php
                                $cat = $cat ?? "";
                                echo get_cat_parents('', $cat, $cats);
                                echo form_error("parent_id");
                                ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control w-auto" id="">
                                    <option value="show" <?php echo $selected['show']; ?>>Công khai</option>
                                    <option value="hide" <?php echo $selected['hide']; ?>>Chờ duyệt</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Loại sản phẩm</label>
                                <select name="type" class="form-control w-auto" id="">
                                    <option value="normal">Bình thường</option>
                                    <option value="hot_product" ?>Sản phẩm hot</option>
                                    <option value="flash_sale">flash Sale</option>
                                </select>
                            </div>
                        </div>
                        <?php
                        echo form_error("status");
                        ?>
                        <label for="">Ảnh sản phẩm:</label>
                        <label for="upload-thumb">Click vào ảnh để upload</label>
                        <div id="uploadFile" class="position-relative">
                            <input type="file" name="thumbnail[]" id="upload-thumb" class="my-3 d-none">
                            <button id="btn_upload" class="position-absolute"><i class="fas fa-cloud-upload-alt"></i></button>
                            <img src="<?php echo set_value('thumbnail'); ?>" id="thumb_preview">
                            <?php
                            echo form_error('thumbnail');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="action">
                    <a href="<?php echo base_url("?mod=product&action=listProduct") ?>" class="btn btn-outline-info">Quay về</a>
                    <button type="submit" name="btn_add" class="btn btn-outline-success" id="btn_add">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="public\js\charts\chart.js"></script>
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