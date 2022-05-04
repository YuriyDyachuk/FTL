<?php


namespace App\Models\Helpers;


class MenuHelper
{
    public static function buildMenu(array $menuList, $isSub = false)
    {
        $ulClass = $isSub ? 'kt-menu__subnav' : 'kt-menu__nav';
        if($isSub){
            echo '<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>';
        }
        echo '<ul class="'.$ulClass.'">';
        foreach ($menuList as $item)
        {
            $liClass = isset($item['submenu']) ? 'kt-menu__item  kt-menu__item--submenu' : 'kt-menu__item';
            $isActive = isset($item['url']) && \Route::current()->uri() == $item['url'] ? 'kt-menu__item--active' : '';
            $submenuToggle = isset($item['submenu']) ? 'data-ktmenu-submenu-toggle="hover"' : '';
            echo '<li '.$submenuToggle.' class="'.$liClass.' '.$isActive.'">';
            if(empty($item['submenu'])){
                echo '<a href="/'.$item['url'].'" class="kt-menu__link "><span class="kt-menu__link-icon '.$item['icon'].'"></span><span class="kt-menu__link-text">'.$item['text'].'</span></a>';
            }else{
                echo '<a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon '.$item['icon'].'"></span><span class="kt-menu__link-text">'.$item['text'].'</span></a>';
            }
            if (!empty($item['submenu']))
            {
                self::buildMenu($item['submenu'], true);
            }
            echo '</li>';
        }
        echo '</ul>';
        if($isSub){
            echo '</div>';
        }
    }

}
