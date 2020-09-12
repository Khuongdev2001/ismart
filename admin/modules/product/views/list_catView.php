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
                    <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                    <a href="<?php echo base_url("?mod=product&action=addCat"); ?>" title="" id="add-new" class="fl-left btn-add"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <?php
            echo nav_status(1, 2, 3);
            ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <?php
                        spinner_loading();
                        ?>
                        <table class="table list-table-wp my-4 table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th><span class="thead-text">STT</span></th>
                                    <th><span class="thead-text">Tiêu đề</span></th>
                                    <th><span class="thead-text">Trạng thái</span></th>
                                    <th><span class="thead-text">slug</span></th>
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
        get_list_data("?mod=product&action=getCatProudctAjax");
    })
</script>