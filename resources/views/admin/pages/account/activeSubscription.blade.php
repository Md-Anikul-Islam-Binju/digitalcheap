@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Digital Cheap</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Active Subscription</a></li>
                        <li class="breadcrumb-item active">Welcome!</li>
                    </ol>
                </div>
                <h4 class="page-title">Welcome!</h4>
            </div>
        </div>
    </div>



    @can('user-dashboard-cart')
        <div class="row">

            <div class="row">
                <div class="col-xxl-12 col-sm-12">



                    @php
                        $allCategories = \App\Models\Category::all(); // or however you're getting product categories
                    @endphp

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
                        <!-- Category Tabs -->
                        <ul class="nav nav-pills flex-wrap mb-2 mb-md-0" id="categoryTabs">
                            <li class="nav-item">
                                <button class="nav-link active" data-category="all">All</button>
                            </li>
                            @foreach($allCategories as $category)
                                <li class="nav-item">
                                    <button class="nav-link" data-category="{{ $category->id }}">{{ $category->name }}</button>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Search Input -->
                        <div class="input-group" style="max-width: 300px;">
                            <input type="text" class="form-control" id="productSearchInput" placeholder="Search Product...">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                    <!-- Modified products display section -->
                    <div class="row gap-1" id="productList" style="padding-bottom: 15px;">
                        @php
                            $shownProductIds = [];
                        @endphp
                        @foreach($ordersItemAll as $ordersItem)
                            @foreach($ordersItem->orderItems as $item)
                                @if($item->type == 'package' && $item->package)
                                    @foreach($item->package->products ?? [] as $product)
                                        @if(!in_array($product['id'], $shownProductIds))
                                            @php
                                                $shownProductIds[] = $product['id'];
                                            @endphp
                                            <div class="col-auto product-card"
                                                 style="border: 1px solid darkgreen; background: white"
                                                 data-category="{{ $product['category_id'] ?? 'uncategorized' }}"
                                                 data-name="{{ strtolower($product['name']) }}">
                                                <div class="card text-center shadow-none" style="width: 15rem;">
                                                    <img src="{{ asset('images/product/'.$product['file']) }}"
                                                         class="card-img-top"
                                                         alt="{{ $product['name'] }}" style="object-fit: cover; height: 250px;">

                                                    <div class="card-body">
                                                        <a href="{{ $product['link'] }}" target="_blank" class="btn btn-primary">Access</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @elseif($item->type == 'product')
                                    @php
                                        $product = App\Models\Product::find($item->product_id);
                                    @endphp
                                    @if($product && !in_array($product->id, $shownProductIds))
                                        @php
                                            $shownProductIds[] = $product->id;
                                        @endphp
                                        <div class="col-auto product-card"
                                             style="border: 1px solid darkgreen; background: white"
                                             data-category="{{ $product->category_id ?? 'uncategorized' }}"
                                             data-name="{{ strtolower($product->name) }}">
                                            <div class="card text-center shadow-none" style="width: 15rem;">
                                                <img src="{{ asset('images/product/'.$product->file) }}"
                                                     class="card-img-top"
                                                     alt="{{ $product->name }}" style="object-fit: cover; height: 250px;">
                                                <div class="card-body">
                                                    <a href="{{ $product->link }}" target="_blank" class="btn btn-primary">Access</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </div>

                    {{--                    <div class="row flex-nowrap overflow-auto" style="padding-bottom: 15px;"> <!-- Added flex-nowrap and overflow-auto -->--}}
                    {{--                        @php--}}
                    {{--                            $shownProductIds = [];--}}
                    {{--                        @endphp--}}
                    {{--                        @foreach($ordersItemAll as $key => $ordersItem)--}}
                    {{--                            @foreach($ordersItem->orderItems as $item)--}}
                    {{--                                @if($item->type == 'package' && $item->package)--}}
                    {{--                                    @if(!empty($item->package->products))--}}
                    {{--                                        @foreach($item->package->products as $product)--}}
                    {{--                                            @if(!in_array($product['id'], $shownProductIds))--}}
                    {{--                                                @php--}}
                    {{--                                                    $shownProductIds[] = $product['id'];--}}
                    {{--                                                @endphp--}}
                    {{--                                                <div class="col-auto"> <!-- Changed to col-auto -->--}}
                    {{--                                                    <div class="card text-center" style="width: 15rem;">--}}
                    {{--                                                        <img src="{{ asset('images/product/'.$product['file']) }}"--}}
                    {{--                                                             class="card-img-top"--}}
                    {{--                                                             alt="{{ $product['name'] }}" style="object-fit: cover; height: 250px;">--}}
                    {{--                                                        <div class="card-body">--}}
                    {{--                                                            <a href="#" class="btn btn-primary">Access</a>--}}
                    {{--                                                        </div>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                            @endif--}}
                    {{--                                        @endforeach--}}
                    {{--                                    @endif--}}
                    {{--                                @endif--}}

                    {{--                                @if($item->type == 'product')--}}
                    {{--                                    @php--}}
                    {{--                                        $product = App\Models\Product::find($item->product_id);--}}
                    {{--                                    @endphp--}}
                    {{--                                    @if($product && !in_array($product->id, $shownProductIds))--}}
                    {{--                                        @php--}}
                    {{--                                            $shownProductIds[] = $product->id;--}}
                    {{--                                        @endphp--}}
                    {{--                                        <div class="col-auto"> <!-- Changed to col-auto -->--}}
                    {{--                                            <div class="card text-center" style="width: 15rem;">--}}
                    {{--                                                <img src="{{ asset('images/product/'.$product->file) }}"--}}
                    {{--                                                     class="card-img-top"--}}
                    {{--                                                     alt="" style="object-fit: cover; height: 250px;">--}}
                    {{--                                                <div class="card-body">--}}
                    {{--                                                    <a href="#" class="btn btn-primary">Access</a>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    @endif--}}
                    {{--                                @endif--}}
                    {{--                            @endforeach--}}
                    {{--                        @endforeach--}}
                    {{--                    </div>--}}

                </div>
            </div>
        </div>
    @endcan





    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoryTabs = document.querySelectorAll('#categoryTabs button');
            const searchInput = document.getElementById('productSearchInput');
            const productCards = document.querySelectorAll('.product-card');

            function filterProducts() {
                const selectedCategory = document.querySelector('#categoryTabs .active')?.dataset.category;
                const searchQuery = searchInput.value.toLowerCase();

                productCards.forEach(card => {
                    const productName = card.dataset.name;
                    const productCategory = card.dataset.category;

                    const matchesCategory = (selectedCategory === 'all') || (productCategory === selectedCategory);
                    const matchesSearch = productName.includes(searchQuery);

                    if (matchesCategory && matchesSearch) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            categoryTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    categoryTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    filterProducts();
                });
            });

            searchInput.addEventListener('input', filterProducts);
        });
    </script>

@endsection
