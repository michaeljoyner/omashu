@extends('front.base')

@section('content')
    @include('front.partials.nav', ['extraClassName' => ' inverse'])
    <header class="main-page-header">
        <h1 class="page-title"><span><span class="zh-page-title">謝謝</span>Thank you!</span></h1>

    </header>
    <section class="thanksgiving">
        <p class="thanks-message zh">付款單已寄發至您所登記的電子郵箱，待您撥冗完成付款，您的產品隨即會寄發至您所登記的地址。感謝並期待您再次光臨。</p>
        <p class="thanks-message zh">當訂單送出後，您將會收到我們的確認email，與付款明細。ㄧ收到您的匯款，會立刻為您安排出貨。<br>您的訂單 # {{ \Illuminate\Support\Facades\Session::get('order_number', '160224sd67') }}<br>如果您有任何問題，請隨時聯絡我們，聯絡方式為 contact@omashuimports.com，或撥電話 0425222019。
        </p>
        <p class="thanks-message en">Thank you for your order! An email has been sent to your address outlining the next steps to process payment for your order. Once payment has been received, your order will be shipped to the provided address.</p>
        <p class="thanks-message en">Your order number is <span class="order_number">{{ \Illuminate\Support\Facades\Session::get('order_number', '160224sd67') }}</span>. If you have any queries please email us and include the order number.</p>
        <div class="button-holder">
            <a href="/products">
                <div class="om-btn">繼續瀏覽/回到首頁 / Continue Shopping</div>
            </a>
        </div>
    </section>
    @include('front.partials.footer')
@endsection