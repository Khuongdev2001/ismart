<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('index');
}


// function getChatAction()
// {
//     // load
//     if (!empty($_POST['load'])) {
//         if (empty(is_login())) {
//             $mes = "<li>Đăng nhập để Thực hiện chức năng này</li>";
//             $mes .= "<li class='login'><a href='?mod=user&action=login'>Đăng Nhập</a></li>";
//             $mes .= "<li class='reg'><a href='?mod=user&action=reg'>Đăng Ký</a></li>";
//             echo $mes;
//         } else {
//             $custormer = $_SESSION['info']['id'];
//             $data_mes = get_data_mes($custormer);
//             if (!empty($data_mes)) {
//                 $mes = "";
//                 foreach ($data_mes as $item) {
//                     $class = "mes-receive";
//                     # Convert sender and reviced
//                     if ($item['sender_id'] == $custormer)
//                         $class = "mes-send";
//                     $mes .= "<li class='mes-diglog'>";
//                     $mes .= "<div class='{$class}'><a href=''><img src='' alt=''></a>";
//                     $mes .= "<span class='mes-content'>" . $item['mes_content'] . "</span>";
//                     $mes .= "</div></li>";
//                 }
//                 echo $mes;
//             };
//         }
//     }
//     // insert database
//     if (!empty($_POST['insert']) && !empty(is_login())) {
//         $mes_content = vali_string($_POST['mes_content']);
//         $sender_id = $_SESSION['info']['id'];
//         $recevier_id = 1;
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
