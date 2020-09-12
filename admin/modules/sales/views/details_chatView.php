<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div id="box-chat">
                <div id="box-diglog">
                    <div id="top-chat" class="clearfix">
                        <h4 id="receiver" class="float-left"><?php echo $fullname; ?></h4>
                        <span id="call" class="float-right"><i class="fas fa-phone-alt"></i></span>
                    </div>
                    <ul id="body-chat">

                    </ul>
                    <div id="footer-chat">
                        <textarea name="" cols="20" rows="1" Resize="none" id="input-chat" placeholder="Tin nhắn"></textarea>
                        <a id="btn-send"><i class="fas fa-paper-plane"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<script>
    // auto load
    let url = "?mod=sales&controller=chat&action=getChat";
    $("#body-chat").load(url, ({
        'load': true
    }));
    // insert 
    $("#btn-send").click(() => {
        // check empty
        let mes_content = $("#input-chat").val();
        if (mes_content != "") {
            // ajax send
            let data = ({
                'insert': true,
                'mes_content': mes_content
            })
            $.ajax({
                url: "?mod=sales&controller=chat&action=getChat",
                method: "POST",
                dataType: "JSON",
                data: data,
                success: function(data) {
                    if (data.status) {
                        // reload meg new
                        $("#input-chat").val("");
                        let url = "?mod=sales&controller=chat&action=getChat";
                        $("#body-chat").load(url, ({
                            'load': true
                        }));
                        // start_audio("public/audio/sucess.mp3");
                    }
                }
            })
        }
    })
</script>