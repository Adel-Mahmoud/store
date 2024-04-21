
/*
|======================================
|
|      programming  : Adel Mahmoud
|      phone number : +201018646196
|   
|======================================
*/
      
      window.onload=()=>{$(".loading").hide();}
      setTimeout(function() {$("#status").hide(500);}, 1500);
       // start open camera
      $("#openCamera").click(()=>{
        const html5QrCode = new Html5Qrcode("qr-reader");
        Html5Qrcode.getCameras().then(devices => {
          if (devices && devices.length) {
            html5QrCode.start(
              {facingMode: "environment"}, {
                fps: 10,
                qrbox: {width: 1250, height: 1000}
              }, (output, decodedResult) => {
                // resultContainer.innerHTML = output;
                //alert(output)
                $('#search1').val(output);
                $('#exampleModalCenter').modal('hide');
              }
            ).catch(console.error);
          }
        }).catch(console.error);
      });
      /* var myCamera = ()=>{
        const html5QrCode = new Html5Qrcode("qr-reader");
        Html5Qrcode.getCameras().then(devices => {
          if (devices && devices.length) {
            html5QrCode.start(
              {facingMode: "environment"}, {
                fps: 10,
                qrbox: {width: 1250, height: 1000}
              }, (output, decodedResult) => {
                // resultContainer.innerHTML = output;
                //alert(output)
                $('#resultBarcode').val(output);
              }
            ).catch(console.error);
          }
        }).catch(console.error);
      } */
       // end open camera 
       // End sales page 
       // Search by name or barcode
        $("#inputSearch").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            $("#allRows").text($('#table-id tbody tr').length);
          });
        });
        $("#searchDate").on("change", function() {
          $("#showDate").text($(this).val().replace("/","-"));
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            $("#allRows").text($('#table-id tbody tr').length);
          });
        });
       // end search 
       // get data from button addQty
       let addQty = (a)=>{
         $("#product_id").val(a);
       }
       let transfer = (id,qt,p_id)=>{
           var optionHtml = "<option value=''>اختار الكمية</option>";
           for (let q = 1; q <= qt; q++) {
             optionHtml += '<option value="'+q+'">'+q+'</option>';
           }
           //alert(optionHtml)
           document.querySelector("#aQty").innerHTML=optionHtml;
           document.querySelector("#a_id").value=id;
           document.querySelector("#p_id").value=p_id;
       }
       // table date
        $("#allRows").text($('#table-id tbody tr').length);
        $(".del").click(function(){
          if (!confirm(`
            هل تريد الحذف؟
          `)){
            return false;
          }
        });
        getPagination('#table-id');
        function getPagination(table) {
          var lastPage = 1;
          $('#maxRows')
            .on('change', function(evt) {
             lastPage = 1;
              $('.pagination')
                .find('li')
                .slice(1, -1)
                .remove();
              var trnum = 0; // reset tr counter
              var maxRows = parseInt($(this).val()); // get Max Rows from select option
        
              if (maxRows == 50000) {
                $('.pagination').hide();
              } else {
                $('.pagination').show();
              }
        
              var totalRows = $(table + ' tbody tr').length; // numbers of rows
              $(table + ' tr:gt(0)').each(function() {
                // each TR in  table and not the header
                trnum++; // Start Counter
                if (trnum > maxRows) {
        // if tr number gt maxRows
        
        $(this).hide(); // fade it out
                }
                if (trnum <= maxRows) {
        $(this).show();
                } // else fade in Important in case if it ..
              }); //  was fade out to fade it in
              if (totalRows > maxRows) {
                // if tr total rows gt max rows option
                var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
                //	numbers of pages
                for (var i = 1; i <= pagenum; ) {
        // for each page append pagination li
        $('.pagination #prev')
          .before(
            '<li class="page-link" data-page="' +
              i +
              '">\
        								  <span>' +
              i++ +
              '<span class="sr-only">(current)</span></span>\
        								</li>'
          )
          .show();
                } // end for i
              } // end if row count > max rows
              $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
              $('.pagination li').on('click', function(evt) {
                // on click each page
                evt.stopImmediatePropagation();
                evt.preventDefault();
                var pageNum = $(this).attr('data-page'); // get it's number
        
                var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option
        
                if (pageNum == 'prev') {
        if (lastPage == 1) {
          return;
        }
        pageNum = --lastPage;
                }
                if (pageNum == 'next') {
        if (lastPage == $('.pagination li').length - 2) {
          return;
        }
        pageNum = ++lastPage;
                }
        
                lastPage = pageNum;
                var trIndex = 0; // reset tr counter
                $('.pagination li').removeClass('active'); // remove active class from all li
                $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
                // $(this).addClass('active');					// add active class to the clicked
        	  	limitPagging();
                $(table + ' tr:gt(0)').each(function() {
        // each tr in table not the header
        trIndex++; // tr index counter
        // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
        if (
          trIndex > maxRows * pageNum ||
          trIndex <= maxRows * pageNum - maxRows
        ) {
          $(this).hide();
        } else {
          $(this).show();
        } //else fade in
                }); // end of for each tr in table
              }); // end of on click pagination list
        	  limitPagging();
            })
            .val(5)
            .change();
        
          // end of on select change
    
      // END OF PAGINATION
    }
    
    function limitPagging(){
    	// alert($('.pagination li').length)
    
    	if($('.pagination li').length > 7 ){
    			if( $('.pagination li.active').attr('data-page') <= 3 ){
    			$('.pagination li:gt(5)').hide();
    			$('.pagination li:lt(5)').show();
    			$('.pagination [data-page="next"]').show();
    		}if ($('.pagination li.active').attr('data-page') > 3){
    			$('.pagination li:gt(0)').hide();
    			$('.pagination [data-page="next"]').show();
    			for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
    				$('.pagination [data-page="'+i+'"]').show();
    
    			}
    
    		}
    	}
    }
    
    $(function() {
      // Just to append id number for each row
      $('table tr:eq(0)').prepend('<th> ID </th>');
    
      var id = 0;
    
      $('table tr:gt(0)').each(function() {
        id++;
        $(this).prepend('<td>' + id + '</td>');
      });
    });