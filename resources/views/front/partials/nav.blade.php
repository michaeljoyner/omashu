<nav class="front-nav{{ $extraClassName }}">
    <label for="nav-menu-checkbox"><span class="zh-menu-label">選單</span>Menu</label>
    <input type="checkbox" id="nav-menu-checkbox" name="nav-menu-checkbox"/>
    <ul>
        @if(Request::path() !== 'comingsoon')
            <li><a href="/comingsoon">
                <div class="om-btn"><span class="btn-zh">首頁</span>home</div>
            </a></li>
        @endif
        @if(Request::path() !== 'brands')
            <li><a href="/brands">
                <div class="om-btn"><span class="btn-zh">商標</span>brands</div>
            </a></li>
        @endif
        @if(Request::path() !== 'products')
            <li><a href="/products">
                <div class="om-btn"><span class="btn-zh">產品</span>products</div>
            </a></li>
        @endif
        @if(Request::path() !== 'stockists')
            <li><a href="/stockists">
                <div class="om-btn"><span class="btn-zh">配合商店</span>stockists</div>
            </a></li>
        @endif
    </ul>
</nav>