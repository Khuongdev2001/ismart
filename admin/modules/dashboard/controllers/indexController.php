<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $data = [
        'number_post' => get_num_post(),
        'number_product' => get_num_product(),
        'number_order' => get_num_order(),
        'number_user' => get_num_user()
    ];
    load_view('index', $data);
}
