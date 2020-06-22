<div class="header">
	<img src="font-end/image/header6.jpg">
</div> 
<div class="topnavi">
	<div class="topnavi_btn {{ $menu ?? '' }}"><a href="{{ route('food.index') }}"><i class="far fa-list-alt"></i> Danh sách món ăn</a></div>
	<div class="topnavi_btn {{ $history ?? '' }}"><a href="{{ route('food_order.index') }}"><i class="fas fa-history"></i> Lịch sử chọn món</a></div>
</div>