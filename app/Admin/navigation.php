<?php

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\User::class)->setTitle('test')->setPages(function(Page $page) {
// 	  $page
//		  ->addPage()
//	  	  ->setTitle('Dashboard')
//		  ->setUrl(route('admin.dashboard'))
//		  ->setPriority(100);
//
//	  $page->addPage(\App\User::class);
// });
//
// // or
//
// AdminSection::addMenuPage(\App\User::class)

use SleepingOwl\Admin\Navigation\Page;

return [
    [
        'title' => __('sleeping_owl::lang.dashboard'),
        'icon'  => 'icon-speedometer',
        'url'   => route('admin.dashboard'),
        'priority' => 0,
    ],

    [
        'title' => 'System',
        'priority' => 900,
        'pages' => [
            [
                'title' => 'Access',
                'id' => 'access',
                'icon' => 'icon-people',
                'url' => '#',
                'pages' => [
        //            (new Page(\Penati\User::class)),
                    (new Page(\Silber\Bouncer\Database\Role::class))
                        ->setIcon('icon-key'),
                ],
            ],

            [
                'title' => 'Models',
                'icon' => 'icon-wrench',
                'priority' => 1020,
                'url'  => '#',
                'accessLogic' => function () {
                    return env('APP_DEBUG');
                },
                'pages' => [
                    [
                        'title' => 'Agents',
                        'icon' => 'icon-user',
                        'url'   => url('/_dev/agent'),
                    ],
                    [
                        'title' => 'Offers',
                        'icon' => 'icon-home',
                        'url'   => url('/_dev/offer'),
                    ],
                ],
            ],
        ],
    ],

//    // Examples
//     [
//        'title' => 'Content',
//        'pages' => [
//
//            \App\User::class,
//
//            // or
//
//            (new Page(\App\User::class))
//                ->setPriority(100)
//                ->setIcon('fa fa-user')
//                ->setUrl('users')
//                ->setAccessLogic(function (Page $page) {
//                    return auth()->user()->isSuperAdmin();
//                }),
//
//            // or
//
//            new Page([
//                'title'    => 'News',
//                'priority' => 200,
//                'model'    => \App\News::class
//            ]),
//
//            // or
//            (new Page(/* ... */))->setPages(function (Page $page) {
//                $page->addPage([
//                    'title'    => 'Blog',
//                    'priority' => 100,
//                    'model'    => \App\Blog::class
//			      ));
//
//			      $page->addPage(\App\Blog::class);
//    	      }),
//
//            // or
//
//            [
//                'title'       => 'News',
//                'priority'    => 300,
//                'accessLogic' => function ($page) {
//                    return $page->isActive();
//    		      },
//                'pages'       => [
//
//                    // ...
//
//                ]
//            ]
//        ]
//     ]
];
