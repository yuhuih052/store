@extends('layouts.app')
@section('title',$product->title)

@section('content')

    <div class="row">
        <div class="col-lg-12 ">
            <div class="panel panel-default">
                <div class="panel-body product-info">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="box" style="position:relative;width: 400px;height: 400px;overflow: hidden;">
                                <img class="cover" src="{{ $product->image_url }}" alt="" style="width: 400px;height: 400px;">
                                <div class="shubiao" style="width: 100px;height: 100px;background:red;opacity: 0.5;position:absolute;top: 0;left: 0;z-index:99;display: none;">

                                </div>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="title">{{ $product->title }}</div>
                            <div class="price"><label>价格</label><em>￥</em><span>{{ $product->price }}</span></div>
                            <div class="sales_and_reviews">
                                <div class="sold_count">累计销量 <span class="count">{{ $product->sold_count }}</span></div>
                                <div class="review_count">累计评价 <span class="count">{{ $product->review_count }}</span></div>
                                <div class="rating" title="评分 {{ $product->rating }}">评分 <span class="count">{{ str_repeat('★', floor($product->rating)) }}{{ str_repeat('☆', 5 - floor($product->rating)) }}</span></div>
                            </div>
                            <div class="skus">
                                <label>选择</label>
                                <div class="btn-group" data-toggle="buttons">
                                    @foreach($product->skus as $sku)
                                        <label class="btn btn-default sku-btn {{ $loop->first ? 'active' : '' }}"
                                               data-price="{{ $sku->price }}"
                                               data-stock="{{ $sku->stock }}"
                                               data-toggle="tooltip"
                                               title="{{ $sku->description }}"
                                               data-placement="bottom">
                                            <input type="radio" name="skus" autocomplete="off" value="{{ $sku->id }}"> {{ $sku->title }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="cart_amount"><label>数量</label><input type="text" class="form-control input-sm" value="1"><span>件</span><span class="stock"></span></div>
                            <div class="buttons">
                                @if($favored)
                                    <button class="btn btn-danger btn-disfavor">取消收藏</button>
                                @else
                                <button class="btn btn-success btn-favor">❤ 收藏</button>
                                @endif
                                <button class="btn btn-primary btn-add-to-cart">加入购物车</button>
                            </div>
                            <br><br><br><br><br>
                            <div class="col-sm-12" ><span>欢迎登陆北部湾大学网上商城，本店质量保证，放心购买</span></div>
                        </div>

                        <div class="Show" style="width: 400px;height: 400px;position:absolute;left: 450px; overflow: hidden;z-index:99;display: none;">
                            <img src="{{ $product->image_url }}" alt="" style="width: 1600px;height: 1600px;">
                        </div>
                    </div>
                    <div class="product-detail">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab">商品详情</a></li>
                            <li role="presentation"><a href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab">用户评价</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
                                {!! $product->description !!}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
                                <!-- 评论列表开始 -->
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <td>用户</td>
                                        <td>商品</td>
                                        <td>评分</td>
                                        <td>评价</td>
                                        <td>时间</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td>{{ $review->order->user->name }}</td>
                                            <td>{{ $review->productSku->title }}</td>
                                            <td>{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</td>
                                            <td>{{ $review->review }}</td>
                                            <td>{{ $review->reviewed_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- 评论列表结束 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('scriptsAfterJs')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});
            initData($('.sku-btn'));

            $('.sku-btn').click(function () {
                initData(this);
            });
            function initData(e) {
                $('.product-info .price span').text($(e).data('price'));
                $('.product-info .stock').text('库存：' + $(e).data('stock') + '件');
            }

            // 监听收藏按钮的点击事件
            $('.btn-favor').click(function () {
                // 发起一个 post ajax 请求，请求 url 通过后端的 route() 函数生成。
                axios.post('{{ route('products.favor', ['product' => $product->id]) }}')
                    .then(function () { // 请求成功会执行这个回调
                        swal('收藏成功', '', 'success')
                        .then(function () {
                            //收藏成功，重新加载页面
                            location.reload();
                        })
                    }, function(error) { // 请求失败会执行这个回调
                        // 如果返回码是 401 代表没登录
                        if (error.response && error.response.status === 401) {
                            swal('请先登录', '', 'error');
                        } else if (error.response && error.response.data.msg) {
                            // 其他有 msg 字段的情况，将 msg 提示给用户
                            swal(error.response.data.msg, '', 'error');
                        }  else {
                            // 其他情况应该是系统挂了
                            swal('系统错误', '', 'error');
                        }
                    });
            });

            //点击取消收藏
            $('.btn-disfavor').click(function () {
                axios.delete('{{ route('products.disfavor', ['product' => $product->id]) }}')
                    .then(function () {
                        swal('已取消收藏', '', 'success')
                            .then(function () {
                                location.reload();
                            });
                    });
            });

            // 加入购物车按钮点击事件
            $('.btn-add-to-cart').click(function () {

                // 请求加入购物车接口
                axios.post('{{ route('cart.addToCart') }}', {
                    sku_id: $('label.active input[name=skus]').val(),
                    amount: $('.cart_amount input').val(),
                })
                    .then(function () { // 请求成功执行此回调
                        swal('加入购物车成功', '', 'success')
                            .then(function() {
                                location.href = '{{ route('cart.show') }}';
                            });
                    }, function (error) { // 请求失败执行此回调
                        if (error.response.status === 401) {

                            // http 状态码为 401 代表用户未登陆
                            swal('请先登录', '', 'warning');

                        }else if (error.response.status === 400) {
                            // http状态码为 400 代表用户未验证邮箱
                            swal(error.response.data.msg, '', 'error');

                        }  else if (error.response.status === 422) {

                            // http 状态码为 422 代表用户输入校验失败
                            var html = '<div>';
                            _.each(error.response.data.errors, function (errors) {
                                _.each(errors, function (error) {
                                    html += error+'<br>';
                                })
                            });
                            html += '</div>';
                            swal({content: $(html)[0], icon: 'error'})
                        } else {

                            // 其他情况应该是系统挂了
                            swal('系统错误', '', 'error');
                        }
                    })
            });

        });

        var box = document.getElementsByClassName('box')[0];
        var show = document.getElementsByClassName('Show')[0];
        var shubiao = document.getElementsByClassName('shubiao')[0];

        box.onmousemove = function(event){
            show.style.display = 'block';
            shubiao.style.display = 'block';

            var moveX = event.clientX - box.offsetLeft;
            var moveY = event.clientY - box.offsetTop;

            var left=Math.min(Math.max(moveX-100,0),300);
            var top=Math.min(Math.max(moveY-100,0),300);

            shubiao.style.left = left +'px';
            shubiao.style.top = top +'px';

            show.scrollLeft = left*4;
            show.scrollTop = top*4;
        }

        box.onmouseout = function(event){
            shubiao.style.display = 'none';
            show.style.display = 'none';
        }
    </script>
@endsection