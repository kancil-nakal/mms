<?php

function is_logged_in()
{
    $ci = get_instance();
    $user_session = $ci->session->userdata('email');
    if (!$user_session) {
        redirect('auth');
    }
}
// function is_logged_in()
// {
//     $ci = &get_instance();
//     $user_session = $ci->session->userdata('user_id');
//     if ($user_session) {
//         redirect('dashboard');
//     }
// }

function is_not_logged_in()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('user_id');
    if (!$user_session) {
        redirect('auth');
    }
}

function check_level()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    $level = $ci->fungsi->user_login()->id_role;
    if ($level == 4) {
        redirect('dashboard');
    }
}
function check_admin_level()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    $level = $ci->fungsi->user_login()->id_role;
    if ($level != 1) {
        redirect('dashboard');
    }
}

function indo_currency($nominal)
{
    $hasil = 'Rp. ' . number_format($nominal, 0, ',', '.');
    return $hasil;
}

function indo_date($date)
{
    $d = substr($date, 8, 2);
    $m = substr($date, 5, 2);
    $y = substr($date, 0, 4);
    return $d . '/' . $m . '/' . $y;
}


function integerToRoman($integer)
{
    // Convert the integer into an integer (just to make sure)
    $integer = intval($integer);
    $result = '';

    // Create a lookup array that contains all of the Roman numerals.
    $lookup = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    );

    foreach ($lookup as $roman => $value) {
        // Determine the number of matches
        $matches = intval($integer / $value);

        // Add the same number of characters to the string
        $result .= str_repeat($roman, $matches);

        // Set the integer to be the remainder of the integer and the value
        $integer = $integer % $value;
    }

    // The Roman numeral should be built, return it
    return $result;
}
