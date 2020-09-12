<?php
function construct()
{
    load_model("index");
}

function loginAction()
{
    if (isset($_POST['btn_login'])) {
        global $error, $username, $password;
        $error = array();
        // username
        // check empty field username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống Tài Khoản";
            // check length field username
        } else {
            if (is_lenght($_POST['username'])) {
                // check format username
                if (is_username($_POST['username'])) {
                    $username = vali_string($_POST['username']);
                }
                // add error if no accpect
            } else {
                $error['username'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        // password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống Mật Khẩu";
        } else {
            if (is_lenght($_POST['password'])) {
                if (is_password($_POST['password'])) {
                    $password = md5($_POST['password']);
                }
            } else {
                $error['password'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        if (empty($error)) {
            // check login user and get user. return array info user
            $user = check_login($username, $password);
            if ($user) {
                // update session login
                session_login($user);
                // kiểm tra có phải từ checkout đẩy quả k nếu có sẽ về checkout
                if(!empty($_SESSION['checkout'])){
                    redirect_to('?mod=cart&action=checkout');
                    die;
                }
                redirect_to('?mod=home');
            }
            $error['login'] = "Hệ thống không tìm thấy tài khoản của bạn";
        }
    };
    load_view("login");
}
function logoutAction()
{
    // delete all session
    session_destroy();
    redirect_to(base_url("?mod=home"));
}
function regAction()
{
    if (isset($_POST['btn_reg'])) {
        // validition
        global $error, $fullname, $email, $address, $numberphone, $username, $password, $token;
        $error = array();
        # username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống Tài Khoản";
        } else {
            if (is_lenght($_POST['username'])) {
                if (is_username($_POST['username'])) {
                    $username = vali_string($_POST['username']);
                }
            } else {
                $error['username'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        # password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống Mật Khẩu";
        } else {
            if (is_lenght($_POST['password'])) {
                if (is_password($_POST['password'])) {
                    $password = md5($_POST['password']);
                } else {
                    $error['password'] = "Mật khẩu viết hoa đầu tiên";
                }
            } else {
                $error['password'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        # fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống tên";
        } else {
            if (is_lenght($_POST['fullname'])) {
                $fullname = vali_string($_POST['fullname']);
            } else {
                $error['fullname'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        # address
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống địa chỉ";
        } else {
            if (strlen($_POST['address']) > 4) {
                $address = vali_string($_POST['address']);
            } else {
                $error['address'] = "Độ dài Tối thiểu 4 ký tự";
            }
        }
        # email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống mail";
        } else {
            if (is_lenght($_POST['email'])) {
                if (is_email($_POST['email'])) {
                    $email = $_POST['email'];
                }
            } else {
                $error['email'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        # number_phone
        if (empty($_POST['numberphone'])) {
            $error['numberphone'] = "Không được để trống số điện thoại";
        } else {
            if (is_lenght($_POST['numberphone'])) {
                if (is_numberphone($_POST['numberphone'])) {
                    $numberphone = vali_string($_POST['numberphone']);
                }
            } else {
                $error['numberphone'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        # token
        if (empty($_POST['token'])) {
            $error['token'] = "Không được Mã xác nhận";
        } else {
            if (is_lenght($_POST['token'])) {
                $token = vali_string($_POST['token']);
            } else {
                $error['token'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        if (empty($error)) {
            // check email và token  matching 
            if (!in_array($email, $_SESSION['reg']) || !in_array($token, $_SESSION['reg'])) {
                $error['reg'] = "Mã xác nhận không tồn tại";
            }
        }
        // add
        if (empty($error)) {
            $data_reg = array(
                'fullname' => $fullname,
                'email' => $email,
                'address' => $address,
                'number_phone' => $numberphone,
                'role_id' => 3,
                'date_created' => get_date_now(),
                'username' => $username,
                'password' => $password
            );
            add_user($data_reg);
            redirect_to("?mod=user&action=login");
            unset($_SESSION['reg']);
        }
    }
    load_view('reg');
}
function sendTokenAction()
{
    $send_token = $_POST['send_token'];
    $email = $_POST['email'];
    if ($send_token && !empty($send_token)) {
        $response = [];
        if (is_email($_POST['email'])) {
            // check mail exits
            $email = $_POST['email'];
            if (!user_exist($email)) {
                $token = set_token();
                $_SESSION['reg'] = array(
                    'email' => $email,
                    'token' => $token
                );
                $content = '<p><span style="color:#ff8c00;"><strong><span style="font-size:22px;">Bạn c&oacute; y&ecirc;u cầu đăng k&yacute; t&agrave;i khoản v&agrave;o&nbsp;' . get_date_now() . '</span></strong></span></p>

                <p><span style="font-size: 18px;"><b><strike>' . $token . '</strike></b></span>&nbsp; l&agrave; m&atilde; x&aacute;c nhận của bạn v&agrave; c&oacute; hiệu lực 15 ph&uacute;t</p>
                
                <p><em>ISMART ch&uacute;c bạn c&oacute; một ng&agrave;y tuyệt vời</em></p>
                ';

                if (send_email(sender,mail, 'Khách hàng', $email, "hello", $content)) {
                    // respon send success
                    $response['status'] = true;
                    echo json_encode($response);
                }
            } else {
                $response['email'] = "email đã tồn tại";
                echo json_encode($response);
            }
        } else {
            $response['email'] = "sai định dạng";
            echo json_encode($response);
        }
    }
}
