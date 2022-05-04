<div class="manager_info_block mt-5">
    <div class="col-md-10 offset-md-2">
        <div class="row">
            <div class="col-md-3">
                <ul class="no_lst">
                    <li>Контейнеров за месяц</li>
                    <li>План - 300</li>
                    <li><b>Факт - 180</b></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="no_lst">
                    <li>Выручка за месяц</li>
                    <li>План - 80 000 000</li>
                    <li><b>Факт - 37 700 000</b></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="no_lst">
                    <li>Маржа за месяц</li>
                    <li>План - 12 000 000</li>
                    <li><b>Факт - 6 700 000</b></li>
                </ul>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-3">
                        <img data-toggle="dropdown" data-offset="0px,0px" class="manager_avatar" src="{{ $userManager->getUser()->getPhotoPath() }}" alt="">
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                            <!--begin: Head -->
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(/assets/media/misc/bg-1.jpg)">
                                <div class="kt-user-card__avatar">
                                    <img class="kt-hidden" alt="Pic" src="/assets/media/users/300_25.jpg" />

                                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                    <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">
                                            <img src="{{ $userManager->getUser()->getPhotoPath() }}" alt="">
                                        </span>
                                </div>
                                <div class="kt-user-card__name">
                                    {{ $userManager->getName() }}
                                </div>
                            </div>

                            <!--end: Head -->

                            <!--begin: Navigation -->
                            <div class="kt-notification">
                                <a href="{{ route('profile.edit') }}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Профиль
                                        </div>
                                    </div>
                                </a>

                                <div class="kt-notification__custom kt-space-between">
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf
                                        <button class="btn btn-label btn-label-brand btn-sm btn-bold" type="submit">Выход</button>
                                    </form>
                                </div>
                            </div>

                            <!--end: Navigation -->
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="no_lst">
                            <li>{{ $userManager->getName() }}</li>
{{--                            <li>Руководитель отдела ЖД перевозок</li>--}}
                            <li>+7 915 765 34 56</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
