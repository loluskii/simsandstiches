@php
$currencies = App\Models\Currency::where('status','active')->get();
App\Helpers\Helper::currency_load();
$currency_code = session('currency_code');
$currency_symbol = session('currency_symbol');
if($currency_symbol == ""){
$system_default_currency_info = session('system_default_currency_info');
$currency_symbol = $system_default_currency_info->symbol;
$currency_code = $system_default_currency_info->code;
}
@endphp

<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button bg-white rounded-0 collapsed px-1 border-bottom" type="button"
                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true"
                aria-controls="flush-collapseOne">
                <i class="bi bi-cart4 me-2" style="font-size: 25px"></i> Show Order
                Summary
                {{ $currency_symbol }}{{ number_format(\Cart::session(App\Helpers\Helper::getSessionID())->getTotal(),
                2) }}

            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="product border-bottom">
                    <table class="table table-borderless">
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr class="d-flex justify-content-between align-items-center">
                                <td style="width: 60%;">
                                    <span class="product__description__variant order-summary__small-text text-uppercase"
                                        style="display: block;">{{ $item->name }}</span>
                                </td>
                                <td style="width: 20%;">
                                    {{ $currency_symbol }}{{ number_format($item->price, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="price border-bottom">
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <span>Subtotal</span>
                        <span>{{ $currency_symbol }}{{
                            number_format(Cart::session(App\Helpers\Helper::getSessionID())->getSubTotal(), 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-3">
                        <span>Shipping</span>
                        @php
                        $condition = Cart::session(App\Helpers\Helper::getSessionID())->getCondition('Express Shipping')
                        @endphp
                        @if(Route::is('checkout.page-1'))
                        <p><small class="text-muted">Calculated at the next step</small></p>
                        @else
                        <p><small class="text-muted">{{ $currency_symbol }} {{
                                number_format(App\Helpers\Helper::currency_converter($condition ? $condition->getValue() : ''),
                                2)
                                }}</small></p>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center py-4">
                    <span>Order Total</span>
                    <h3>{{ $currency_symbol }}{{
                        number_format(Cart::session(App\Helpers\Helper::getSessionID())->getTotal(), 2) }}
                    </h3>
                </div>

            </div>
        </div>
    </div>

</div>
