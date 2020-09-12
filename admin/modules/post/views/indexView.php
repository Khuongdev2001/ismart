<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        model();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="<?php echo base_url("?mod=post&action=addPost"); ?>" title="" id="add-new" class="fl-left"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <?php
                        nav_status($total, $show, $hide );
                        ?>
                        <div class="actions clearfix">
                            <form action="" class="float-left my-2" method="get" enctype="multipart/form-data">
                                <select name="actions" class="" id="sort">
                                    <option value="">Sắp xếp theo thứ tự</option>
                                    <option value="DESC">Tăng dần A-Z</option>
                                    <option value="ASC">Giảm dần Z-A</option>
                                </select>
                            </form>
                            <form class="input-group w-auto float-right my-2" enctype="multipart/form-data" id="form-seach">
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
                        <table class="table list-table-wp table-responsive table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th><span class="thead-text">STT</span></th>
                                    <th><span class="thead-text">Tiêu đề</span></th>
                                    <th><span class="thead-text">Ảnh Bài Viết</span></th>
                                    <th><span class="thead-text">Danh mục</span></th>
                                    <th><span class="thead-text">Trạng thái</span></th>
                                    <th><span class="thead-text">Người tạo</span></th>
                                    <th><span class="thead-text">Thời gian</span></th>
                                </tr>
                            </thead>
                            <tbody id="list_data">

                            </tbody>
                        </table>
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
    $(document).ready(function() {
        seach_item("?mod=post&action=getListAjax");
        get_list_data("?mod=post&action=getListAjax");
        delete_data("?mod=post&action=deletePost", "?mod=post&action=getListAjax");
        toggel_status("?mod=post&action=getListAjax");
    })
</script>