@extends('front.base')

@section('seotags')
    <meta name="description" content="感謝蒞臨緒康貿易有限公司，我們將提供給您最優質的產品與服務。 Welcome to Omashu, home of the finest quality imported goods."/>
    @include('front.partials.ogmeta', [
        'og_url' => Request::url(),
        'og_description' => '感謝蒞臨緒康貿易有限公司，我們將提供給您最優質的產品與服務。 Welcome to Omashu, home of the finest quality imported goods.',
        'og_title' => 'Omashu Imports'
    ])
    <link rel="canonical" href="http://omashuimports.com"/>
@endsection

@section('content')
    <section class="omashu-section banner-section">
        <header class="home-header">
            @include('front.partials.nav', ['extraClassName' => ''])
        </header>
        <img class="logo-img" src="{{ asset('/images/website_logo.png') }}" alt=""/>
        <p class="zh-header">緒康貿易有限公司係從台灣出發，秉持著發現好物的精神，把來自世界各地最美好的產品分享給您。</p>
        <p lang="en">Omashu is a Taiwan-based import company. Our company is dedicated to searching the world to bring the highest quality, premium goods to you.</p>
        {{--<p class="upcoming-shop-alert white-text">Shop coming soon</p>--}}
    </section>
    <section class="omashu-section brand-section">
        <h1 class="section-title" lang="en"><span><span class="zh-title">商標</span>brands</span></h1>
        @foreach($brands->chunk(3) as $brandRow)
            <div class="brand-row">
                @foreach($brandRow as $brand)
                    <div class="brand-box">
                        <a href="/brands#{{ $brand->slug }}"><img src="{{ $brand->coverPic() }}" alt="" width="350"/></a>
                        <h4 lang="en">{{ $brand->name }}</h4>
                        <p class="zh-text">{{ $brand->zh_tagline }}</p>
                        <p class="en-text" lang="en">{{ $brand->tagline }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>
    <section class="omashu-section about-section">
        <h1 lang="en" class="section-title white-title"><span><span class="zh-title">我們的故事</span>Our Story</span></h1>
        <div class="two-column">
            <p class="about-chinese">緒康貿易有限公司與加拿大的蒜產品集團 The Garlic Box 奠基於緊密的信任關係。在食安觀念越來越成熟的現代社會，我們很高興能找到如此尊重食物與客人的合作夥伴。我們對我們產品的自信，來自我們對我們產品的了解。 我們不輕易妥協，也希望您能支持我們對食安的堅持。</p>
        </div>
        <div class="two-column">
            <p>Omashu Imports exists to provide merchandise of impeccable quality. Established by a husband and wife from Canada and Taiwan, our goal is to find honest, trustworthy suppliers who refuse to compromise on the integrity of what they produce.  We believe in what we import, and our suppliers believe in us to expand their reach into new markets around the globe.</p>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="omashu-section contact-section">
        <h1 class="section-title"><span><span class="zh-title">聯絡我們</span>Contact us</span></h1>
        <p>Contact us for all your needs.</p>
        <div class="form-row">
            <form method="POST" action="/contactomashu" id="contact-form" class="contact-omashu-form">
                <input type="hidden" name="_token" value="{{ Session::token() }}"/>
                <div class="form-half-col">
                    <label for="name">Your name: </label>
                    <input type="text" name="name" id="name" required/>
                </div>
                <div class="form-half-col">
                    <label for="email">Your email: </label>
                    <input type="email" name="email" id="email" required/>
                </div>
                <div class="form-one-col">
                    <label for="the_message">How can we help you?</label>
                    <textarea name="the_message" id="the_message" required></textarea>
                </div>
                <div>
                    <button type="submit" class="om-btn"><span class="btn-zh">傳送</span>Send</button>
                </div>
                <div class="form-cover">
                    <p id="cf-thanks">Thank you. We'll be in touch
                        <br/>
                        <span>Thanks you. We'll be in touch.</span>
                    </p>
                    <p id="cf-reset">Send another message.</p>
                </div>
            </form>
        </div>
        <div class="contact-details">
            <div class="two-column">
                <h3>Krissy Yang</h3>
                <p>M: +(886) 989282789</p>
                <p>T: +(886) 4 25222019</p>
                <p>F: +(886) 4 25281709</p>
                <p>E: krissy@omashuimports.com</p>
                <p>42072台中市豐原區豐原大道六段406號2樓</p>
            </div>
            <div class="two-column">
                <h3>Ian Brown</h3>
                <p>M: +(886) 984096396</p>
                <p>T: +(886) 4 25222019</p>
                <p>F: +(886) 4 25281709</p>
                <p>E: ian@omashuimports.com</p>
                <p>406-2F Fengyuan Blvd. Sec. 6, Fengyuan</p>
                <p>Dist., Taichung City, Taiwan R.O.C. 42072</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    @include('front.partials.footer')
@endsection

@section('bodyscripts')
    <script>
        var contact = new AjaxContactForm(document.getElementById('contact-form'));
        contact.init();
    </script>
@endsection