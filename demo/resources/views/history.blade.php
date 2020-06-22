<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" >
	<title>
		What is for lunch today?
	</title>
	<link href="{{ asset('font-end/image/favicon.ico') }}" type="image/ico" rel="shortcut icon">
    <link href="{{ asset('font-end/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('font-end/css/history.css') }}" rel="stylesheet">
    <link href="{{ asset('https://use.fontawesome.com/releases/v5.7.0/css/all.css') }}"integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Alegreya+Sans|Dosis|Just+Another+Hand|Kalam&display=swap') }}" rel="stylesheet">
</head>
<body>
	@include('TopView')
	<div class="content history">
		<h1>Lịch sử chọn món</h1>
		<div class="sticker_container">
			<div class="calendar_sticker">
				<div class="weekday">Thứ 2</div>
				<div class="comment">🍜🦐10☆<br>~~~~</div>
			</div>
			<div class="calendar_sticker">
				<div class="weekday">Thứ 3</div>
				<div class="comment">😋🍩🍰<br>~~~~</div>
			</div>
			<div class="calendar_sticker">
				<div class="weekday">Thứ 4</div>
				<div class="comment">🍚(゜))く<br>~~~~</div>
			</div>
			<div class="calendar_sticker">
				<div class="weekday">Thứ 5</div>
				<div class="comment">🍱🥛<br>~~~~</div>
			</div>
			<div class="calendar_sticker">
				<div class="weekday">Thứ 6</div>
				<div class="comment">🍞🍖(>_<)<br>~~~~</div>
			</div>
			<div class="calendar_sticker">
				<div class="weekday">Thứ 7</div>
				<div class="comment">🍕🍗🍎<br>~~~~</div>
			</div>
			<div class="calendar_sticker">
				<div class="weekday">Chủ nhật</div>
				<div class="comment">☀🏠🍳<br>~~~~</div>
			</div>	
		</div>
		<div class="list">
			<table id="my_content_history">
				<tr>
					<th class='column_first'>STT</th>
					<th class='column'>Ảnh</th>
					<th class='column'>Tên món</th>
					<th class='column'>Tên quán</th>
					<th class='column'>Giá (VND)</th>
					<th class='column'>Thời gian</th>
				</tr>
				@if(count($listFoodOrder) >= 1)
					@foreach($listFoodOrder as $foodOrder)
						<tr>
						<td class='column_first'>{{ $loop->iteration }}</td>
						<td class='column'><img src='font-end/image/image{{ $loop->iteration }}.jpg'/></td>
						<td class='column'>{{ $foodOrder->food->name }}</td>
						<td class='column'>{{ $foodOrder->food->res }}</td>
						<td class='column'>{{ $foodOrder->food->price }}</td>
						<td class='column'>{{ $foodOrder->created_at }}</td>
						</tr>
					@endforeach
				@else
				@endif
			</table>
		</div>
	</disv>
	<div class="footer">
		<p>
			Training project by OWS JSC.<br/>
			For feedback and support, please contact: <a href="mailto:huongdt@ows.com.vn">huongdt@ows.com.vn</a>
		</p>
	</div>
	<script language="javascript" type="text/javascript" src="{{ asset('font-end/javascript/jquery-3.4.1.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('font-end/javascript/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('font-end/javascript/menu_jq.js') }}"></script>
</body>
</html>