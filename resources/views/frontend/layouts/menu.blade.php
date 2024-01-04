@php
    $MainMenu = Menu::getByName('main_menu');
@endphp

<nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset(config('settings.logo')) }}" alt="FoodPark" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                @if ($MainMenu)
                @foreach ($MainMenu as $menu)
                <li class="nav-item">
                    <a class="nav-link" href="{{ $menu['link'] }}">{{ $menu['label'] }}
                        @if ($menu['child'])
                        <i class="far fa-angle-down"></i>
                        @endif
                    </a>
                    @if ($menu['child'])
                    <ul class="droap_menu">
                        @foreach ($menu['child'] as $item)
                            <li><a href="{{ $item['link'] }}">{{ $item['label'] }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
                @endif

            </ul>
            <ul class="menu_icon d-flex flex-wrap">
                <li>
                    <a href="#" class="menu_search"><i class="far fa-search"></i></a>
                    <div class="fp__search_form">
                        <form>
                            <span class="close_search"><i class="far fa-times"></i></span>
                            <input type="text" placeholder="Search . . .">
                            <button type="submit">search</button>
                        </form>
                    </div>
                </li>
                <li>
                    <a class="cart_icon"><i class="fas fa-shopping-basket"></i> <span class="cart_count">{{ count(Cart::content()) }}</span></a>
                </li>
                <li>
                    <a href=" {{ route('login') }}"><i class="fas fa-user"></i></a>
                </li>
               
            </ul>
        </div>
    </div>
</nav>

<div class="fp__menu_cart_area">
    <div class="fp__menu_cart_boody">
        <div class="fp__menu_cart_header">
            <h5>total item (<span class="cart_count" style="font-size: 16px">{{ count(Cart::content()) }}</span>)</h5>
            <span class="close_cart"><i class="fal fa-times"></i></span>
        </div>
        <ul class="cart_contents">
            @foreach (Cart::content() as $cartProduct)
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset($cartProduct->options->product_info['image']) }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="{{ route('product.show', $cartProduct->options->product_info['slug']) }}">{!! $cartProduct->name !!} </a>
                    <p class="size">Qty: {{ $cartProduct->qty }}</p>

                    <p class="size">{{ @$cartProduct->options->product_size['name'] }} {{ @$cartProduct->options->product_size['price'] ? '('.currencyPosition(@$cartProduct->options->product_size['price']).')' : '' }}</p>

                    @foreach ($cartProduct->options->product_options as $cartProductOption)
                    <span class="extra">{{ $cartProductOption['name'] }} ({{ currencyPosition($cartProductOption['price']) }})</span>
                    @endforeach

                    <p class="price">{{ currencyPosition($cartProduct->price) }}</p>
                </div>
                <span class="del_icon" onclick="removeProductFromSidebar('{{ $cartProduct->rowId }}')"><i class="fal fa-times"></i></span>
            </li>
            @endforeach

        </ul>
        <p class="subtotal">sub total <span class="cart_subtotal">{{ currencyPosition(cartTotal()) }}</span></p>
         <a class="cart_view" href="{{ route('cart.index') }}"> view cart</a>
    </div>
</div>

<div class="fp__reservation">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Book a Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="fp__reservation_form">
                        <input class="reservation_input" type="text" placeholder="Name">
                        <input class="reservation_input" type="text" placeholder="Phone">
                        <input class="reservation_input" type="date">
                        <select class="reservation_input" id="select_js">
                            <option value="">select time</option>
                            <option value="">08.00 am to 09.00 am</option>
                            <option value="">10.00 am to 11.00 am</option>
                            <option value="">12.00 pm to 01.00 pm</option>
                            <option value="">02.00 pm to 03.00 pm</option>
                            <option value="">04.00 pm to 05.00 pm</option>
                        </select>
                        <select class="reservation_input" id="select_js2">
                            <option value="">select person</option>
                            <option value="">1 person</option>
                            <option value="">2 person</option>
                            <option value="">3 person</option>
                            <option value="">4 person</option>
                            <option value="">5 person</option>
                        </select>
                        <button type="submit">book table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
