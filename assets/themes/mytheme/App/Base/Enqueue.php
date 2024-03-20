<?php

namespace App\Base;

final class Enqueue
{

    /**
     * @var string|null
     */


    public function __construct()
    {
        add_action('wp_enqueue_scripts', [self::class, 'enqueueStylesScripts']);
        //		add_action( 'wp_enqueue_scripts', [ self::class, 'enqueueScripts' ] );
        add_action('admin_enqueue_scripts', [self::class, 'admin_styles']);
    }

    public static function admin_styles()
    {

        wp_enqueue_style(
            "admin-style",
            get_template_directory_uri() . '/assets/admin-script-style/admin.css',
            false,
            1.0,
        );
    }

    public function enqueueStylesScripts()
    {
        $namespace = 'mytheme';

        $page = get_page_template_slug();

        switch ($page) {
            case is_front_page():
                $style_asset = include get_parent_theme_file_path('assets/webpack-dist/css/home.asset.php');

                wp_enqueue_style(
                    $namespace . '-home',
                    get_parent_theme_file_uri('assets/webpack-dist/css/home.css'),
                    $style_asset['dependencies'],
                    $style_asset['version']
                );

                $script_asset = include get_parent_theme_file_path('assets/webpack-dist/js/home.asset.php');

                wp_enqueue_script(
                    $namespace . '-home',
                    get_parent_theme_file_uri('assets/webpack-dist/js/home.js'),
                    ['jquery'],
                    $script_asset['version'],
                );

                break;
            default:
                if (is_404()) {
                    $style_asset = include get_parent_theme_file_path('assets/webpack-dist/css/404.asset.php');

                    wp_enqueue_style(
                        $namespace . '-404',
                        get_parent_theme_file_uri('assets/webpack-dist/css/404.css'),
                        $style_asset['dependencies'],
                        $style_asset['version']
                    );

                    $script_asset = include get_parent_theme_file_path('assets/webpack-dist/js/404.asset.php');

                    wp_enqueue_script(
                        $namespace . '-404',
                        get_parent_theme_file_uri('assets/webpack-dist/js/404.js'),
                        ['jquery'],
                        $script_asset['version'],
                    );
                }
                break;
        }
    }


    public static function fileTimeJsCss($fileName, $typeCssOrJS)
    {
        switch ($typeCssOrJS) {
            case "css":
                return filemtime(get_theme_file_path('/assets/css/' . $fileName . '.min.css'));
                break;
            case "js":
                return filemtime(get_theme_file_path('/assets/js/' . $fileName . '.min.js'));
                break;
            default:
                return '1';
        }
    }
}
