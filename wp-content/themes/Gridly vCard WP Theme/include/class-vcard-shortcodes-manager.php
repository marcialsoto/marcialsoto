<?php

if (!class_exists('vCardShortsodesManager'))
{
    class Neuethemes_vCardShortcodesManager
    {
        public static function registerShortcodes($shortcodes)
        {
            foreach($shortcodes as $shortcode)
            {
                add_shortcode($shortcode->name, array($shortcode,'execute'));
            }
        }
    }
}
