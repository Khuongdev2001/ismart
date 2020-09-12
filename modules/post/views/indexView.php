<?php
get_header();
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $cat_title; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $cat_title; ?></h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        if (!empty($list_post)) {
                            foreach ($list_post as $item) {
                        ?>
                                <li class="clearfix">
                                    <a href="?mod=post&action=details&cat_id=<?php echo $cat_id; ?>&id=<?php echo $item['id'] ?>" title="" class="thumb fl-left">
                                        <img src="admin/<?php echo $item['thumb_post']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="?mod=post&action=details&cat_id=<?php echo $id; ?>&id=<?php echo $item['id'] ?>" title="" class="title"><?php echo $item['post_title']; ?></a>
                                        <span class="create-date"><?php echo $item['date_created']; ?></span>
                                        <span class="creator"><?php echo $item['creator']; ?></span>
                                        <p class="desc"><?php echo $item['post_desc']; ?></p>
                                    </div>
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <li>Hiện Chưa có bảng ghi nào</li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php
                    if (!empty($pagging))
                        echo $pagging
                    ?>
                </div>
            </div>
        </div>
        <?php
        get_sidebar('post');
        ?>
    </div>
</div>
<?php
get_footer();
