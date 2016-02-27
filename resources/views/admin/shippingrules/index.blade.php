@extends('admin.base')

@section('content')
    <div class="conatiner">
        <h1>Shipping Policies</h1>
        <hr/>
        <section class="rules-list">
            @foreach($rules as $rule)
                <div class="rule-card">
                    <header>
                        {{ $rule->name }}
                    </header>
                    <div class="body">
                        <p>Rate: NT${{ $rule->rate }}</p>
                        <p>Free shipping above: NT${{ $rule->free_above }}</p>
                    </div>
                    <footer>
                        <a href="/admin/shippingrules/{{ $rule->id }}/edit">
                            <div class="btn omashu-btn">Edit Policy</div>
                        </a>
                    </footer>
                </div>
            @endforeach
        </section>
    </div>
@endsection