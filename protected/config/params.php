<?php

// this contains the application parameters that can be maintained via GUI
return array(
    // this is displayed in the header section
    'title' => 'ATPP',
    // this is used in error pages
    'adminEmail' => 'm.gryaznov@new-techs.ru',
    // number of posts displayed per page
    'postsPerPage' => 10,
    // maximum number of comments that can be displayed in recent comments portlet
    'recentCommentCount' => 10,
    // maximum number of tags that can be displayed in tag cloud portlet
    'tagCloudCount' => 20,
    // whether post comments need to be approved before published
    'commentNeedApproval' => true,
    // the copyright information displayed in the footer section
    'copyrightInfo' => 'Copyright &copy; 2011 - 2012 by ATPP.',
    'smtp_params' => array(
        "host" => "smtp.yandex.ru",
        "user" => "atpp.16mb@yandex.ru",
        "password" => "7a8a7a8a"
    )
);
