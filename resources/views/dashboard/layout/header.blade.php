
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " style="direction: ltr;">


    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">مرحبا ,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{ auth('admin')->user()->name }}</span>
                    <img class="kt-hidden" alt="Pic" src="{{ asset('dashboardAssets') }}/media/users/300_25.jpg" />

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ strtoupper(auth('admin')->user()->name[0])  }}</span>
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" >
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden" alt="Pic" src="{{ asset('dashboardAssets') }}/media/users/300_25.jpg" />

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ strtoupper(auth('admin')->user()->name[0])  }}</span>
                    </div>
                    <div class="kt-user-card__name">
                        {{ strtoupper(auth('admin')->user()->name)  }}
                    </div>

                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">

                    <a href="{{ route('admin.showSettings') }}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-gear kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                اعدادت الحساب
                            </div>

                        </div>
                    </a>
                    <div class="kt-notification__custom kt-space-between">
                        <a href="{{ route('admin.logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold">تسجيل خروج</a>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>

