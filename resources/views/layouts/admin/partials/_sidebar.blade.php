<div id="sidebarMain" class="d-none">
    <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container text-capitalize">
            <div class="navbar-vertical-footer-offset">
                <div class="navbar-brand-wrapper justify-content-between">
                    <!-- Logo -->
                    @php($roles=\App\Model\EmployeeRole::where('admin_id', auth('admin')->user()->id)->first())
                    @php($admin=\App\Model\Admin::where('id', auth('admin')->user()->id)->first())
                    @php($store_logo=\App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value)
                    <a class="navbar-brand" aria-label="Front">
                        <img class="navbar-brand-logo" onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'" src="{{asset('storage/app/public/store/'.$store_logo)}}" alt="Logo">
                        <img class="navbar-brand-logo-mini" onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'" src="{{asset('storage/app/public/store/'.$store_logo)}}" alt="Logo">
                    </a>
                    <!-- End Logo -->

                    <!-- Navbar Vertical Toggle -->
                    <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin')?'show':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('admin.dashboard')}}" title="Dashboards">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.dashboard')}}
                                </span>
                            </a>
                        </li>


                    <!--Start of orders section-->

                        <li class="nav-item">
                            <small class="nav-subtitle">{{trans('messages.order')}} {{trans('messages.section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                       
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/orders*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-shopping-cart nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.order')}}
                                </span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/order*')?'block':'none'}}">


                                <li class="nav-item {{Request::is('admin/orders/list/all')?'active':''}}">
                                    <a class="nav-link" href="{{route('admin.orders.list',['all'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.all')}}
                                            <span class="badge badge-info badge-pill ml-1">
                                                {{\App\Model\Order::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/orders/list/pending')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['pending'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.pending')}}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'pending'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/orders/list/accepted')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['accepted'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.Accepted')}}
                                            <span class="badge badge-soft-success badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'accepted'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/orders/list/arrived')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['arrived'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.Arrived')}}
                                            <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'arrived'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/orders/list/finished')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['finished'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.Finished')}}
                                            <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'finished'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/orders/list/canceled')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['canceled'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.Canceled')}}
                                            <span class="badge badge-soft-dark badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'canceled'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            
                            </ul>
                        </li>
                    <!-- End of orders section -->



                    <!-- Start of Banner section-->
                        <li class="nav-item">
                            <small class="nav-subtitle">{{trans('messages.Banner')}} {{trans('messages.section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/banner*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-image nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.banner')}}</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/banner*')?'block':'none'}}">

                                <li class="nav-item {{Request::is('admin/banner/list')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.banner.list')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{trans('messages.list')}}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    <!-- End of Banner section-->

                       


                        

                        <!-- Pages -->
                       
                        <!-- End Pages -->



                        <!-- SERVICes -->
                       
                        <!-- End SERVICW -->


                        <!-- Pages -->
                        
                    
                    <!-- End Pages -->


                    <!-- Pages -->
                    
                    <!-- End Pages -->
                    <!-- Pages -->
                   
                    <!-- End Pages -->


                    

                    <!-- Pages -->
                    
                    <!-- End Pages -->



                    <!-- Pages -->
                   
                    <!-- End Pages -->


                    <!-- Notifications -->
                   

                    <!-- End Pages -->

                    <!-- Pages -->
                    
                    <!-- End Pages -->
                   
                    @if($roles->business_section == 1)


                        <li class="nav-item">
                            <small class="nav-subtitle" title="Layouts">{{trans('messages.business')}} {{trans('messages.section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="nav-item {{Request::is('admin/business-settings/store-setup')?'active':''}}">
                            <a class="nav-link " href="{{route('admin.business-settings.store-setup')}}">
                                <span class="tio-circle nav-indicator-icon"></span>
                                <span class="text-truncate">Settings</span>
                            </a>
                        </li>

                        <!-- Pages -->
                       
                        <!-- End Pages -->



                        <!-- Notifications -->
                       
                        <!-- End Pages -->

                        <!-- Pages -->
                        
                        <!-- End Pages -->

                        <!-- Pages -->
                       
                    <!-- End Pages -->
                    @endif

                    <!-- Start Zones -->
                   
                    <!-- End Zones -->



                    
                    <!-- Start of Customer section -->
                        <li class="nav-item">
                            <small class="nav-subtitle" title="Documentation">{{ trans('messages.customer') }} {{ trans('messages.section') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/customer*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-poi-user nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ trans('messages.customer') }}</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{ Request::is('admin/customer*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/customer/list') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.customer.list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ trans('messages.list') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <!-- End of Customer section -->




                    <!-- Start of Premium Plans section -->
                        <li class="nav-item">
                            <small class="nav-subtitle" title="Documentation">{{ trans('messages.Premium-plans') }} {{ trans('messages.section') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/Premium-plans*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-poi-user nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ trans('messages.Premium-plans') }}</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{ Request::is('admin/Premium-plans*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/Premium-plans/list') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.premium-plans.list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ trans('messages.list') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <!-- End of Premium Plans section -->



                    <!-- Start of Subscriptions section -->
                        <li class="nav-item">
                            <small class="nav-subtitle" title="Documentation">{{ trans('messages.Subscriptions') }} {{ trans('messages.section') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/subscription*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-poi-user nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ trans('messages.Subscriptions') }}</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{ Request::is('admin/subscription*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/subscription/list') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.subscription.list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ trans('messages.list') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <!-- End of Subscriptions section -->



                    <!-- Start of dispute section-->
                        <li class="nav-item">
                                <small class="nav-subtitle" title="Documentation">{{ trans('messages.Disputes') }} {{ trans('messages.section') }}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/dispute*') ? 'active' : '' }}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                    <i class="tio-poi-user nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ trans('messages.Disputes') }}</span>
                                </a>

                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{ Request::is('admin/dispute*') ? 'block' : 'none' }}">
                                    <li class="nav-item {{ Request::is('admin/dispute/list') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('admin.dispute.list') }}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{ trans('messages.list') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                    <!-- End of dispute section-->




                    <!-- Start of review section-->
                    <li class="nav-item">
                                <small class="nav-subtitle" title="Documentation">{{ trans('messages.Reviews') }} {{ trans('messages.section') }}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/review*') ? 'active' : '' }}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                    <i class="tio-poi-user nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ trans('messages.Reviews') }}</span>
                                </a>

                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{ Request::is('admin/review*') ? 'block' : 'none' }}">
                                    <li class="nav-item {{ Request::is('admin/review/list') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('admin.review.list') }}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{ trans('messages.list') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                    <!-- End of review section-->







                    <li class="nav-item">
                        <div class="nav-divider"></div>
                    </li>

                    <li class="nav-item">
                        <small class="nav-subtitle" title="Documentation">{{trans('messages.report_and_analytics')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>


                    <!-- Pages -->
                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/report*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                            <i class="tio-report-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.reports')}}</span>
                        </a>

                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/report*')?'block':'none'}}"></ul>
                    </li>
                    <!-- End Pages -->


                    <li class="nav-item" style="padding-top: 100px">
                        <div class="nav-divider"></div>
                    </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>

<div id="sidebarCompact" class="d-none">

</div>



{{--<script>
    $(document).ready(function () {
        $('.navbar-vertical-content').animate({
            scrollTop: $('#scroll-here').offset().top
        }, 'slow');
    });
</script>--}}