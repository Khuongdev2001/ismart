<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách Trang</h3>
                    <a href="<?php echo base_url("?mod=page&action=addPage") ?>" title="Thêm mới sản phẩm" id="add-new" class="fl-left"><i class="fas fa-plus"></i></a>
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
                                <option value="DESC">Sắp Xếp A-Z</option>
                                <option value="ASC">Sắp Xếp Z-A</option>
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
                    spinner_loading();
                    ?>
                    <table class="table list-table-wp table-lg table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th><span class="thead-text">STT</span></th>
                                <th><span class="thead-text">Ảnh Trang</span></th>
                                <th><span class="thead-text">Tiêu Đề Trang</span></th>
                                <th><span class="thead-text">Người Tạo</span></th>
                                <th><span class="thead-text">Trang Thái</span></th>
                                <th><span class="thead-text">Thời gian</span></th>
                            </tr>
                        </thead>
                        <tbody id="list_data">
                        </tbody>
                    </table>
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
    $(document).ready(function() {
        let url = "?mod=page&action=listPageAjax";
        seach_item(url);
        get_list_data(url);
        delete_data("?mod=page&action=delete", url);
        toggel_status(url);
    })
</script>