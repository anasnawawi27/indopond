<?php

if (!function_exists('alert_message')) {

    function alert_message($type, $message)
    {
        $message = '<div class="alert alert-' . $type . ' alert-dismissible fade show mt-3 text-left" role="alert">' . $message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
        return $message;
    }
}

if (!function_exists('number')) {

    function number($val, $currDecimalDigit = 2, $currSymbol = '')
    {
        return $currSymbol . number_format($val, $currDecimalDigit, ',', '.');
    }
}

if (!function_exists('rupiah')) {

    function rupiah($val)
    {
        $value = number($val, 0);
        return 'Rp ' . $value;
    }
}

if (!function_exists('settings')) {

    function settings($key)
    {
        if ($key) {
            $session = service('session');
            if ($session->has('settings')) {
                return $session->get('settings')[$key];
            } else {
                $db = \Config\Database::connect();
                $settings = $db->table('settings')->get()->getResult();
                foreach ($settings as $setting) {
                    $data[$setting->key] = $setting->value;
                }
                $session->set('settings', $data);
                return $data[$key];
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('set_password')) {

    function set_password(string $password)
    {
        $config = config('Auth');
        $hashOptions = [
            'cost' => $config->hashCost
        ];
        $setPasswordUser = password_hash(base64_encode(hash('sha384', $password, true)), $config->hashAlgorithm, $hashOptions);
        return $setPasswordUser;
    }
}

if (!function_exists('input_filter')) {

    function input_filter($arrayData)
    {
        foreach ($arrayData as $key => $data) {
            if ($data == '') {
                $arrayData[$key] = NULL;
            }
        }
        return $arrayData;
    }
}

if (!function_exists('encode')) {

    function encode($string)
    {
        $encrypter = service('encrypter');
        return bin2hex($encrypter->encrypt($string));
    }
}

if (!function_exists('decode')) {

    function decode($string)
    {
        $encrypter = service('encrypter');
        return $encrypter->decrypt(hex2bin($string));
    }
}

if (!function_exists('in_groups')) {
    function in_groups($group)
    {
        $db = db_connect();
        $builder = $db->table('auth_groups_users a');
        $builder->join('auth_groups b', 'b.id = a.group_id', 'left');
        $builder->where(['a.user_id' => user_id(), 'b.name' => $group]);
        $data = $builder->find();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('setting')) {
    function setting($key)
    {
        $db = db_connect();
        $builder = $db->table('settings')->select('*')->where('key', $key);

        $result = $builder->get()->getRow();
        return $result ? $result : null;
    }
}

// if (!function_exists('html_escape')) {
//     function html_escape($var, bool $doubleEncode = true)
//     {
//         if (is_array($var)) {
//             foreach ($var as $key => $value) {
//                 $var[$key] = html_escape($value, $doubleEncode);
//             }
//             return $var;
//         }

//         return htmlspecialchars($var, ENT_QUOTES, 'UTF-8', $doubleEncode);
//     }
// }
