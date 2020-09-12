<?php

function construct()
{
    load_model('chat');
}

function detailsChatAction()
{
    $id = intval($_GET['id']);
    $fullname = get_customer_by_id($id);
    // error action redirect to
    $_SESSION['mes']['customer'] = $id;
    if (empty($fullname))
        redirect_to("?mod=sales");
    $data = [
        'fullname' => $fullname
    ];
    load_view('details_chat', $data);
}

// function getChatAction()
// {
//     // auto load
//     if (!empty($_POST['load'])) {
//         if (empty(is_login())) {
//             $chat = "<li>Đăng nhập để Thực hiện chức năng này</li>";
//             $chat .= "<li class='login'><a href='?mod=user&action=login'>Đăng Nhập</a></li>";
//             $chat .= "<li class='reg'><a href='?mod=user&action=reg'>Đăng Ký</a></li>";
//             echo $chat;
//         } else {
//             $custormer = get_info_login_session('id');
//             $data_mes = get_data_mes($custormer);
//             if (!empty($data_mes)) {
//                 $chat = "";
//                 foreach ($data_mes as $item) {
//                     $class = "mes-receive";
//                     // Convert
//                     if ($item['sender_id'] == $custormer)
//                         $class = "mes-send";
//                     $chat .= "<li class='mes-diglog'><div class='{$class}'>";
//                     $chat .= "<a href=''><img src='' alt=''></a>";
//                     $chat .= "<span class='mes-content'>" . $item['mes_content'] . "</span>";
//                     $chat .= "</div></li>";
//                 }
//                 echo $chat;
//             };
//         }
//     }
//     // insert database
//     if (!empty($_POST['insert']) && !empty(is_login())) {
//         $mes_content = vali_string($_POST['mes_content']);
//         $sender_id = get_info_login_session('id');
//         $recevier_id = $_SESSION['mes']['customer'];
//         $date_created = get_date_now();
//         // set up date mes
//         $date_mes = array(
//             'sender_id' => $sender_id,
//             'recevier_id' => $recevier_id,
//             'mes_content' => $mes_content,
//             'date_created' => $date_created
//         );
//         add_mes($date_mes);
//         // responle success
//         echo json_encode(array('status' => true));
//     }
// }
