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
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="actions d-flex justify-content-between">
                        <form action="" method="get" enctype="multipart/form-data">
                            <select name="actions" id="sort">
                                <option value="">----Sắp xếp theo thứ tự----</option>
                                <option value="DESC">Tăng dần theo giá</option>
                                <option value="ASC">Giảm dần theo giá</option>
                            </select>
                        </form>
                        <form class="input-group w-auto" enctype="multipart/form-data" id="form-seach">
                            <input type="text" name="seach" class="form-control form-control-sm" id="seach">
                            <div class="input-group-append">
                                <button class="input-group-text" id="btn_seach">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <ul id="box_show_seach" class="position-absolute z-100">
                            </ul>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <?php
                        spinner_loading();
                        ?>
                        <table class="table list-table-wp table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th><span class="thead-text">STT</span></th>
                                    <th><span class="thead-text">Ảnh</span></th>
                                    <th><span class="thead-text">Họ và tên</span></th>
                                    <th><span class="thead-text">Tài Khoản</span></th>
                                    <th><span class="thead-text">Email</span></th>
                                    <th><span class="thead-text">Địa chỉ</span></th>
                                    <th><span class="thead-text">Số điện thoại</span></th>
                                    <th><span class="thead-text">Chức vụ</span></th>
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
        seach_item("?mod=sales&action=listCustomer");
        get_list_data("?mod=sales&action=listCustomer");
    })
</script>