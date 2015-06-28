<nav>
    <div class="user-box">
        <p class="users-name">{{ Auth::user()->name }}</p>
        <ul class="user-options">
            <li><a href="/admin/resetpassword">Reset password</a></li>
            <li><a href="/admin/logout">Logout</a></li>
        </ul>
    </div>
    <div class="branding">
        <a href="/comingsoon">Omashu Imports</a>
    </div>
    <ul class="top-level">
        <li><a href="/admin/brands">Home</a></li>
        <li>
            <a href="/admin/brands">Brands</a>
                @if($navBrands->count() > 0)
                    <ul class="second-level">
                        @foreach($navBrands as $brand)
                            <li>
                                <a href="/admin/brands/{{ $brand->slug }}">{{ $brand->name }}</a>
                                @if($brand->categories)
                                    <ul class="third-level">
                                        @foreach($brand->categories as $category)
                                            <li><a href="/admin/categories/{{ $category->slug }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>

                        @endforeach
                    </ul>
                @endif
        </li>
        <li><a href="/admin/stockists">Stockists</a></li>
        <li><a href="/admin/register">Users</a></li>
    </ul>
</nav>