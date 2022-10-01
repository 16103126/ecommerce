@php
    $role = explode(', ', Auth::guard('admin')->user()->role->permission);
@endphp

@if (Auth::guard('admin')->user()->id != 1)
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('assets/admin/images/logo/'.$setting->logo) }}" alt="" style="width: 40px;">
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">{{$setting->brand_text}}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <!-- Start Dashboard -->

    <li class="menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">{{__('Dashboard')}}</div>
      </a>
    </li>

    <!------------------ Manage Category --------------------->

    @if (in_array('manage category', $role))
    <li class="menu-item {{ Request::is('admin/category*') ? 'active  open' : '' }} {{ Request::is('admin/childcategory*') ? 'active open' : '' }} {{ Request::is('admin/subcategory*') ? 'active open' : '' }}" style="">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-category"></i>
        <div data-i18n="Layouts">{{__('Manage Category')}}</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item {{ Request::is('admin/category*') ? 'active' : '' }}">
          <a href="{{ route('admin.category.index') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Main Category')}}</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('admin/subcategory*') ? 'active' : '' }}">
          <a href="{{ route('admin.subcategory.index') }}" class="menu-link">
            <div data-i18n="Without navbar">{{__('Sub Category')}}</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('admin/childcategory*') ? 'active' : '' }}">
          <a href="{{ route('admin.childcategory.index') }}" class="menu-link">
            <div data-i18n="Container">{{__('Child Category')}}</div>
          </a>
        </li>
      </ul>
    </li>
    @endif

    <!------------------ Manage Product --------------------->

    @if (in_array('manage product', $role))
    <li class="menu-item {{ Request::is('admin/product*') ? 'active' : '' }}">
      <a href="{{ route('admin.product.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxl-product-hunt"></i>
        <div data-i18n="Basic">{{ __('Manage Product')}}</div>
      </a>
    </li>
    @endif

     <!------------------ Manage Order --------------------->

     @if (in_array('manage order', $role))
     <li class="menu-item {{ Request::is('admin/order*') ? 'active  open' : '' }} {{ Request::is('admin/all/order*') ? 'active open' : '' }} {{ Request::is('admin/pending/order*') ? 'active open' : '' }} {{ Request::is('admin/complete/order*') ? 'active open' : '' }}" style="">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-right-arrow"></i>
        <div data-i18n="Layouts">{{__('Manage Order')}}</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item {{ Request::is('admin/all/order*') ? 'active' : '' }}">
          <a href="{{ route('admin.all.order') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('All order')}}</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('admin/pending/order*') ? 'active' : '' }}">
          <a href="{{ route('admin.pending.order') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Pending order')}}</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('admin/complete/order*') ? 'active' : '' }}">
          <a href="{{ route('admin.complete.order') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Complete order')}}</div>
          </a>
        </li>
      </ul>
    </li>
     @endif

    <!------------------ Manage User--------------------->

    @if (in_array('manage user', $role))
    <li class="menu-item {{ Request::is('admin/user*') ? 'active' : '' }}">
      <a href="{{ route('admin.user.list') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-user"></i>
        <div data-i18n="Basic">{{ __('User List')}}</div>
      </a>
    </li>
    @endif

    <!------------------ Manage Language --------------------->

    @if (in_array('manage language', $role))
    <li class="menu-item {{ Request::is('admin/frontendlanguage*') ? 'active  open' : '' }} {{ Request::is('admin/adminlanguage*') ? 'active  open' : '' }}">

      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class='menu-icon tf-icons bx bxs-select-multiple'></i>
        <div data-i18n="Layouts">{{__('Manage Language')}}</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item {{ Request::is('admin/adminlanguage*') ? 'active' : '' }}">
          <a href="{{ route('admin.adminlanguage.index') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Admin Pannel Language')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/frontendlanguage*') ? 'active' : '' }}">
          <a href="{{ route('admin.frontendlanguage.index') }}" class="menu-link">
            <div data-i18n="Without navbar">{{__('Website Language')}}</div>
          </a>
        </li>
      </ul>
    </li>
    @endif

    <!------------------ Setting --------------------->

    @if (in_array('setting', $role))
    <li class="menu-item {{ Request::is('admin/setting*') ? 'active  open' : '' }}">

      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class='menu-icon bx bxs-brightness'></i>
        <div data-i18n="Layouts">{{__('Setting')}}</div>
      </a>

      <ul class="menu-sub">

        <li class="menu-item {{ Request::is('admin/setting/favicon*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.favicon', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Favicon')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/logo*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.logo', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Logo')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/brand-text*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.brand.text', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Brand Text')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/frontend-title*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.frontend.title.update', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Frontend Title')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/user-title*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.user.title.update', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('User Title')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/backend-title*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.backend.title.update', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Backend Title')}}</div>
          </a>
        </li>

      </ul>
    </li>
    @endif

    <!------------------ Manage Payement --------------------->

    @if (in_array('manage payment', $role))
    <li class="menu-item {{ Request::is('admin/payment*') ? 'active  open' : '' }} {{ Request::is('admin/currency*') ? 'active  open' : '' }}">

      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class='menu-icon bx bxs-badge-dollar'></i>
        <div data-i18n="Layouts">{{__('Manage Payment')}}</div>
      </a>

      <ul class="menu-sub">
        
        <li class="menu-item {{ Request::is('admin/payment*') ? 'active' : '' }}">
          <a href="{{ route('admin.payment.index') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Payment')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/currency*') ? 'active' : '' }}">
          <a href="{{ route('admin.currency.index') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Currency')}}</div>
          </a>
        </li>

      </ul>
    </li>
    @endif

    <!------------------ Mail Setting --------------------->

    @if (in_array('mail setting', $role))
    <li class="menu-item">
      <a href="{{ route('admin.mail.setting', 1) }}" class="menu-link {{ Request::is('admin/mail*') ? 'active' : '' }}">
        <i class="menu-icon tf-icons bx bxs-envelope"></i>
        <div data-i18n="Basic">{{ __('Mail Setting')}}</div>
      </a>
    </li>
    @endif

    <!------------------ Role Management --------------------->

    @if (in_array('manage role', $role))
    <li class="menu-item">
      <a href="{{ route('admin.role.index') }}" class="menu-link {{ Request::is('admin/role*') ? 'active' : '' }}">
        <i class="menu-icon bx bxs-right-arrow"></i>
        <div data-i18n="Basic">{{ __('Role')}}</div>
      </a>
    </li>
    @endif

    <!------------------ Staff Management --------------------->

    @if (in_array('manage staff', $role))
    <li class="menu-item">
      <a href="{{ route('admin.staff.index') }}" class="menu-link {{ Request::is('admin/staff*') ? 'active' : '' }}">
        <i class="menu-icon bx bxs-right-arrow"></i>
        <div data-i18n="Basic">{{ __('Staff')}}</div>
      </a>
    </li>
    @endif

    <!------------------ Add Ticket --------------------->

    @if (in_array('manage ticket', $role))
    <li class="menu-item {{ Request::is('admin/ticket*') ? 'active' : '' }}">
      <a href="{{ route('admin.ticket.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-message-rounded"></i>
        <div data-i18n="Analytics">{{__('Ticket')}}</div>
      </a>
    </li>
    @endif

    <!------------------ Profile Setting --------------------->

    @if (in_array('manage profile', $role))
    <li class="menu-item">
      <a href="{{ route('admin.profile.edit', Auth::guard('admin')->user()->id) }}" class="menu-link {{ Request::is('admin/profile*') ? 'active' : '' }}">
        <i class="menu-icon tf-icons bx bxs-user"></i>
        <div data-i18n="Basic">{{ __('Profile Setting')}}</div>
      </a>
    </li>

    <li class="menu-item {{ Request::is('admin/reset/password*') ? 'active' : '' }}">
      <a href="{{ route('admin.reset.password', Auth::guard('admin')->user()->id) }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-reset"></i>
        <div data-i18n="Basic">{{ __('Password Reset')}}</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('admin.logout') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div data-i18n="Basic">{{ __('Logout')}}</div>
      </a>
    </li>
    @endif

    <!--End Dashboard -->

  </ul>
</aside>
@endif

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('assets/admin/images/logo/'.$setting->logo) }}" alt="" style="width: 40px;">
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">{{$setting->brand_text}}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <!-- Start Dashboard -->

    <li class="menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">{{__('Dashboard')}}</div>
      </a>
    </li>

    <!------------------ Manage Category --------------------->

    <li class="menu-item {{ Request::is('admin/category*') ? 'active  open' : '' }} {{ Request::is('admin/childcategory*') ? 'active open' : '' }} {{ Request::is('admin/subcategory*') ? 'active open' : '' }}" style="">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-category"></i>
        <div data-i18n="Layouts">{{__('Manage Category')}}</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item {{ Request::is('admin/category*') ? 'active' : '' }}">
          <a href="{{ route('admin.category.index') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Main Category')}}</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('admin/subcategory*') ? 'active' : '' }}">
          <a href="{{ route('admin.subcategory.index') }}" class="menu-link">
            <div data-i18n="Without navbar">{{__('Sub Category')}}</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('admin/childcategory*') ? 'active' : '' }}">
          <a href="{{ route('admin.childcategory.index') }}" class="menu-link">
            <div data-i18n="Container">{{__('Child Category')}}</div>
          </a>
        </li>
      </ul>
    </li>

    <!------------------ Manage Product --------------------->

    <li class="menu-item {{ Request::is('admin/product*') ? 'active' : '' }}">
      <a href="{{ route('admin.product.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxl-product-hunt"></i>
        <div data-i18n="Basic">{{ __('Manage Product')}}</div>
      </a>
    </li>

     <!------------------ Manage Order --------------------->

     <li class="menu-item {{ Request::is('admin/order*') ? 'active  open' : '' }} {{ Request::is('admin/all/order*') ? 'active open' : '' }} {{ Request::is('admin/pending/order*') ? 'active open' : '' }} {{ Request::is('admin/complete/order*') ? 'active open' : '' }}" style="">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-right-arrow"></i>
        <div data-i18n="Layouts">{{__('Manage Order')}}</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item {{ Request::is('admin/all/order*') ? 'active' : '' }}">
          <a href="{{ route('admin.all.order') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('All order')}}</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('admin/pending/order*') ? 'active' : '' }}">
          <a href="{{ route('admin.pending.order') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Pending order')}}</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('admin/complete/order*') ? 'active' : '' }}">
          <a href="{{ route('admin.complete.order') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Complete order')}}</div>
          </a>
        </li>
      </ul>
    </li>

    <!------------------ Manage User--------------------->

    <li class="menu-item {{ Request::is('admin/user*') ? 'active' : '' }}">
      <a href="{{ route('admin.user.list') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-user"></i>
        <div data-i18n="Basic">{{ __('User List')}}</div>
      </a>
    </li>

    <!------------------ Manage Language --------------------->

    <li class="menu-item {{ Request::is('admin/frontendlanguage*') ? 'active  open' : '' }} {{ Request::is('admin/adminlanguage*') ? 'active  open' : '' }}">

      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class='menu-icon tf-icons bx bxs-select-multiple'></i>
        <div data-i18n="Layouts">{{__('Manage Language')}}</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item {{ Request::is('admin/adminlanguage*') ? 'active' : '' }}">
          <a href="{{ route('admin.adminlanguage.index') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Admin Pannel Language')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/frontendlanguage*') ? 'active' : '' }}">
          <a href="{{ route('admin.frontendlanguage.index') }}" class="menu-link">
            <div data-i18n="Without navbar">{{__('Website Language')}}</div>
          </a>
        </li>
      </ul>
    </li>

    <!------------------ Setting --------------------->

    <li class="menu-item {{ Request::is('admin/setting*') ? 'active open' : '' }}">

      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class='menu-icon bx bxs-brightness'></i>
        <div data-i18n="Layouts">{{__('Setting')}}</div>
      </a>

      <ul class="menu-sub">

        <li class="menu-item {{ Request::is('admin/setting/favicon*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.favicon', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Favicon')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/logo*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.logo', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Logo')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/brand-text*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.brand.text', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Brand Text')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/frontend-title*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.frontend.title.update', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Frontend Title')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/user-title*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.user.title.update', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('User Title')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/setting/backend-title*') ? 'active' : '' }}">
          <a href="{{ route('admin.setting.backend.title.update', 1) }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Backend Title')}}</div>
          </a>
        </li>

      </ul>
    </li>

    <!------------------ Manage Payement --------------------->

    <li class="menu-item {{ Request::is('admin/payment*') ? 'active  open' : '' }} {{ Request::is('admin/currency*') ? 'active  open' : '' }}">

      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class='menu-icon bx bxs-badge-dollar'></i>
        <div data-i18n="Layouts">{{__('Manage Payment')}}</div>
      </a>

      <ul class="menu-sub">
        
        <li class="menu-item {{ Request::is('admin/payment*') ? 'active' : '' }}">
          <a href="{{ route('admin.payment.index') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Payment')}}</div>
          </a>
        </li>

        <li class="menu-item {{ Request::is('admin/currency*') ? 'active' : '' }}">
          <a href="{{ route('admin.currency.index') }}" class="menu-link">
            <div data-i18n="Without menu">{{__('Currency')}}</div>
          </a>
        </li>

      </ul>
    </li>

    <!------------------ Seo Setting --------------------->

    <li class="menu-item">
      <a href="{{ route('admin.seo.edit', 1) }}" class="menu-link {{ Request::is('admin/seo*') ? 'active' : '' }}">
        <i class="menu-icon tf-icons bx bxs-envelope"></i>
        <div data-i18n="Basic">{{ __('SEO')}}</div>
      </a>
    </li>

    <!------------------ Mail Setting --------------------->

    <li class="menu-item">
      <a href="{{ route('admin.mail.setting', 1) }}" class="menu-link {{ Request::is('admin/mail*') ? 'active' : '' }}">
        <i class="menu-icon tf-icons bx bxs-envelope"></i>
        <div data-i18n="Basic">{{ __('Mail Setting')}}</div>
      </a>
    </li>

    <!------------------ Role Management --------------------->

    <li class="menu-item">
      <a href="{{ route('admin.role.index') }}" class="menu-link {{ Request::is('admin/role*') ? 'active' : '' }}">
        <i class="menu-icon bx bxs-right-arrow"></i>
        <div data-i18n="Basic">{{ __('Role')}}</div>
      </a>
    </li>

    <!------------------ Staff Management --------------------->

    <li class="menu-item">
      <a href="{{ route('admin.staff.index') }}" class="menu-link {{ Request::is('admin/staff*') ? 'active' : '' }}">
        <i class="menu-icon bx bxs-right-arrow"></i>
        <div data-i18n="Basic">{{ __('Staff')}}</div>
      </a>
    </li>

    <!------------------ Add Ticket --------------------->

    <li class="menu-item {{ Request::is('admin/ticket*') ? 'active' : '' }}">
      <a href="{{ route('admin.ticket.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-message-rounded"></i>
        <div data-i18n="Analytics">{{__('Ticket')}}</div>
      </a>
    </li>

    <!------------------ Profile Setting --------------------->

    <li class="menu-item">
      <a href="{{ route('admin.profile.edit', Auth::guard('admin')->user()->id) }}" class="menu-link {{ Request::is('admin/profile*') ? 'active' : '' }}">
        <i class="menu-icon tf-icons bx bxs-user"></i>
        <div data-i18n="Basic">{{ __('Profile Setting')}}</div>
      </a>
    </li>

    <li class="menu-item {{ Request::is('admin/reset/password*') ? 'active' : '' }}">
      <a href="{{ route('admin.reset.password', Auth::guard('admin')->user()->id) }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-reset"></i>
        <div data-i18n="Basic">{{ __('Password Reset')}}</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('admin.logout') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div data-i18n="Basic">{{ __('Logout')}}</div>
      </a>
    </li>

    <!--End Dashboard -->

  </ul>
</aside>