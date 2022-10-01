<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link">
        <span class="app-brand-logo demo">
          <img src="{{ asset('assets/admin/images/logo/'.$setting->logo) }}" alt="" style="width: 40px;">
        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ $setting->brand_text }}</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

      <!-- Start Dashboard -->

      <li class="menu-item {{ Request::is('user/dashboard*') ? 'active' : '' }}">
        <a href="{{ route('user.dashboard.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">{{__('Dashboard')}}</div>
        </a>
      </li>

      <li class="menu-item {{ Request::is('user/order*') ? 'active' : '' }}">
        <a href="{{ route('user.order.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-right-arrow"></i>
          <div data-i18n="Analytics">{{__('Order')}}</div>
        </a>
      </li>

      <li class="menu-item {{ Request::is('user/ticket*') ? 'active' : '' }}">
        <a href="{{ route('user.ticket.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-message-rounded"></i>
          <div data-i18n="Analytics">{{__('Ticket')}}</div>
        </a>
      </li>

      <li class="menu-item {{ Request::is('user/profile*') ? 'active' : '' }}">
        <a href="{{ route('user.profile.edit', Auth::guard('web')->user()->id) }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-user"></i>
          <div data-i18n="Analytics">{{__('Profile')}}</div>
        </a>
      </li>

      <li class="menu-item {{ Request::is('user/reset/password*') ? 'active' : '' }}">
        <a href="{{ route('user.reset.password', Auth::guard('web')->user()->id) }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-reset"></i>
          <div data-i18n="Basic">{{ __('Password Reset')}}</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="{{ route('user.logout') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Basic">{{__('Logout')}}</div>
        </a>
      </li>

      <!--End Dashboard -->

    </ul>
  </aside>