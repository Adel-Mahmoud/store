
// const url = "https://profcoder.tech/store/";
const url = "<?php echo URL_ROOT;?>";
var api = '<?php if(isset($data["api"])){echo $data["api"];}?>';
if (api == "edit") {
 $(".loading").show();
	$.get(url+'Products/getProductById/<?php if(isset($data["id"])){echo $data["id"];}?>',function(data,status) {
	  	var category = document.querySelectorAll("#catName option");
	  	var model = document.querySelectorAll("#modName option");
	  	category.forEach((item)=>{
	  		if (item.value==JSON.parse(data).c_id) {
	  			item.setAttribute("selected",true);
	  			// get model by category id 
	  			$.get(url+'Products/getModelsByCategory/'+JSON.parse(data).c_id,function(data, status) {
				    $(".loading").show();
				  	var template = "";
				  	if(status == "success"){
				      JSON.parse(data).map((item)=>{
					    	template += `<option value="${item.m_id}">${item.mname}</option>`;
					    });
				  	}else{
				  		template = '<option value=""> الفئة غير موجودة </option>';
				  	}
				    $("#modName").html(template);
				    if (status=="success") {
				    	$(".loading").hide();
				  	}
				  });
	  		}
	  	});
	  	model.forEach((item)=>{
	  		if (item.value==JSON.parse(data).m_id) {
	  			item.setAttribute("selected",true);
	  		}
	  	});
	  	$('#pName').val(JSON.parse(data).pname.replace('_'," "));
	  	$('#resultBarcode').val(JSON.parse(data).barcode);
	  	$('#qty').val(JSON.parse(data).pqty);
	  	$('#price').val(JSON.parse(data).price);
	  	if (status=="success") {
	    	$(".loading").hide();
	  	}
	  }
	);
}else if (api == "sales") {
  // Start sales page 
  $.get(url+'Sales/getAllCategories',function(data,status) {
	  	if(JSON.parse(data).length > 0){
		  	var template = `<option value="">
		  	اختار اسم الصنف
		  	</option>`;
	      JSON.parse(data).map((item)=>{
	    	template += `<option value="${item.c_id}">${item.cname}</option>`;
	    });
	  	}else{
	  		template = '<option value="">لا يوجد اي اصناف </option>';
	  	}
	  	$('#ScName').html(template);
	  	if (status=="success") {
	    	$(".loading").hide();
	  	}
	  });
	// get Products names
	$.get(url+'Sales/getAllProduct',function(data,status) {
		  	var template = ``;
		      JSON.parse(data).map((item)=>{
		    	template += `<option >${item.pname}</option>`;
		    });
		    $("#mylist").html(template);
		  	if (status=="success") {
		    	$(".loading").hide();
		  	}
		});
	// rate type
	let rate  = 0;
	let Price = 0;
  $.get(url+'Sales/getRate',function(data,status){rate = JSON.parse(data).type;});
  $("#search1").focus();
  // get all part number 
  $("#search1").on("keyup",()=>{
  	if($("#search1").val()!==""){
  		var template = "";
		  $.get(url+'Sales/getAllProductInBarcode',function(data,status){
		  	 JSON.parse(data).map((item)=>{
		  	 	template += `<option value="${item.barcode}">${item.pname.replace("_"," ")}</option>`;
		  	 });
		  	 if (status=="success") {
  					$("#datalist").html(template);
		  	 }
		  });
  		
  	}else{
  		$("#datalist").html("");
  	}
  });
  $("#btnSearch1").click(()=>{
 	  if ($("#search1").val()!=="") {
			$(".loading").show();
      // get all data
			$.get(url+'Sales/getDataByBarcode/'+$("#search1").val(),function(data,status) {
			  	if (JSON.parse(data)!==false) {
			  		$("#ScName").html(`<option value="${JSON.parse(data).c_id}">${JSON.parse(data).cname.replace("_"," ")}</option>`);
			  		$("#SmName").html(`<option value="${JSON.parse(data).m_id}">${JSON.parse(data).mname.replace("_"," ")}</option>`);
			  		$("#SpName").html(`<option value="${JSON.parse(data).p_id}">${JSON.parse(data).pname.replace("_"," ")}</option>`);
			  		$('#p_id').val(JSON.parse(data).p_id);
			  		var option = "";
			  		for (var i = 1; i <= JSON.parse(data).aqty; i++) {
			  			option += `<option value="${i}">${i}</option>`;
			  		}
			  		$("#Sqty").html(option);
			  		let Price = JSON.parse(data).price*rate;
			  		$("#pPrice").val(`سعر المنتج : ${Price}`);
			  		$("#totalP").val(` السعر الاجمالي : ${Price}`);
			  		$("#price").val(Price);
			  		$(".errrorSearch").text('');
			  		$('#Sqty').on("change",()=>{
			  			var total = $('#Sqty').val();
			  		  $("#pPrice").val(`سعر المنتج : ${Price}`);
							$("#totalP").val(` السعر الاجمالي : ${Price*total}`);
						});
			  	}else{
			  		$(".errrorSearch").text(`
			  		غير موجود
			  		Part Number 
			  		`);
			  	}
			  	if (status=="success") {
			  		$(".loading").hide();
			  	}
			});
 	  }
 });
  var Search2 = false;
  /*
  $("#btnSearch2").click(()=>{
 	  if ($("#search2").val()!=="") {
			$(".loading").show();
      // get all data
			$.get(url+'Sales/getCategoresByProductName/'+$("#search2").val(),function(data,status) {
		  	var template = `
		  	<option value="">
        اختار اسم الصنف
        </option>
		  	`;
		  	if(JSON.parse(data).length > 0){
		      JSON.parse(data).map((item)=>{
		    	template += `<option value="${item.c_id}">${item.cname}</option>`;
		    });
		  	}else{
		  		template = '<option value=""> الصنف غير موجود </option>';
		  	}
		    $("#ScName").html(template);
		    if (status=="success") {
		    	Search2 = true;
		    	$(".loading").hide();
		    }
			});
 	  }
	  });
	*/
  $('#ScName').on("change",()=>{
		$(".loading").show();
		var URL_DATA = "";
  	/*
  	if (Search2==true) {
  		URL_DATA = url+'Sales/getModelsByProductName/'+$("#search2").val()+'/'+$("#ScName").val();
  	}else{
  		URL_DATA = url+'Sales/getModelsByCategory/'+$("#ScName").val();
  	}
  	*/
    URL_DATA = url+'Sales/getModelsByCategory/'+$("#ScName").val();
		$.get(URL_DATA,function(data,status) {
		  	var template = `
		  	<option value="">
        اختار اسم الفئة
        </option>
		  	`;
		  	if(JSON.parse(data).length > 0){
		      JSON.parse(data).map((item)=>{
		    	template += `<option value="${item.m_id}">${item.mname.replace("_"," ")}</option>`;
		    });
		  	}else{
		  		template = '<option value=""> الفئة غير موجودة </option>';
		  	}
		    $("#SmName").html(template);
		    if (status=="success") {
		    	$(".loading").hide();
		    }
		  
		});
	});
	$('#SmName').on("change",()=>{
	  if($('#SmName').val()!==""){
	  	$(".loading").show();
			$.get(url+'Sales/productData/'+$("#ScName").val()+'/'+$("#SmName").val(),function(data,status) {
			  	var template = `
			  	<option value="">
	        اختار اسم المنتج 
	        </option>
			  	`;
		      JSON.parse(data).map((item)=>{
		    	  template += `<option value="${item.p_id}">${item.pname.replace("_"," ")}</option>`;
		      });
			    $("#SpName").html(template);
			    if (status=="success") {
			    	$(".loading").hide();
			    }
			});
	  }
	});
  $('#SpName').on("change",()=>{
	  $('#product').val($('#SpName').val());
	  $(".loading").show();
	  if ($('#SpName').val()!=="") {
			$.get(url+'Sales/getQty/'+$("#SpName").val(),function(data,status) {
			  	var template = ``;
			  	for (var q = 1; q <= JSON.parse(data).aqty; q++){
		  			template += `<option value="${q}">${q}</option>`;
			  	}
			    $("#Sqty").html(template);
			  	$('#pPrice').val('سعر المنتج : '+JSON.parse(data).price*rate);
			  	$('#p_id').val(JSON.parse(data).p_id);
			  	$('#totalP').val('السعر الاجمالي : '+JSON.parse(data).price*rate);
			    $("#price").val(JSON.parse(data).price*rate)
			    if (status=="success") {
			    	$(".loading").hide();
			    }
			});
	  }
	  /*
	  <option value="">
	        اختار الكمية
	        </option>
	  $("#Sqty").load(url+'api/getQty/'+$("#SpName").val());
	  $(".loading").show();
	  $("#resultPrice").load(url+'api/getPrice/'+$("#SpName").val(), function(){
	    });
	  */
	 
	});
	$('#Sqty').on("change",()=>{
	  if($('#Sqty').val()!==""){
	  	$(".loading").show();
			$('#totalP').val('السعر الاجمالي :  '
				+$('#Sqty').val()*$("#price").val());
			$(".loading").hide();
	  }
	});
	// sale add data
  $("#addS").click(()=>{
    if ($("#p_id").val()!==""&&$("#ScName").val()!==""&&$("#SmName").val()!==""&&$("#SpName").val()!==""&&$("#Sqty").val()!=="") { 
			$(".loading").show();
	  	$.post(url+'Sales/addSale2', {addS:'send',p_id:$("#p_id").val(),Sqty:$("#Sqty").val(),rate:rate}, function(response){ 
	      $("#statu").html(response);
	      $("#search1").val("");
	      $("#p_id").val("");
	      $("#SmName").val("");
	      $("#SpName").val("");
	      $("#Sqty").val("");
	      $("#search1").focus();
				$(".loading").hide();
			});
    }
       
  });
  // End sales page 
}
// Start add products
$('#catName').on("change",()=>{
	$(".loading").show();
	$.get(url+'Products/getModelsByCategory/'+$("#catName").val(),function(data, status) {
	  	var template = "";
	  	if(status == "success"){
	      JSON.parse(data).map((item)=>{
	    	template += `<option value="${item.m_id}">${item.mname.replace("_"," ")}</option>`;
	    });
	  	}else{
	  		template = '<option value=""> الفئة غير موجودة </option>';
	  	}
	    $("#modName").html(template);
	    if (status=="success") {
	    	$(".loading").hide();
	  	}
	  }
	);
});
// End add products 
