<?php

namespace Rsu\Settings;


class Option
{
    protected static $settings;

    public static function get_fields()
    {
        if (! isset(self::$settings)) {
            self::$settings = get_option('rsu_theme_settings');
        }
        return self::$settings;
    }

    public static function get($key)
    {
        if (! isset(self::$settings)) {
            self::$settings = get_option('rsu_theme_settings');
        }
        return self::$settings[$key];
    }

    public static function get_image($key, $size = 'thumbnail')
    {
        return wp_get_attachment_image( self::get($key), $size );
    }

    public static function companyNameDesc()
    {
        return self::implode(' | ', ['company_name', 'company_description']);
    }

    public static function implode($glue, $keys)
    {
        return implode(
            $glue,
            array_map(function($key){
                return self::get($key);
            }, $keys)
        );
    }
}