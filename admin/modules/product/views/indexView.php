<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="<?php echo base_url("?mod=product&action=addProduct") ?>" title="Thêm mới sản phẩm" id="add-new" class="fl-left"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <?php
                        nav_status($total, $show, $hide);
                        ?>
                    </div>
                    <div class="actions clearfix my-4">
                        <form action="" method="get" enctype="multipart/form-data" class="float-left">
                            <select name="actions" id="sort">
                                <option value="">Sắp xếp theo thứ tự</option>
                                <option value="DESC">Tăng dần theo giá</option>
                                <option value="ASC">Giảm dần theo giá</option>
                            </select>
                        </form>
                        <form class="input-group w-auto float-right" enctype="multipart/form-data" id="form-seach">
                            <input type="text" name="seach" class="form-control form-control-sm" id="seach" placeholder="Bạn Muốn Tìm Gì">
                            <div class="input-group-append">
                                <button class="input-group-text" id="btn_seach">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <ul id="box_show_seach" class="position-absolute z-100">

                            </ul>
                        </form>
                    </div>
                    <?php
                    popup_delete('Thông báo xóa Sản phẩm', 'Việc xóa sản phẩm sẽ Không thể khôi phục');
                    ?>
                    <div class="table-responsive position-relative">
                        <?php
                        spinner_loading();
                        get_table_product();
                        ?>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix" id="pagging">

                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<script>
    // kích hoạt xóa danh sách sản phẩm
    $(document).ready(function() {
        // seach box
        seach_item("?mod=product&action=getListProduct");
        // get data
        get_list_data("?mod=product&action=getListProduct");
        // accept
        delete_data('?mod=product&action=deleteProduct', '?mod=product&action=getListProduct');
        toggel_status("?mod=product&action=getListProduct");
    })
</script>