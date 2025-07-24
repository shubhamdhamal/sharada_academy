<?php
namespace App\Controllers;
use App\Controllers\App_Controller;
class Assets extends App_Controller {
    function __construct() {
        parent::__construct();
    }
    public function error_404() {
        $page_data = array();
        $page_data['page_title'] = 'page_not_found';
        $page_data['page_name'] = 'error_404';
        $page_data['Crud_model'] = $this->Crud_model;
        echo home_view('index',$page_data);
    }
    public function robots() {
        $this->response->setHeader('Content-Type', 'text/plain');
        echo 'User-agent: *
        Disallow: 
        Disallow: /cgi-bin/
        Disallow: /admin/
        Sitemap: '.home_site_url('sitemap.xml');
    }
    public function offline() {
        $details = app_setting('app_pwa_details','[]');
        $details = !empty(json_decode($details)) ? json_decode($details) : array();

        $html='<!doctype html>
        <html lang="'.app_setting("app_language","en").'">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>'.translate('sorry!').'</title>
                <link rel="icon" href="'.uploads_url('favicon.png').'" type="image/x-icon"/>
                <style>
                    body {
                        font-family: sans-serif;
                        font-size: 1.25em;
                        margin: 3em 3em 0 3em;
                        text-align: center;
                    }      
                    .offline-icon {
                        position: absolute;
                        top:0;
                        left: 0;
                        max-width: 100vw;
                        max-height: 100vh;
                        opacity: 0.2;
                        animation-duration: 1200ms;
                        animation-name: blink;
                        animation-iteration-count: infinite;
                        animation-direction: alternate;
                        -webkit-animation:blink 1200ms infinite; /* Safari and Chrome */
                    }
                    @keyframes blink {
                        from {
                            fill:'.app_setting('app_primary_color').';
                        }
                        to {
                            fill:'.app_setting('app_secondary_color').'
                        }
                    }
                    @-webkit-keyframes blink {
                        from {
                            fill:'.app_setting('app_primary_color').';
                        }
                        to {
                            fill:'.app_setting('app_secondary_color').'
                        }
                    }
                    .button {
                        background-color: #ffffff;
                        border: 2px solid '.app_setting('app_primary_color').';
                        color: '.app_setting('app_secondary_color').';
                        border-radius: 12px;
                        padding: 16px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        margin: 4px 2px;
                        transition-duration: 0.4s;
                        cursor: pointer;
                    }
                </style>
            </head>
            <body>
                <h1 style="color:'.app_setting('app_primary_color').'">'.translate('sorry!').'</h1>
                <p style="color:'.app_setting('app_secondary_color').'">'.translate('we_were_unable_to_load_the_page_you_requested.').'</p>
                <p style="color:'.app_setting('app_secondary_color').'">'.translate('please_check_your_network_connection_and_try_again.').'</p>
                <svg class="offline-icon" viewBox="0, 0, 24, 24"><g><path d="M23.64 7c-.45-.34-4.93-4-11.64-4-1.5 0-2.89.19-4.15.48L18.18 13.8 23.64 7zm-6.6 8.22L3.27 1.44 2 2.72l2.05 2.06C1.91 5.76.59 6.82.36 7l11.63 14.49.01.01.01-.01 3.9-4.86 3.32 3.32 1.27-1.27-3.46-3.46z"></path></g></svg>
                <script>
                    document.querySelector("button").addEventListener("click", () => {
                        window.location.reload();
                    });
                    window.addEventListener("online", () => {
                        window.location.reload();
                    });
                    async function checkNetworkAndReload() {
                        try {
                            const response = await fetch(".");
                            if (response.status >= 200 && response.status < 500) {
                                window.location.reload();
                                return;
                            }
                        } catch { }
                        /*window.setTimeout(checkNetworkAndReload, 15000);*/
                    }
                    /*checkNetworkAndReload();*/
                </script>
            </body>            
        </html>';
        return $html;
    }
    public function manifest() {
        $details = app_setting('app_pwa_details','[]');
        $details = !empty(json_decode($details)) ? json_decode($details) : array();

        $sizes = array('192'=>'pwa-192x192','256'=>'pwa-256x256','384'=>'pwa-384x384','512'=>'pwa-512x512');
        $temp = array();
        $temp['src'] = uploads_url('favicon.png');
        $temp['sizes'] = '512x512';
        $temp['type'] = 'image/png';
        $icons[] = (object)$temp;
        foreach ($sizes as $key => $value) {
            $temp = array();
            $temp['src'] = uploads_url($value.'.png','pwa.png');
            $temp['sizes'] = $key.'x'.$key;
            $temp['type'] = 'image/png';
            $icons[] = (object)$temp;
        }
        $manifest = array();
        $manifest['dir'] = app_setting("app_rtl","off")=='off' ? 'ltr' : 'rtl';
        $manifest['lang'] = app_setting('app_language');
        $manifest['name'] = isset($details->name) ? $details->name : app_setting('app_title');
        $manifest['short_name'] = isset($details->short_name) ? $details->short_name : app_setting('app_short_title');
        $manifest['scope'] = home_site_url();
        $manifest['display'] = isset($details->display) ? $details->display : 'standalone';
        $manifest['start_url'] = home_site_url();
        $manifest['background_color'] = isset($details->backgroundr) ? $details->backgroundr : '#ffffff';
        $manifest['theme_color'] = isset($details->theme) ? $details->theme : app_setting('app_primary_color');
        $manifest['description'] = isset($details->description) ? $details->description : app_setting('seo_description');
        $manifest['orientation'] = isset($details->orientation) ? $details->orientation : 'any';
        $manifest['url'] = home_site_url();
        $manifest['icons'] = $icons;
        $manifest['screenshots'] = array();
        $manifest['related_applications'] = array();
        $manifest['prefer_related_applications'] = false;
        echo encode_json($manifest);exit;
    }
    public function service_worker() {
        $details = app_setting('app_pwa_details','[]');
        $details = !empty(json_decode($details)) ? json_decode($details) : array();

        $this->response->setHeader('Content-Type', 'text/javascript');
        echo 'var staticCacheName = "'.$details->cache_name.'-" + new Date().getTime();
        var filesToCache = [';
            $sizes = array('192'=>'pwa-192x192','256'=>'pwa-256x256','384'=>'pwa-384x384','512'=>'pwa-512x512','pwa'=>'pwa','favicon'=>'favicon');
            foreach ($sizes as $key => $value) {
                echo '"'.strtolower(preg_replace('/index.php.*/', '', $_SERVER['SCRIPT_NAME'])).'writable/uploads/'.$value.'.png",';
            }
            echo '"'.home_site_url('offline').'"';
        echo '];
        // Cache on install
        self.addEventListener("install", event => {
            this.skipWaiting();
            event.waitUntil(
                caches.open(staticCacheName)
                    .then(cache => {
                        return cache.addAll(filesToCache);
                    })
            )
        });
        // Clear cache on activate
        self.addEventListener("activate", event => {
            event.waitUntil(
                caches.keys().then(cacheNames => {
                    return Promise.all(
                        cacheNames
                            .filter(cacheName => (cacheName.startsWith("abGorad-")))
                            .filter(cacheName => (cacheName !== staticCacheName))
                            .map(cacheName => caches.delete(cacheName))
                    );
                })
            );
        });
        // Serve from Cache
        self.addEventListener("fetch", event => {
            event.respondWith(
                caches.match(event.request)
                    .then(response => {
                        return response || fetch(event.request);
                    })
                    .catch(() => {
                        return caches.match("offline");
                    })
            )
        });';
    }
    public function pwa_js() {
        $this->response->setHeader('Content-Type', 'text/javascript');
        echo "if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('".home_site_url("service-worker.js")."', {
                    scope: '".strtolower(preg_replace("/index.php.*/", "", $_SERVER['SCRIPT_NAME']))."'
                }).then(function (registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function (err) {
                    console.log('ServiceWorker registration failed: ', err);
                });
            }";
    }
    public function admin_root_css() {
        $this->response->setHeader('Content-Type', 'text/css');
        if(app_setting('app_disable_google_font')!='on'){
            echo '@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap");';
        }
        /*:root{
            --primary-color : <?php echo app_setting('app_primary_color'); ?>;
            --primary-color-dark : <?php echo app_setting('app_primary_color_dark'); ?>;
            --secondary-color : <?php echo app_setting('app_secondary_color'); ?>;
            --secondary-color-dark : <?php echo app_setting('app_secondary_color_dark'); ?>;
        }*/
        echo ':root {
            --primary-bg-color: '.app_setting('app_color').';
            --primary-bg-hover: #7c59e6;
            --primary-bg-border: #8c68f8;
            --dark-primary-hover: #233ac5;
            --primary-transparentcolor: #eaedf7;
            --darkprimary-transparentcolor: #2b356e;
            --transparentprimary-transparentcolor: rgba(255, 255, 255, 0.05);
        }';
        echo 'var filemanager_url="'.home_site_url('filemanager/dialog.php').'"';
    }
    public function admin_root_js() {
        $this->response->setHeader('Content-Type', 'text/javascript');
        echo 'var filemanager_url="'.home_site_url('filemanager/dialog.php').'"';
    }
    public function sitemap() {
        $this->response->setHeader('Content-Type', 'text/xml');
        $page_data = array();
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('sitemap',$page_data);
    }
}