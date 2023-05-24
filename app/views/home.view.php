<?php require views_path('partials/header');?>

	<div class="d-flex">
		<div style="min-height:600px;" class="shadow-sm col-7 p-4">
			
			<div class="input-group mb-3"><h3> Items </h3>
			  <input type="text" oninput="search_item(event);" class="ms-4 form-control js-search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" autofocus>
			  <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
			</div>

			<div class="js-products d-flex" style="flex-wrap: wrap;height: 90%;overflow-y: scroll;">
				
				<!--card-->
				
				<!--end card-->
				
			</div>
		</div>
		
		<div class="col-5 bg-light p-4 pt-2">
			
			<div><center><h3>Cart <div class="badge bg-primary rounded-circle">3</div></h3></center></div>
			<div class="table-responsive" style="height:400px; overflow-y: scroll;">
				<table class="table table-striped table-hover">
					<tr>
						<th>Image</th><th>Description</th><th>Amount</th>
					</tr>

						<!-- Items Start -->
						<tr>
							<td style="width:110px;"><img src="assets/images/image.jpg" style="width:100px;height:100px;"class="rounded border"></td>
							<td class="text-primary">
								COFEE SOFT DRINK
								<div class="input-group my-3" style="max-width:150px;">
									<span class="input-group-text" style="cursor: pointer;"><i class="fa fa-minus text-primary"></i></span>
									<input type="text" class="form-control text-center text-primary" placeholder="1" value="1">
									<span class="input-group-text text-primary" style="cursor: pointer;"><i class="fa fa-plus"></i></span>
								</div>
							</td>
							<td style="font-size:20px">
								NPR 500
							</td>
					</tr>
					<!-- Items End -->
				
					
						<!-- Items Start -->
						<tr>
							<td style="width:110px;"><img src="assets/images/image.jpg" style="width:100px;height:100px;"class="rounded border"></td>
							<td class="text-primary">
								COFEE SOFT DRINK
								<div class="input-group my-3" style="max-width:150px;">
									<span class="input-group-text" style="cursor: pointer;"><i class="fa fa-minus text-primary"></i></span>
									<input type="text" class="form-control text-center text-primary" placeholder="1" value="1">
									<span class="input-group-text text-primary" style="cursor: pointer;"><i class="fa fa-plus"></i></span>
								</div>
							</td>
							<td style="font-size:20px">
								NPR 500
							</td>
					</tr>
					<!-- Items End -->

					
						<!-- Items Start -->
						<tr>
							<td style="width:110px;"><img src="assets/images/image.jpg" style="width:100px;height:100px;"class="rounded border"></td>
							<td class="text-primary">
								COFEE SOFT DRINK
								<div class="input-group my-3" style="max-width:150px;">
									<span class="input-group-text" style="cursor: pointer;"><i class="fa fa-minus text-primary"></i></span>
									<input type="text" class="form-control text-center text-primary" placeholder="1" value="1">
									<span class="input-group-text text-primary" style="cursor: pointer;"><i class="fa fa-plus"></i></span>
								</div>
							</td>
							<td style="font-size:20px">
								NPR 500
							</td>
					</tr>
					<!-- Items End -->
						<!-- Items Start -->
						<tr>
							<td style="width:110px;"><img src="assets/images/image.jpg" style="width:100px;height:100px;"class="rounded border"></td>
							<td class="text-primary">
								COFEE SOFT DRINK
								<div class="input-group my-3" style="max-width:150px;">
									<span class="input-group-text" style="cursor: pointer;"><i class="fa fa-minus text-primary"></i></span>
									<input type="text" class="form-control text-center text-primary" placeholder="1" value="1">
									<span class="input-group-text text-primary" style="cursor: pointer;"><i class="fa fa-plus"></i></span>
								</div>
							</td>
							<td style="font-size:20px">
								NPR 500
							</td>
					</tr>
					<!-- Items End -->
				</table>
			</div>

			<div class="alert alert-danger" style="font-size: 25px;">Total: NPR 3000</div>
			<div>
				<button class="btn btn-success btn-sm my-2 py-3 w-100">Checkout</button>
				<button class="btn btn-primary btn-sm my-2 w-100">Clear</button>
			</div>
		</div>
	</div>	

<script>

	 function search_item(e){

		var text = e.target.value.trim();

		var data = {};
		data.data_type = "search";
		data.text = text;

		send_data(data);
	};

	function send_data(data)
	{

		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange',function(e){

			if(ajax.readyState == 4){

				if(ajax.status == 200)
				{
					handle_result(ajax.responseText);
				}else{

					console.log("An error occured. Err Code:"+ajax.status+" Err message:"+ajax.statusText);
				}
			}
			
		});

		ajax.open('post','index.php?pg=ajax',true);

		ajax.send(JSON.stringify(data));
	}

	function handle_result(result){
		
		// console.log(result);
		
		var obj = JSON.parse(result);

		if(typeof obj != "undefined"){

			//valid json
			var mydiv = document.querySelector(".js-products");
			mydiv.innerHTML = "";

			for (var i = 0; i < obj.length; i++) {
				
				mydiv.innerHTML += product_html(obj[i]);
			}
			
		}

	}

	function product_html(data)
	{
		return `
			<div class="card m-2 border-0 mx-auto" style="min-width: 165px;max-width: 165px;">
					<a href="#">
						<img src="${data.image}" class="w-100 rounded border">
					</a>
					<div class="p-2" style="font-size:20px">
						<div class="text-muted">${data.description}</div>
						<div class="" style="font-size:20px"><b>NPR ${data.amount}</b></div>
					</div>
			</div>
			`;
	}

	send_data({

		data_type:"search",
		text:""
	});

</script>

<?php require views_path('partials/footer');?>
