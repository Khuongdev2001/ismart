$(document).ready(function() {
    // open phone
    document.querySelector("#advisory-wp").addEventListener('click', () => {
        let number_phone = document.querySelector("#call").textContent;
        window.open('tel:' + number_phone + '');
    })

    // lazy load img
    $(function() {
        $('.lazy').Lazy({
            threshold: 0,
        });
    });
    // // chat
    // $("#btn-open-chat,.btn-exit").click((e) => {
    //     console.log(e.target);
    //     $("#box-diglog").toggle(200);
    // })

    // // auto load
    // let url = "?mod=home&action=getChat";
    // $("#body-chat").load(url, ({ 'load': true }));
    // // insert 
    // $("#btn-send").click(() => {
    //     // check empty
    //     let mes_content = $("#input-chat").val();
    //     if (mes_content != "") {
    //         // ajax send
    //         let data = ({ 'insert': true, 'mes_content': mes_content })
    //         $.ajax({
    //             url: "?mod=home&action=getChat",
    //             method: "POST",
    //             dataType: "JSON",
    //             data: data,
    //             success: function(data) {
    //                 if (data.status) {
    //                     // reload meg new
    //                     $("#input-chat").val("");
    //                     let url = "?mod=home&action=getChat";
    //                     $("#body-chat").load(url, ({ 'load': true }));
    //                     start_audio("public/audio/sucess.mp3");
    //                 }
    //             }
    //         })
    //     }
    // })

    //  SLIDER
    var slider = $('#slider-wp .section-detail');
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  LIST THUMB
    var list_thumb = $('#list-thumb');
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  FEATURE PRODUCT
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SAME CATEGORY
    var same_category = $('#same-category-wp .list-item');
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SCROLL TOP
    $(window).scroll(function() {
        if ($(this).scrollTop() != 0) {
            $('#btn-top').stop().fadeIn(150);
        } else {
            $('#btn-top').stop().fadeOut(150);
        }
    });
    $('#btn-top').click(function() {
        $('body,html').stop().animate({ scrollTop: 0 }, 800);
    });

    // CHOOSE NUMBER ORDER
    var value = parseInt($('#num-order').attr('value'));
    $('#plus').click(function() {
        value++;
        $('#num-order').attr('value', value);
    });
    $('#minus').click(function() {
        if (value > 1) {
            value--;
            $('#num-order').attr('value', value);
        }
    });

    //  MAIN MENU
    $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');

    //  TAB
    tab();

    //  EVEN MENU RESPON
    $('html').on('click', function(event) {
        var target = $(event.target);
        var site = $('#site');

        if (target.is('#btn-respon i')) {
            if (!site.hasClass('show-respon-menu')) {
                site.addClass('show-respon-menu');
            } else {
                site.removeClass('show-respon-menu');
            }
        } else {
            $('#container').click(function() {
                if (site.hasClass('show-respon-menu')) {
                    site.removeClass('show-respon-menu');
                    return false;
                }
            });
        }
    });

    //  MENU RESPON
    $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
    $('#main-menu-respon li .arrow').click(function() {
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        } else {
            $(this).parent('li').addClass('open');
        }
    });

    function tab() {
        var tab_menu = $('#tab-menu li');
        tab_menu.stop().click(function() {
            $('#tab-menu li').removeClass('show');
            $(this).addClass('show');
            var id = $(this).find('a').attr('href');
            $('.tabItem').hide();
            $(id).show();
            return false;
        });
        $('#tab-menu li:first-child').addClass('show');
        $('.tabItem:first-child').show();
    }

});

// num order
function update_cart(data) {
    $("#loading").addClass("active");
    $.ajax({
        url: "?mod=cart&action=addCart",
        method: "POST",
        dataType: "json",
        data: data,
        success: function(data) {
            $("#loading").removeClass("active");
            // nêu data.qty underfind thì sẽ  (qty=0)
            if (data.status == 'reload') {
                location.reload();
            }
            $("input[data-id='" + data.id + "']").val(data.qty);
            $("span[data-id='" + data.id + "']").text(currency(data.sub_total));
            $("#total span").text(currency(data.total));
            $("#btn-cart span").text(data.num_order);
            start_audio("public/audio/sucess.mp3");
        }
    })
}
// giảm
function change_order() {
    $(".tbl-minus").click(function() {
            let qty = $(this).parent('td').children('.num-order').val();
            qty = Number(qty);
            if (!isNaN(qty)) {
                if (qty != 0) {
                    qty--;
                }
                // change data input
                $(this).parent('td').children('.num-order').val(qty);
                let id = $(this).parent('td').children('.num-order').attr('data-id'),
                    data = ({ 'update': true, "qty": qty, 'id': id });
                // process ajax
                update_cart(data);
            }
        })
        // tăng
    $(".tbl-plus").click(function() {
            // get data input
            let qty = $(this).parent('td').children('.num-order').val();
            qty = Number(qty);
            if (!isNaN(qty)) {
                qty++;
                // change data input
                $(this).parent('td').children('.num-order').val(qty);
                // xử lý ajax
                let id = $(this).parent('td').children('.num-order').attr('data-id'),
                    data = ({ 'update': true, "qty": qty, 'id': id });
                update_cart(data);
            }
        })
        // change
    $(".num-order").keyup(function() {
        let qty = $(this).val();
        qty = Number(qty);
        if (!isNaN(qty)) {
            let id = $(this).parent('td').children('.num-order').attr('data-id'),
                data = ({ 'update': true, "qty": qty, 'id': id });
            update_cart(data);
        } else {
            alert("cảnh báo");
            qty = "";
        }
        $(this).val(qty);
    })
}

// start audio
function start_audio(url) {
    let audio = new Audio(url);
    audio.play();
}
// add cart
$(document).on('click', '.add-cart', function() {
    let id = $(this).attr('data-id'),
        qty = 1;
    // nếu vào trang chi tiết thì sẽ lấy số qty trên
    if ($("#num-order").val() != undefined) {
        qty = Number($("#num-order").val());
    } // truyền dữ liệu
    if (!isNaN(qty)) {
        data = ({ 'id': id, 'qty': qty, 'add': true });
        // bật loading
        $("#loading").addClass("active");
        // ajax send
        $.ajax({
            url: "?mod=cart&action=addCart",
            method: "post",
            dataType: 'json',
            data: data,
            success: function(data) {
                $("#cart-wp #num").text(data.num_order);
                // tắt loading
                $("#loading").removeClass("active");
                // bật audio
                start_audio("public/audio/sucess.mp3")
            }
        })
    } else {
        // báo lỗi
        alert("nhập sai");
    }
    return false;
})

// hàm tiền tệ
function currency(number, currency = 'VND') {
    currency = new Intl.NumberFormat('de-DE', { style: 'currency', currency: currency }).format(number);
    return currency;
}

// get list producj by ajax
function public_ajax(url, data) {
    $.ajax({
        url: url,
        method: "GET",
        dataType: 'json',
        data: data,
        success: function(data) {
            $("#pagging").html(data.paginate);
            console.log(data);
            if (data.send !== false) {
                let products = "";
                for (let i = 0; i < data.send.length; i++) {
                    let product = data.send[i],
                        qty_selled = product.qty.qty_selled,
                        qty = product.qty.qty,
                        process_sold = (qty_selled / qty) * 100,
                        percentage_discount;
                    products += "<li>";
                    if (product.price_old > 0) {
                        products += "<div class='label-discount'>";
                        percentage_discount = product.price_old - product.price;
                        percentage_discount = (percentage_discount / product.price_old) * -100;
                        products += Math.ceil(percentage_discount);
                        products += "<span>%<span>";
                        products += "</div>";
                    }
                    products += "<a href='?mod=product&action=details&slug=" + product.slug + "&cat_id=" + product.cat_id + "'' title='' class='thumb'>";
                    products += "<img src='admin/" + product.thumbnail + "' alt='" + product.title + "'></a>";
                    products += "<a href='?mod=product&action=details&slug=" + product.slug + "&cat_id=" + product.cat_id + "' title='' class='product-name'>" + product.title + "</a>";
                    products += "<div class='price'>";
                    products += "<span class='new'>" + currency(product.price) + "</span>";
                    products += "<span class='old'>" + currency(product.price_old) + "</span>";
                    products += "</div>";
                    products += "<div class='status_product'>";
                    products += "<span class='percent load' style='width:" + process_sold + "%'></span><span class='number'>Đã Bán:" + qty_selled;
                    products += "</span>";
                    products += "</div>";
                    products += "<div class='box-star'>";
                    // loop star
                    for ($i = 1; $i <= 5; $i++) {
                        let class_active = '';
                        if ($i <= Number(product.star))
                            class_active = 'active';
                        products += "<i class='fas fa-star " + class_active + "'></i>";
                    }
                    products += "</div>";
                    products += "<div class='action  text-center clearfix'>";
                    products += "<a href='?page=cart' title='Thêm giỏ hàng' class='add-cart' data-id='" + product.id + "'>Thêm giỏ hàng</a>";
                    products += "</div>";
                    products += "</li>";
                }
                $("#list_data").html(products);
                return false;
            }
            $("#list_data").html("<p>Hiện không có bản ghi nào</p>");
        }
    })
}
// order by
function order_by() {
    let order = $("#order_by").val();
    return order;
}
// seach by
function seach_data() {
    let seach = $("#seach").val();
    return seach;
}

// filter by
function filter_data(class_name = "") {
    let filter;
    $("." + class_name + ":checked").each(function() {
        filter = $(this).attr("id");
    })
    return filter;
}

// price by
function price_data() {
    let low_price = Number($("#low-price").val()),
        up_price = Number($("#upper-price").val());
    if (low_price >= up_price) {
        // alert("lỗi");
    } else {
        let price = ({
            'low_price': low_price,
            'up_price': up_price
        })
        return price;
    }
}

// set data tạo này thì dễ không gọi lại nhiều lần
function set_data(page = "") {
    if (page == "")
        page = $("#list-paging .active").text();
    let seach = seach_data(),
        sort = order_by(),
        star = filter_data("filter-star"),
        brand = filter_data("filter-brand"),
        price = price_data(),
        data = ({ 'seach': seach, 'sort': sort, 'price': price, 'star': star, 'brand': brand, 'page': page, 'auto_load': true });
    return data;
}

function get_list_data(url) {
    // load đầu tiên
    data = ({
        'auto_load': true,
    })
    public_ajax(url, data);
    // seach
    $("#box-seach").submit(function() {
            public_ajax(url, set_data());
            return false;
        })
        // sort
    $("#order_by").change(function() {
            public_ajax(url, set_data());
        })
        // star
    $(".filter-star").click(function() {
            public_ajax(url, set_data());
        })
        // brand
    $(".filter-brand").click(function() {
            public_ajax(url, set_data());
        })
        // price
    $("#btn-apply").click(function() {
            public_ajax(url, set_data());
        })
        // pagging
    $(document).on('click', '#list-paging li a', function() {
        page = $(this).attr("data-action");
        active = Number($("#list-paging .active").attr("data-action"));
        if (page == ">") {
            page = active + 1;
        } else if (page == "<") {
            page = active - 1;
        }
        public_ajax(url, set_data(page));
        return false;
    })
}

function reply_comment(parent_id = "", id = "") {
    // id là id người đã comment
    // id product
    document.querySelector(".btn-reply").addEventListener('click', function(e) {
        let content = document.querySelector("#modal-comment .content").value;
        if (content.length != "") {
            let data = ({ 'parent_id': parent_id, 'product_id': id, 'content': content, 'status': true });
            $.ajax({
                url: "?mod=product&action=replyComment",
                method: "POST",
                dataType: "JSON",
                data: data,
                success: function(data) {
                    if (data.status) {
                        location.reload();
                    } else {
                        alert("thất bại");
                    }
                }
            })
        }
        e.preventDefault();
    })
}