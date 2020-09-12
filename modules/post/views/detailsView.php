<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=post&cat_id=<?php echo $cat_id; ?>" title=""><?php echo $cat_title; ?></a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo  $post['post_title']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section shorten" id="detail-blog-wp">
                <?php
                if (!empty($post)) {
                ?>
                    <div class="section-head clearfix">
                        <h3 class="section-title"><?php echo $post['post_title']; ?></h3>
                    </div>
                    <div class="section-detail">
                        <span class="create-date"><?php echo $post['date_created']; ?></span>
                        <div class="detail">
                            <?php
                            echo $post['post_content'];
                            ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button id="see-more">Xem thêm</button>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
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
?>
<script>
    $(document).ready(function() {
        $("#see-more").click(function() {
            $("#detail-blog-wp").toggleClass("shorten");
            let content_btn = ['Thu nhỏ', 'Xem Thêm'],
                data = $("#detail-blog-wp").hasClass("shorten");
            $(this).text(content_btn[Number(data)])
        })
    })
</script>