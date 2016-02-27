<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/home">OmashuImports</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                {{--<li><a href="#">Link</a></li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Brands <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/brands">All Brands</a></li>
                        <li role="separator" class="divider"></li>
                        @foreach($navBrands as $brand)
                            <li><a href="/admin/brands/{{ $brand->slug }}">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="/admin/stockists">Stockists</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orders <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/orders">All Orders</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/admin/orders/filter/open">Open Orders</a></li>
                        <li><a href="/admin/orders/filter/paid">Paid Orders</a></li>
                        <li><a href="/admin/orders/filter/shipped">Shipped Orders</a></li>
                        <li><a href="/admin/orders/filter/complete">Complete Orders</a></li>
                        <li><a href="/admin/orders/filter/cancelled">Cancelled Orders</a></li>
                    </ul>
                </li>
                <li><a href="/admin/shippingrules">Shipping Rates</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin/register">Users</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->email }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/resetpassword">Reset Password</a></li>
                        <li><a href="/admin/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>