<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <form id="form-upload-slider" method="post" enctype="multipart/form-data" class="section-detail">
            <label for="upload-thumb">Click vào ảnh để upload</label>
            <div id="uploadFile" class="position-relative">
                <input type="file" name="thumbnail[]" id="upload-thumb" multiple class="my-3 d-none" accept=".jpg,.png,.gif">
                <button id="btn_upload" class="position-absolute"><i class="fas fa-cloud-upload-alt"></i></button>
                <img src="" id="thumb_preview">
            </div>
            <?php echo form_error("upload"); ?>
            <button id="btn-add" name="btn-add" class="btn btn-outline-info d-block my-4">Upload</button>
            <div class="owl-carousel owl-theme">
                <?php
                if (!empty($sliders)) {
                    foreach ($sliders as $k=>$slider) {
                ?>
                        <div class="item">
                            <a href="?mod=slider&action=delete&id=<?php echo $k ?>" class="text-danger"><i class="far fa-times-circle"></i></a>
                            <img src="<?php echo $slider?>">
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </form>
    </div>
</div>
<!-- load owl -->
<link rel="stylesheet" href="public/owlcarousel/owl.carousel.min.css">
<link rel="stylesheet" href="public/owlcarousel/owl.theme.default.min.css">
<script src="public/owlcarousel/owl.carousel.min.js"></script>
<?php
get_footer();
?>
<script>
    $(document).ready(() => {
        $("#btn_upload").click(function() {
            $("#upload-thumb").trigger("click")
            return false;
        })
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    })
</script>