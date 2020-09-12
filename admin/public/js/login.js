$(document).ready(function() {
    // kiểm tra từng phần tử nào có giá trị sẽ addClass active
    $(".form-group input").each(function() {
        if ($(this).val() != "") {
            $(this).parent('.form-group').find('.label_field').addClass('active');
        }
    });
    // action
    $('.form-group input').focus(function() {
        $(this).parent('.form-group').find('.label_field').addClass('active')
    });
    $('.form-group input').blur(function() {
        if ($(this).val() != "") {
            $(this).parent('.form-group').find('.label_field').addClass('active')
        } else {
            $(this).parent('.form-group').find('.label_field').removeClass('active')
        }
    })
})