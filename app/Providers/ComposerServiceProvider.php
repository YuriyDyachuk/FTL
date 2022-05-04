<?php

namespace App\Providers;

use App\Models\UserManager;
use App\User;
use Auth;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $userManager = new UserManager();
            $sidebarMenu = $this->createSidebarMenu(new UserManager());

            view()->share('userManager', $userManager);
            view()->share('sidebarMenu', $sidebarMenu);
        });
    }

    private function createSidebarMenu(UserManager $userManager)
    {
        $menu = [];
        if(!$userManager->getUser()){
            return $menu;
        }

        $menu[] = $this->createTestsMenu();



        if($userManager->can('lead_view')){
            $menu[] = [
                'text'        => 'Сделки',
                'icon'        => 'fas fa-book',
                'submenu' => [
                    [
                        'text' => 'ЖД',
                        'icon' => 'fas fa-train',
                        'url' => 'leads/tr/index'
                    ],
                    [
                        'text' => 'Авто',
                        'icon' => 'fas fa-truck',
                        'url' => 'leads/car/index'
                    ],
                    [
                        'text' => 'Склад Заявки без Сделки',
                        'icon' => 'fas fa-warehouse',
                        'url' => 'singleorders'
                    ]
//                    [
//                        'text' => 'Склад',
//                        'icon' => 'fas fa-warehouse',
//                        'url' => 'leads/wh/index'
//                    ]
                ]
            ];
        }
        if($userManager->can('client_request_view')){
            $menu[] = [
                'text' => 'Клиентские Заявки',
                'icon' => 'far fa-id-card',
                'submenu' => [
                    [
                        'text' => 'ЖД',
                        'icon' => 'fas fa-train',
                        'url' => 'clientrequests/tr/index'
                    ],
                    [
                        'text' => 'Авто',
                        'icon' => 'fas fa-truck',
                        'url' => 'clientrequests/car/index'
                    ],
//                    [
//                        'text' => 'Склад',
//                        'icon' => 'fas fa-warehouse',
//                        'url' => 'clientrequests/wh/index'
//                    ]
                ]
            ];
        }
        if($userManager->can('client_view')){
            $menu[] = [
                'text' => 'Клиенты',
                'icon' => 'fas fa-users',
                'url' => 'clients'
            ];
        }
        $ordersMenu = $this->getOrdersMenu($userManager);
        if(!blank($ordersMenu)){
            $menu[] = [
                'text'        => 'Заявки',
                'icon'        => 'fas fa-bars',
                'submenu' => $ordersMenu
            ];
        }

        $tasksMenu = $this->getTasksMenu($userManager);
        if(!blank($tasksMenu)){
            $menu[] = [
                'text'        => 'Задачи в отделы',
                'icon'        => 'fas fa-tasks',
                'submenu' => $tasksMenu
            ];
        }

        if($userManager->hasRole('admin')){
            $menu[] = [
                'text' => 'Справочники',
                'icon' => 'fas fa-bars',
                'submenu' => [
                    [
                        'text'        => 'Тип Груза',
                        'url'         => 'cargotypes',
                        'icon'        => 'fas fa-book',
                    ],
                    [
                        'text' => 'Тип КТК',
                        'icon' => 'far fa-folder',
                        'url' => 'ktktypecatalog'
                    ],
                    [
                        'text' => 'Размеры фасовок',
                        'icon' => 'far fa-folder',
                        'url' => 'packingsizecatalog'
                    ],
                    [
                        'text' => 'Пользователи',
                        'icon' => 'fas fa-users-cog',
                        'url' => 'users'
                    ],
                    [
                        'text' => 'Роли',
                        'icon' => 'fas fa-user-tag',
                        'url' => 'roles'
                    ],
                    [
                        'text' => 'Разрешения',
                        'icon' => 'fas fa-directions',
                        'url' => 'permissions'
                    ],
                ]
            ];
        }

//        $menu[] = [
//            'text'        => 'Груз',
//            'url'         => 'gettingactcargo',
//            'icon'        => 'fas fa-book',
//        ];

//        $menu[] = [
//            'text'        => 'Акт приема',
//            'url'         => 'gettingact',
//            'icon'        => 'fas fa-book',
//        ];

        $menu[] = [
            'text'        => 'Склад Груз',
            'url'         => 'warehousecargo',
            'icon'        => 'fas fa-book',
        ];

//        $menu[] = [
//            'text'        => 'Тип Груза',
//            'url'         => 'cargotypes',
//            'icon'        => 'fas fa-book',
//        ];

        return $menu;
    }

    private function getOrdersMenu(UserManager $userManager)
    {
        $menu = [];
        if(array_intersect($userManager->getRoles(), ['admin', 'tr_logistics', 'tr_chief'])){
            $menu[] = [
                'text' => 'ЖД',
                'icon' => 'fas fa-train',
                'url' => 'trainorders'
            ];
        }
        if(array_intersect($userManager->getRoles(), ['admin', 'wh_loader', 'wh_chief'])){
            $menu[] = [
                'text' => 'Склад',
                'icon' => 'fas fa-warehouse',
                'url' => 'warehouseorders'
            ];
        }
        if(array_intersect($userManager->getRoles(), ['admin', 'car_dispatcher', 'car_chief'])){
            $menu[] = [
                'text' => 'Авто',
                'icon' => 'fas fa-truck',
                'url' => 'carorders'
            ];
        }

        return $menu;
    }

    private function getTasksMenu(UserManager $userManager)
    {
        $menu = [];
        if(array_intersect($userManager->getRoles(), ['admin', 'tr_logistics'])){
            $menu[] = [
                'text' => 'ЖД',
                'icon' => 'fas fa-train',
                'url' => 'tasks/tr'
            ];
        }

        if(array_intersect($userManager->getRoles(), ['admin', 'wh_loader'])){
            $menu[] = [
                'text' => 'Склад',
                'icon' => 'fas fa-warehouse',
                'url' => 'tasks/wh'
            ];
        }

        if(array_intersect($userManager->getRoles(), ['admin', 'car_dispatcher'])){
            $menu[] = [
                'text' => 'Авто',
                'icon' => 'fas fa-truck',
                'url' => 'tasks/car'
            ];
        }

        return $menu;
    }

    private function createTestsMenu()
    {
        return [
            'text' => 'Тесты',
            'icon' => 'fas fa-book',
            'submenu' => [
                [
                    'text' => 'Все тесты',
                    'icon' => 'fas fa-book',
                    'url' => 'tests/allTests/index'
                ],
                [
                    'text' => 'Страницы',
                    'icon' => 'fas fa-book',
                    'submenu' => [
                        [
                            'text' => 'Страница Логина',
                            'icon' => 'fas fa-train',
                            'url' => 'tests/loginPage/index'
                        ],
                    ]
                ],
                [
                    'text' => 'Автоматизация Заявок',
                    'icon' => 'fas fa-book',
                    'submenu' => [
                        [
                            'text' => 'ЖД',
                            'icon' => 'fas fa-train',
                            'url' => 'tests/automationOrders/index'
                        ],
                    ]
                ],
                [
                    'text' => 'Заявки',
                    'icon' => 'fas fa-book',
                    'submenu' => [
                        [
                            'text' => 'Клиентские Заявки',
                            'icon' => 'fas fa-train',
                            'url' => 'tests/clientRequest/index'
                        ],
                        [
                            'text' => 'ЖД',
                            'icon' => 'fas fa-train',
                            'url' => 'tests/trainOrder/index'
                        ],
                    ]
                ]
            ]
        ];
    }
}
