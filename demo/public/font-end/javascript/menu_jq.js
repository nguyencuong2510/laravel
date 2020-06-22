let idEdit = null;
$(document).ready(function () {
	$("#button_add").click(function (res) {
		$('#modal_add').css('display', 'flex');
	});
	$("#button_select").click(function () {
		let url = "http://localhost/demo/public/food/getRandom"
		$.ajax({
			url: url,
			contentType: "application/json",
			dataType: 'json',
			success: function (result) {
				let data = result[0];
				
				$('#id_food_order').val(data['id']);
				$('#selected_name_food').text(data['name']);
				$('#selected_res_food').text(data['res']);

				$('#modal_select').css('display', 'flex');
			},
			fail: function (result) {
				let data = result['data'];
				alert(data['message']);
			}
		})
	});
	$(document).on('click', ".button_edit", function () {
		idEdit = this.id
		let url = "http://localhost/demo/public/food/" + this.id
		$.ajax({
			url: url,
			contentType: "application/json",
			dataType: 'json',
			success: function (result) {
				$('#id_food').val(result['id']);
				$('#price_edit').val(result['price']);
				$('#dish_edit').val(result['name']);
				$('#restaurant_edit').val(result['res']);
				$('#modal_edit').css('display', 'flex');
			},
			fail: function(xhr, textStatus, errorThrown){
				alert('request failed');
			 }
		})
	});
	$(document).on('click', "#update_form_food", function () {
	
		let id = $("#id_food").val();
		let name = $("#dish_edit").val();
		let res = $("#restaurant_edit").val();
		let price = $("#price_edit").val();
		let url = "http://localhost/demo/public/food/" + id;
		
		$.ajax({
			url: url,
			type:'PUT',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{dish: name, restaurant: res, price: price},
			success:function(data){
				location.reload();
			},
			fail: function(xhr, textStatus, errorThrown){
				alert('request failed');
			}
		});
	})
	$(document).on('click', ".button_delete", function () {
		$('#id_food_delete').val(this.id);
		$('#modal_delete').css('display', 'flex');
	});
	$(document).on('click', "#btn_delete", function () {
		let id = $("#id_food_delete").val();
		let url = "http://localhost/demo/public/food/" + id;
		
		$.ajax({
			url: url,
			type:'DELETE',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(data){
				location.reload();
			},
			fail: function(xhr, textStatus, errorThrown){
				alert('request failed');
			}
		});
	});
	$(".button_close").click(function () {
		$(".modal_back").hide();
	});
	$(".button_cancel").click(function () {
		$(".modal_back").hide();
	});
	$(".button_ok").click(function () {
		$(".modal_back").hide();
	});
	$("#form_add").validate({
		rules: {
			dish: "required",
			restaurant: "required",
			price: {
				required: true,
				digits: true,
				minlength: 4
			},
		},
		messages: {
			dish: "Bạn chưa nhập tên món ăn.",
			restaurant: "Bạn chưa nhập tên quán.",
			price: {
				required: "Bạn chưa nhập giá tiền",
				digits: "Vui lòng nhập giá tiền là số.",
				minlength: "Giá tiền bạn nhập đang < 1000 VND."
			},
		},
		errorElement: 'div',

	});
	$("#form_update").validate({
		rules: {
			dish: "required",
			restaurant: "required",
			price: {
				required: true,
				digits: true,
				minlength: 4
			},
		},
		messages: {
			dish: "Bạn chưa nhập tên món ăn.",
			restaurant: "Bạn chưa nhập tên quán.",
			price: {
				required: "Bạn chưa nhập giá tiền",
				digits: "Vui lòng nhập giá tiền là số.",
				minlength: "Giá tiền bạn nhập đang < 1000 VND."
			},
		},
		errorElement: 'div',

	});
});

function loadAllHistory() {
	let url = "http://localhost/Food_Order/index/action/get_all_food_history.php";
	$.ajax({
		url: url,
		contentType: "application/json",
		dataType: 'json',
		success: function (result) {
			let data = result['data'];
			let handleTag = "<tr><th class='column_first'>STT</th><th class='column'>Ảnh</th><th class='column'>Tên món</th><th class='column'>Giá (VND)</th><th class='column'>Tên quán</th><th class='column'>Ngày giờ</th></tr>"
			let stt = 0;
			let images = [6, 9, 7, 15];
			
			data.forEach(element => {
				stt += 1
				let randomNumber = Math.floor(Math.random() * 3);
				let image_link = "font-end/image/image" + images[randomNumber] + ".jpg";

				handleTag += "<tr>";
				handleTag += "<td class='column_first'>" + stt + " </td>";
				handleTag += "<td class='column'><img src='" + image_link + "'/></td>";
				handleTag += "<td class='column'>" + element['name'] + "</td>";
				handleTag += "<td class='column'>" + element['price'] + "</td>";
				handleTag += "<td class='column'>" + element['res'] + "</td>";
				handleTag += "<td class='column'>" + element['day'] + "</td>";
				handleTag += "</tr>";
			});
			$('#my_content_history').append(handleTag);
		},
		fail: function (result) {
			let data = result['data'];
			alert(data['message']);
		}
	})
}

function loadAllFood() {
	let url = "http://localhost/Food_Order/index/action/get_all_food.php";
	$.ajax({
		url: url,
		contentType: "application/json",
		dataType: 'json',
		success: function (result) {
			let data = result['data'];
			let handleTag = "";
			handleTag += "<tr>";
			handleTag += "<th class='column_first'>STT</th>";
			handleTag += "<th class='column'>Ảnh</th>";
			handleTag += "<th class='column'>Tên món</th>";
			handleTag += "<th class='column'>Giá (VND)</th>";
			handleTag += "<th class='column'>Tên quán</th>";
			handleTag += "<th class='column_last'></th>";
			handleTag += "<th class='column_last'></th></tr>";

			let stt = 0;
			let images = [6, 9, 7, 15];
			
			data.forEach(element => {
				stt += 1
				let randomNumber = Math.floor(Math.random() * 3);
				let image_link = "font-end/image/image" + images[randomNumber] + ".jpg";

				handleTag += "<tr>"
				handleTag += "	<td class='column_first'>" + stt + "</td>"
				handleTag += "	<td class='column'><img src='" + image_link + "'/></td>"
				handleTag += "	<td class='column'>" + element['name'] + "</td>"
				handleTag += "	<td class='column'>" + element['price'] + "</td>"
				handleTag += "	<td class='column'>" + element['res'] + "</td>"
				handleTag += "	<td class='column_last'><i id="+ element['id'] +" class=' fas fa-pencil-alt button_edit'></i></td>"
				handleTag += "	<td class='column_last'><i id="+ element['id'] +" class=' fas fa-trash-alt button_delete'></i></td>"
				handleTag += "</tr>"
			});
			$('#id_content_food').append(handleTag);
		},
		fail: function (result) {
			let data = result['data'];
			alert(data['message']);
		}
	})
}
