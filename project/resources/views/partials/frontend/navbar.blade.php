
<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-white shadow">
    <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}">{{$setting->brand_text}}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto justify-content-between w-50">
          <li class="nav-item">
            <a class="nav-link text-dark {{ Request::is('/') ? 'active' : ''}}" aria-current="page" href="{{route('index')}}" >{{__('Home')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="#" >{{__('Features')}}</a>
          </li>
          <li class="nav-item">
            <select id="language" style="border: none" class="bg-white text-dark mt-2">
              @foreach (DB::table('frontend_languages')->get() as $language)
              <option value="{{route('frontend.language', $language->id)}}" {{ Session::has('language') ? (Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('frontend_languages')->where('is_default', 1)->first()->id == $language->id ? 'selected' : '') }} >{{$language->language}}</option>
              @endforeach
            </select>
          </li>

          <li class="nav-item">
            <select id="currency" style="border: none" class="bg-white text-dark mt-2">
              @foreach (DB::table('currencies')->get() as $currency)
              <option value="{{route('frontend.currency', $currency->id)}}" {{ Session::has('currency') ? (Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default', 1)->first()->id == $currency->id ? 'selected' : '') }} >{{$currency->name}}</option>
              @endforeach
            </select>
          </li>

          <li class="nav-item">
            <a class="nav-link text-dark position-relative {{ Request::is('/wishlist') ? 'active' : ''}}" href="{{route('wishlist')}}" ><i class="fa-solid fa-heart"></i> <span class="
              @if(Auth::guard('web')->user())
              {{ DB::table('wishlists')->where('user_id', Auth::guard('web')->user()->id)->count() > 0 ? 'position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger' : ''}}
              @endif
              ">
              @if (Auth::guard('web')->user())
              {{ DB::table('wishlists')->where('user_id', Auth::guard('web')->user()->id)->count() > 0 ? DB::table('wishlists')->where('user_id', Auth::guard('web')->user()->id)->count() : '' }}
              @endif
              </span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-dark position-relative {{ Request::is('cart/show') ? 'active' : ''}}" href="{{route('cart.show')}}" ><i class="fa-solid fa-cart-arrow-down"></i> <span class="{{ Session::has('cartItem')? 'position-absolute top-5 start-100 translate-middle badge rounded-pill bg-primary' : '' }}">{{ Session::has('cartItem') ? count(Session::get('cartItem')) : '' }}</span></a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>

  
  