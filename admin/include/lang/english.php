<?php

function lang($text)
{
    static $lang = array(
        // Navbar Links
        'HOME_ADMIN'    => 'Alwasit',
        'CATEGORIES'    => 'Sections',
        'ITEMS'         => 'Items',
        'MEMBERS'       => 'Members',
        'COMMENTS'      => 'Comments',
        'STATISTICS'    => 'Statistics',
        'LOGS'          => 'Logs',
    );
    return $lang[$text];
}
