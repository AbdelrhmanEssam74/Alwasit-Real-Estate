<?php

function lang($text)
{
    static $lang = array(
        'home' => 'الرئيسية',
        'login' => 'الدخول',
        'logout' => 'الخروج',
        'register' => 'التسجيل',
        'admin' => 'لوحة الإدارة',
        'profile' => 'الصفحة الشخصية',
    );
    return $lang[$text];
}
