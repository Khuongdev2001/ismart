<?php
// 25-6-2020
function construct()
{
    load_model('index');
}

function loginAction()
{
    if (isset($_POST['btn_login'])) {
        global $error, $username, $password;
        $error = array();
        // username
        if (empty($_POST['username'])) {
            $error['username'] = "Bạn Không được để trống Tài Khoản";
        } else {
            if (is_lenght($_POST['username'])) {
                if (is_username($_POST['username'])) {
                    $username = $_POST['username'];
                }
            } else {
                $error['username'] = "Độ dài không phù hợp. Tối thiểu 6 ký tự";
            }
        }
        // password
        if (empty($_POST['password'])) {
            $error['password'] = "Bạn Không được để trống Mật Khẩu";
        } else {
            if (is_lenght($_POST['password'])) {
                if (is_password($_POST['password'])) {
                    $password = md5($_POST['password']);
                }
            } else {
                $error['password'] = "Độ dài không phù hợp. Tối thiểu 6 ký tự";
            }
        }
        if (empty($error)) {
            $check_login = check_login($username, $password);
            if (!empty($check_login)) {
                $user = $check_login;
                // set data session
                session_login($user);
                // rediction done login
                redirect_to(base_url("?mod=dashboard"));
            } else {
                $error['login'] = "Bạn không có quyền truy cập";
            }
        }
    };
    load_view('login');
}

function updateAction()
{
    #set data view
    $user = session_login();
    global $fullname, $username, $phone, $address, $thumbnail, $error, $email, $thumbnail;
    # set value
    $fullname = $user['fullname'];
    $username = $user['username'];
    $email = $user['email'];
    $phone = $user['phone'];
    $address = $user['address'];
    $thumbnail = $user['thumbnail'];
    $id = get_id_user_login_by_email($email);
    if (isset($_POST['btn_update'])) {
        $error = [];
        $user = $_POST;
        # fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống Họ và tên !";
        } else {
            if (strlen($_POST['fullname']) > 5) {
                $fullname = $_POST['fullname'];
            } else {
                $error['fullname'] = "Độ dài không thỏa mản";
            }
        }
        # username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống Tài Khoản !";
        } else {
            if (is_lenght($_POST['username'])) {
                if (is_username($_POST['username'])) {
                    $username = $_POST['username'];
                } else {
                    $error['username'] = "Định dạng không phù hợp Tài khoản không chứa ký tự đặt biệt";
                }
            } else {
                $error['username'] = "Độ dài không thỏa mản";
            }
        }
        # email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email !";
        } else {
            if (is_lenght($_POST['email'])) {
                if (is_email($_POST['email'])) {
                    $email = $_POST['email'];
                } else {
                    $error['email'] = "Định dạng không phù hợp Email";
                }
            } else {
                $error['email'] = "Độ dài không thỏa mản";
            }
        }
        #phone
        if (empty($_POST['phone'])) {
            $error['phone'] = "Không được để trống Số Điện Thoại !";
        } else {
            if (is_lenght($_POST['phone'])) {
                if (is_numberphone($_POST['phone'])) {
                    $phone = $_POST['phone'];
                } else {
                    $error['phone'] = "Định dạng không phù hợp Số Điện Thoại";
                }
            } else {
                $error['phone'] = "Độ dài không thỏa mản";
            }
        }
        #address
        if (is_lenght_address($_POST['address'])) {
            $address = $_POST['address'];
        } else {
            $error['address'] = "Địa chỉ lớn hơn 10 ký tự";
        }
        $user['thumbnail'] = $thumbnail;
        # upload file
        if (!empty($_FILES['thumbnail']['name'][0]) && empty($error)) {
            $dir_upload = "public/images/users/";
            if (file_exists($thumbnail)) {
                unlink($thumbnail);
            }
            $user['thumbnail'] = multiple_upload('thumbnail', $dir_upload, 'admin')[0];
        }

        if (empty($error)) {
            // xóa trường btn_update
            unset($user['btn_update']);
            // notification success
            update_user($id, $user);
            // update session
            session_login($user);
            redirect_to('?mod=user&action=update');
        }
    }
    load_view('update_account');
}


function changPassAction()
{
    if (isset($_POST['btn_change'])) {
        global $error;
        # pass old
        $error = [];
        if (empty($_POST['pass_old'])) {
            $error['pass_old'] = "Bạn Không được để trống ô này";
        } else {
            if (is_lenght($_POST['pass_old'])) {
                if (is_password($_POST['pass_old'])) {
                    $pass_old = md5($_POST['pass_old']);
                } else {
                    $error['pass_old'] = "Mật khẩu viết hoa đầu tiên";
                }
            } else {
                $error['pass_old'] = "Độ dài tối thiểu 6 tối đa 30";
            }
        }
        # pass old
        if (empty($_POST['pass_new'])) {
            $error['pass_new'] = "Bạn Không được để trống ô này";
        } else {
            if (is_lenght($_POST['pass_new'])) {
                if (is_password($_POST['pass_new'])) {
                    $pass_new = md5($_POST['pass_new']);
                } else {
                    $error['pass_old'] = "Mật khẩu phải viết hoa đầu tiên";
                }
            } else {
                $error['pass_new'] = "Độ dài tối thiểu 6 tối đa 30";
            }
        }
        # confirm pass
        $confirm_pass = md5($_POST['confirm_pass']);
        # check password exist system
        if (empty($error)) {
            $email = session_login()['email'];
            $id = get_id_user_login_by_email($email);
            if (check_password_login($id, $pass_old)) {
                if ($pass_new == $confirm_pass) {
                    change_pass($id, $pass_new);
                } else {
                    $error['change_pass'] = "Mật khẩu mới không khớp với nhau";
                }
            } else {
                $error['change_pass'] = "Không tìm thấy mật khẩu trên hệ thống";
            }
        }
    }
    load_view('change_pass');
}

function logoutAction()
{
    session_destroy();
    redirect_to("?mod=user&action=login");
}
