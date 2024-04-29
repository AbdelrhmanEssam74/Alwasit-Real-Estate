<?php

function lang($text)
{
  static $lang = array(
    // Navbar Links
    'HOME_ADMIN'    => 'Alwasit',
    'CATEGORIES'    => 'Sections',
    'ITEMS'         => 'Properties',
    'MEMBERS'       => 'Members',
    'COMMENTS'      => 'Comments',
    'STATISTICS'    => 'Statistics',
    'LOGS'          => 'Logs',
    'Owners'          => 'Owners',
  );
  return $lang[$text];
}
