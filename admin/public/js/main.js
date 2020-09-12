$(document).ready(function() {
    // responsive
    $("#btn-menu").click(function() {
        $(this).toggleClass("fa-times");
        $("#sidebar").toggleClass("btn-open hidden");
    })

    $(window).resize(function() {
        if ($(window).width() > 1024) {
            $(".btn-menu").removeClass("show");
            $("#sidebar").removeClass("btn-open");
            $("#btn-menu").removeClass("fa-times");
        }
    })

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

    //  CHECK ALL
    $('input[name="checkAll"]').click(function() {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

    // EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function() {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').stop().slideUp();
            $(this).parent('li').find('.sub-menu').stop().slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').stop().slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });

    // upload thumb
    $("#upload-thumb").change(function() {
        let url = URL.createObjectURL(this.files[0]);
        $("#uploadFile img").attr('src', url);
    })
});


function close_popup() {
    $("#popup-delete").removeClass('d-flex');
    $("popup-open").removeClass('popup-open');
}

function start_popup() {
    $("#popup-delete").addClass('d-flex');
    $("popup-open").addClass('popup-open');
}

/*
 * get list product 
 * url : là action controller product
 */
function get_list_data(url) {
    // Khắc phục tình trạng cho check box
    page = Number($("#list-paging .active").text());
    data = ({ 'seach': "", page: page });
    list_data(url, data);
    // seach
    $("#form-seach").submit(function() {
        let seach = $(this).find('#seach').val(),
            sort = $("#sort").val(),
            page = Number($("#list-paging .active").text()),
            data = ({ 'seach': seach, 'sort': sort, 'page': page });
        list_data(url, data);
        return false
    })

    // sort
    $("#sort").change(function() {
        let seach = $('#seach').val(),
            sort = $(this).val(),
            page = Number($("#list-paging .active").text()),
            data = ({ 'seach': seach, 'sort': sort, 'page': page });
        list_data(url, data);
    })


    // page
    $(document).on('click', '#list-paging li a', function() {
        var page = $(this).attr("data-action"),
            sort = $("#sort").val(),
            seach = $('#seach').val(),
            active = Number($("#list-paging .active").text());
        if (page == ">") {
            page = active + 1;
        } else if (page == "<") {
            page = active - 1;
        }
        data = ({ 'seach': seach, 'sort': sort, 'page': page });
        list_data(url, data);
        $('body, html').stop().animate({
            'scrollTop': 0
        }, 100)
        return false;
    })

    // data = seach làm điều kiện isset vì trong file xử lý có 2 ajax
    function list_data(url, data = ({ 'seach': "" })) {
        // hiệu ứng chờ load đẹp
        $("#loading").show();
        // $("#list_product").addClass("hide");
        $.ajax({
            url: url,
            method: "GET",
            data: data,
            dataType: 'json',
            success: function(data) {
                $("#list_data").html(data.send);
                $("#pagging").html(data.paginate);
                $("#loading").hide();
                $("#list").removeClass("hide");
            }
        })
    }
}

// seach hiển thị khung
function seach_item(url) {
    // show box seach
    $("#seach").keyup(function() {
            $("#box_show_seach").show();
            let seach = $(this).val();
            $.ajax({
                url: url,
                method: "GET",
                data: ({ 'box_seach': seach }),
                dataType: 'text',
                success: function(data) {
                    $("#box_show_seach").html(data);
                }
            })
        })
        // hidden box seach
    $("#box_show_seach li a").click(function() {
        return false;
    });
    $("#seach").blur(function() {
            $("#box_show_seach").hide();
        })
        // submit get data
}
/*
 * delete sider
 *
 * url : là action xóa
 *
 * refresh : là load danh sách hàm ajax
 */

function delete_data(url, refresh) {
    $(document).on('click', '#list_data .delete', function() {
        start_popup();
        let id = $(this).attr('data-id');
        // click ngoài sẽ đóng poup
        $("#popup-delete .btn-back,#popup-delete .popup-bg").click(function() {
                close_popup();
            })
            // click back sẽ đóng poup
        $("#popup-delete .btn-back").click(function() {
                close_popup();
            })
            // click đồng ý action và đóng poup
        $("#popup-delete .btn-accept").click(function() {
            close_popup();
            $.ajax({
                url: url,
                method: "GET",
                data: ({ 'id': id }),
                dataType: 'text',
                success: function(data) {
                    get_list_data(refresh);
                }
            })
        })
        return false;
    })
}

function toggel_status(url) {
    $(document).on('change', '#list_data .btn-toggle-status', function() {
        let status = $(this).prop('checked'),
            id = $(this).attr('data-id');
        $.ajax({
            url: url,
            method: "GET",
            data: ({ 'id': id, 'status': status }),
            dataType: 'json',
            success: function(data) {
                $(".post-status .show .count").text(data.show);
                $(".post-status .hiden .count").text(data.hide);
                get_list_data(url);
            }
        })
    })
}