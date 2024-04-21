<!-- Camera -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Camera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="w-100" id="qr-reader">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
      </div>
    </div>
  </div>
</div>
<!-- Camera -->
<div class="d-flex align-items-center justify-content-center">
  <div class="container">
    <br>
    <h2 class="text-center text-primary">
      تقرير حسب التاريخ
    </h2>
    <input type="date" id="searchDate" >
    <label for="searchDate" class="float-right" style="font-size:30px;"><span id="showDate"></span> : 📅</label>
    <h2>
      المجموع
       [<b id="allRows"></b>]</h2>
    <input type="search" dir="auto" id="inputSearch" class="form-control" style="width:200px;float:right" placeholder="
    🔍 البحث 
    ">
		<div class="form-group float-left" style="width:120px;float:left"> 	
		  <!--		Show Numbers Of Rows 		-->
	 		<select class="form-control" name="state" id="maxRows">
				<option value="500">
				  عرض كل الصفوف
				</option>
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="70">70</option>
				<option value="100">100</option>
		  </select>
	  </div>
	  <div  style="overflow:scroll;width:100%" dir="rtl">
      <table class="table table-striped" id="table-id" dir="rtl">
        <thead class="login-header">
          <tr>
            <th scope="col">
              اكشن
            </th>
            <th scope="col">
              اسم المنتج 
            </th>
            <th scope="col">
              اسم الفئة 
            </th>
            <th scope="col">
              اسم الصنف 
            </th>
            <th scope="col">
              الكمية
            </th>
            <th scope="col">
              السعر
            </th>
            <th scope="col">
              المجموع
            </th>
            <th scope="col">
              البائع
            </th>
            <th scope="col">
              التاريخ 
            </th>
          </tr>
        </thead>
        <tbody class="text-center" id="myTable">
          <?php
           foreach ($data["allSales"] as $sale){
             echo '
          <tr>
            <td>
              <a class="text-danger del" href="'.URL_ROOT.'sales/deleteSale/'.$sale->s_id.'">
              حذف
              </a>
            </td>
            <td>'.str_replace("_"," ",$sale->pname).'</td>
            <td>'.str_replace("_"," ",$sale->smname).'</td>
            <td>'.str_replace("_"," ",$sale->scname).'</td>
            <td>'.$sale->qty.'</td>
            <td>'.$sale->price.'</td>
            <td>'.$sale->total.'</td>
            <td>'.str_replace("_"," ",$sale->seller).'</td>
            <td>'.$sale->date.'</td>
          </tr>
             ';
           }
          ?>
        </tbody>
      </table>
    </div>
    <!-- Start Pagination -->
		<div class='pagination-container' >
			<nav aria-label="Page navigation example" >
			  <ul class="pagination text-center">
          <li class="page-link" data-page="prev" >
			      <span>&laquo;<span class="sr-only ">(current)</span></span>
			    </li>
  				<!--	Here the JS Function Will Add the Rows -->
          <li class="page-link" data-page="next" id="prev">
    	      <span>&raquo;<span class="sr-only">(current)</span></span>
    	    </li>
			  </ul>
			</nav>
		</div>
  </div>
</div>