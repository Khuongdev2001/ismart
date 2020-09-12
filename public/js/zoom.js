// function zoom() {
//     let img = $("#main-thumb"),
//         lens = $("#lens"),
//         result = $("#result"),
//         src = $("#img").attr('src');
//     // xet độ rộng cao phù hợp với hình bên result vì không có nội dung
//     result.height(img.height())
//     result.width(img.width())
//         // lấy tỉ lệ giữa result có thể cân chỉnh độ phóng đại theo ý thích 1 là k phóng đại
//     cy = result.outerHeight() / lens.outerHeight();
//     cx = result.outerWidth() / lens.outerWidth();
//     result.css("background", "url('" + src + "')");
//     result.css("background-size", cx * img.outerWidth() + "px " + cy * img.outerHeight() + "px");
//     $("#img,#lens").mousemove(function(e = 0) {
//         /* Để khung lên nằm giữa trong con trỏ*/
//         x = e.pageX
//         y = e.pageY
//         console.log(x, y);
//         /* Nếu lens vược quá kích thước theo chiều dương thì xet vị trí max*/
//         // if (x > img.outerWidth() - lens.outerWidth()) {
//         //     x = img.outerWidth() - lens.outerWidth();
//         // }
//         // if (y > img.outerHeight() - lens.outerHeight()) {
//         //     y = img.outerHeight() - lens.outerHeight();
//         // }
//         // /* Nếu lens left âm tức ra bên ngoài trái thì xet nó =0*/
//         // if (x < 0) {
//         //     x = 0
//         // }
//         // /* Nếu lens top âm tức ra bên ngoài top thì xet nó =0*/
//         // if (y < 0) {
//         //     y = 0
//         // }
//         lens.css({
//             left: x,
//             top: y
//         })
//         $("#result").css("background-position", -x * cx + "px " + -y * cy + "px");
//     })
// }