<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" >
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>
		What is for lunch today?
	</title>
    <link href="{{ asset('font-end/image/favicon.ico') }}" type="image/ico" rel="shortcut icon">
    <link href="{{ asset('font-end/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('font-end/css/menu.css') }}" rel="stylesheet">
	<link href="{{ asset('font-end/css/modal.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<!-- Đây là nội dung chính của trang -->
	@include('TopView')
	<div class="content">
		<!-- Đây là vùng search và kết quả search -->
		<h1>Danh sách món ăn</h1>
		<div class="searcharea">
			<form action="menu.php" method="GET">
				<div class="condition">
					<div class="exception">
						<span>
							Bỏ qua lần chọn gần nhất
						</span>
						<label class="switch_toggle" for="exception_search">
							<input type="checkbox" name="exception" id="exception_search">
							<span class="slider">ON</span>
						</label>
					</div>
					<div>
						<input type="submit" value="Search" class="submit">
						<input type="reset" value="Reset" class="reset">
					</div>
				</div>
				<div class="condition">
					<div>
						<label for="price_search">
							Chọn khoảng giá:
						</label>
						<select name="price" id="price_search" class="key">
							<option value="price0"></option>
							<option value="price1">Dưới 25 000 VND</option>
							<option value="price2"> 25 000 ~ 35 000 VND</option>
							<option value="price3"> 35 000 ~ 45 000 VND</option>
							<option value="price4"> Trên 45 000 VND</option>		
						</select>
					</div>
				</div>
				<div class="condition">
					<div>
						<label for="dish_search"> Tên món:</label> 
						<input type="search" name="dish" placeholder="Nhập tên món..." id="dish_search" class="key" >
					</div>
					<div>
						<label for="restaurant_search">Tên quán:</label>
						<input type="search" name= "res" placeholder="Nhập tên quán..." id="restaurant_search"  class="key" >
					</div>
				</div>
			</form>
			<div class="result">
				<p>Có <span style="color: red"> xx </span> kết quả phù hợp</p>
			</div>
		</div>
		<!-- Đây là các danh sách và thao tác với danh sách -->
		<div class="action">
			<button type="button" id="button_add">Thêm món　<i class="fas fa-plus"></i></button>
			<button type="button" id="button_select">Chọn món　<i class="fas fa-check"></i></button>
		</div>
		<div class="list">
			<table id="id_content_food">
				<tr>
					<th class='column_first'>STT</th>
					<th class='column'>Ảnh</th>
					<th class='column'>Tên món</th>
					<th class='column'>Giá (VND)</th>
					<th class='column'>Tên quán</th>
					<th class='column_last'></th>
					<th class='column_last'></th>
				</tr>
				@if(count($foods) >= 1)
					@foreach($foods as $food)
						<tr>
							<td class='column_first'>{{ $loop->iteration }}</td>
							<td class='column'><img src='font-end/image/image{{ $loop->iteration }}.jpg'/></td>
							<td class='column'>{{ $food->name }}</td>
							<td class='column'>{{ $food->price }}</td>
							<td class='column'>{{ $food->res }}</td> 
							<td class='column_last'><i id='{{ $food->id }}' class=' fas fa-pencil-alt button_edit'></i></td>
							<td class='column_last'><i id='{{ $food->id }}' class=' fas fa-trash-alt button_delete'></i></td>
						</tr>
					@endforeach
				@else
				@endif
			</table>
		</div>
	</div>
	<div class="footer">
		<p>
			Training project by OWS JSC.<br/>
			For feedback and support, please contact: <a href="mailto:huongdt@ows.com.vn">huongdt@ows.com.vn</a> 
		</p>
	</div>
	<!-- Phần phía dưới là các modal -->
	<!-- Đây là modal thêm món  -->
	<div  class="modal_back" id="modal_add">
		<div class="modal_container">
			<div class="modal_title">
				<div>Thêm món ăn vào danh sách</div>
				<div><i class="fas fa-times button_close"></i></div>
			</div>
			<div class="modal_content">
				<p style="color: red">* Là các trường bắt buộc.</p>
				<form action="{{ route('food.store') }}" method="POST" id="form_add">
					@csrf
					<div class="information">
						<div><img src="font-end/image/image23.jpg"></div>
						<div><input type="file" name="image" accept="image/gif, image/jpg, image/jpeg, image/png" class="upload"></div>
					</div>
					<div class="information">
						<div><label for="dish_add"> Tên món<span style="color: red">*</span>: </label></div>
						<div><input id="dish_add" class="input" type="text" name="dish" placeholder="Nhập tên món..."></div>
					</div>
					<div class="information">
						<div><label for="restaurant_add">Tên quán<span style="color: red">*</span>: </label></div>
						<div><input id="restaurant_add"  class="input" type="text" name= "restaurant" placeholder="Nhập tên quán..."></div>
					</div>
					<div class="information">
						<div><label for="price_add">Giá tiền<span style="color: red">*</span>: </label></div>
						<div><input id="price_add" class="input" type="text" name="price" placeholder="Nhập giá tiền...(Đơn vị: VND)"></div>
					</div>
					<div class="modal_button">
						<div>
							<input type="submit" value="OK" class="button_submit">
						</div>
						<div>
							<input type="reset" value="Cancel" class="button_cancel">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Đây là modal chỉnh sửa món ăn -->
	<div class="modal_back" id="modal_edit" >
		<div class="modal_container">
			<div class="modal_title">
				<div>Chỉnh sửa món ăn</div>
				<div><i class="fas fa-times button_close"></i></div>
			</div>
			<div class="modal_content">
				<p style="color: red">* Là các trường bắt buộc.</p>
				{{-- <form method="POST" id="form_update">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
					<input type="hidden" id="id_food" name="id" />
					<div class="information">
						<div><img src="font-end/image/image19.jpg"></div>
						<div><input type="file" name="image"  accept="image/gif, image/jpg, image/jpeg, image/png" class="upload"></div>
					</div>
					<div class="information">
						<div><label for="dish_edit"> Tên món<span style="color: red">*</span>: </label></div>
						<div><input id="dish_edit" class="input" type="text" name="dish"></div>
					</div>
					<div class="information">
						<div><label for="restaurant_edit">Tên quán<span style="color: red">*</span>: </label></div>
						<div><input id="restaurant_edit"  class="input" type="text" name= "restaurant"></div>
					</div>
					<div class="information">
						<div><label for="price_edit">Giá tiền<span style="color: red">*</span>: </label></div>
						<div><input id="price_edit" class="input" type="text" name="price"></div>
					</div>
					<div class="modal_button">
						<div>
							<input type="submit" value="OK" class="button_submit" id="update_form_food">
						</div>
						<div>
							<input type="reset" value="Cancel" class="button_cancel">
						</div>
					</div>
				{{-- </form> --}}
			</div>
		</div>
	</div>
	<!-- Đây là modal chọn món -->
	<div class="modal_back" id="modal_select">
		<div class="modal_container">
			<form action="{{ route('food_order.store') }}" method="POST" id="form_update">
				@csrf
				<input type="hidden" id="id_food_order" name="id" />
				<div class="modal_title">
					<div>Chọn món ăn</div>
					<div><i class="fas fa-times button_close"></i></div>
				</div>
				<div class="modal_content">
					<p>Bữa trưa hôm nay của bạn là:<span id="selected_name_food">Tên món</span>-<span id="selected_res_food">Tên quán</span>. Chúc bạn ngon miệng ♡ !</p>
					<div style="text-align: center; padding: 20px 0px">
						<img src="font-end/image/image18.jpg">
					</div>	
				</div>
				<div class="modal_button">
					<div>
						<input type="submit" class="button_ok" value="OK">
					</div>
					<div>
						<button class="button_cancel"><a href="{{ route('food_order.index') }}">Xem lịch sử</a></button>
					</div>
				</div>
			</form>
		</div>	
	</div>
	<!-- Đây là modal xóa món -->
	<div id="modal_delete" class="modal_back">
		{{-- <form action="{{ route('food.destroy', 2) }}" method="POST" id="form_update">
			@method('delete')
    		@csrf --}}
			<input type="hidden" id="id_food_delete" name="id" />
			<div class="modal_container">
				<div class="modal_title">
					<div>Xóa món ăn</div>
					<div><i class="fas fa-times button_close"></i></div>
				</div>
				<div class="modal_content">
					<div>
						<p><i class="fas fa-exclamation-triangle"></i> Bạn có chắc chắn muốn xóa món ăn này khỏi danh sách?</p>
						<br/>
						<br/>
					</div>
					<div class="modal_button">
						<div>
							<button class="button_ok" id="btn_delete">OK</button>
						</div>
						<div>
							<button value="Cancel" class="button_cancel">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		{{-- </form> --}}
	</div>
</body>
<!-- Day la javascript dung thu vien jquery -->
<script language="javascript" type="text/javascript" src="{{ asset('font-end/javascript/jquery-3.4.1.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('font-end/javascript/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('font-end/javascript/menu_jq.js') }}"></script>
</html>