<?php

if (!class_exists('Neuethemes_vCardPageManager'))
{
    class Neuethemes_vCardPageManager
    {
        public static function create($page, $isPublic = false)
        {
            if ($page->exists()) return;

            $arr = array(
                'post_content' => $page->defaultContent,
                'post_name' => $page->name,
                'post_title' => $page->title,
                'post_status' => $isPublic ? 'publish' : 'private',
                'post_type' => 'page',
                'ping_status' => 'closed',
                'comment_status' => 'closed',
            );

            $result = wp_insert_post($arr);
            if ($result === false)
                throw new ErrorException("Error occurred while creating '$page->title'");
        }

        public static function show($page)
        {
            $arr = get_page_by_title($page->title);

            echo do_shortcode($arr->post_content);
        }
}
}
