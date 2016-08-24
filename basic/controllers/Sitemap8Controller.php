<?php
namespace app\controllers;

use \mrssoft\sitemap\Sitemap;

class Sitemap8Controller extends \mrssoft\sitemap\SitemapController
{

    /**
     * @var int Cache duration, set null to disabled
     */
    protected $cacheDuration = null; // default 12 hour

    /**
     * @var string Cache filename
     */
    protected $cacheFilename = 'sitemap8.xml';

    public function models()
    {
        //set_time_limit(6000);
        return [
            [
                'class' => \app\models\Sitemap8::className(),
                'change' => Sitemap::MONTHLY,
                'priority' => 0.8
            ]
        ];
    }

    public function urls()
    {
        return [
            
        ];
    }
}