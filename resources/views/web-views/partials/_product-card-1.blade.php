@if(isset($product))
    @php($overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews))
    <div class="flash_deal_product rtl" onclick="location.href='{{route('product',$product->slug)}}'">
        @if($product->discount > 0)
        <span class="for-discoutn-value p-1 pl-2 pr-2">
            @if ($product->discount_type == 'percent')
                {{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
            @elseif($product->discount_type =='flat')
                {{\App\CPU\Helpers::currency_converter($product->discount)}}
            @endif {{\App\CPU\translate('off')}}
        </span>
        @endif
        <div class=" d-flex">
            <div class="d-flex align-items-center justify-content-center"
                 style="padding-{{Session::get('direction') === "rtl" ?'right:12px':'left:12px'}};padding-top:12px;">
                <div class="flash-deals-background-image">
                    <img class="__img-125px"
                     src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                     onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"/>
                </div>
            </div>
            <div class="flash_deal_product_details pl-3 pr-3 pr-1 d-flex align-items-center">
                <div>
                    <div>
                        <span class="flash-product-title">
                            {{$product['name']}}
                        </span>
                    </div>
                    <div class="flash-product-review">
                        @for($inc=0;$inc<5;$inc++)
                            @if($inc<$overallRating[0])
                                <i class="sr-star czi-star-filled active"></i>
                            @else
                                <i class="sr-star czi-star" style="color:#fea569 !important"></i>
                            @endif
                        @endfor
                        <label class="badge-style2">
                            ( {{$product->reviews->count()}} )
                        </label>
                    </div>
                    <div>
                        @if($product->discount > 0)
                            <strike
                                style="font-size: 12px!important;color: #E96A6A!important;">
                                {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
                            </strike>
                        @endif
                    </div>
                    <div class="flash-product-price">
                        {{\App\CPU\Helpers::currency_converter($product->unit_price-\App\CPU\Helpers::get_product_discount($product,$product->unit_price))}}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
