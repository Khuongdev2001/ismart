<?php
get_header();
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="float-left">Danh sách danh mục</h3>
                    <div class="add-cat-post my-3" id="ajax" data-id="ajax-post">
                        <a href="<?php echo base_url("?mod=post&action=addCat"); ?>" title="Thêm Danh Mục" id="add-cat-post" class="bg-success text-light p-2"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <?php
                echo nav_status(1, 2, 3);
                ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="table-responsive position-relative">
                            <?php
                            spinner_loading();
                            ?>
                            <table class="table list-table-wp my-4">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tên Danh mục</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">slug</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody id="list_data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="section">
                    <div class="section-detail clearfix" id="pagging">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            get_list_data("?mod=post&action=getCatPostAjax");
        })
    </script>
    <?php

    get_footer();
