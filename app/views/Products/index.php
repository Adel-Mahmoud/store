<div class="d-flex align-items-center justify-content-center">
  <div class="container" style="overflow:scroll;">
    <br>
    <a class="float-right btn btn-primary" href="<?php echo URL_ROOT.'products/addPro';?>">
    اضافة منتج
    </a>
    <h2>
      المجموع
       [<b id="allRows"></b>]
    </h2>
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
      <table class="table table-striped" id="table-id">
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
              اسم المخزن
            </th>
            <th scope="col">
              Part Number 
            </th>
            <!--
            <th scope="col">
              الكمية
            </th>
            -->
            <th scope="col">
              السعر
            </th>
            <th scope="col">
              التاريخ 
            </th>
          </tr>
        </thead>
        <tbody class="text-center" id="myTable">
          <?php
          foreach ($data["allProducts"] as $product){
          echo '
          <tr>
            <td>
              <a class="text-danger del" href="'.URL_ROOT.'products/deletePro/'.$product->p_id.'">
              حذف
              </a>
               | 
              <a class="text-info" href="'.URL_ROOT.'products/editPro/'.$product->p_id.'">
              تعديل
              </a>
            </td>
            <td>'.str_replace("_"," ",$product->pname).'</td>
            <td>'.str_replace("_"," ",$product->mname).'</td>
            <td>'.str_replace("_"," ",$product->cname).'</td>
            <td>'.str_replace("_"," ",$product->storename).'</td>
            <td>'.$product->barcode.'</td>
            <td>'.$product->price.'</td>
            <td>'.$product->pdate.'</td>
          </tr>
             ';
            // <td>'.$product->pqty.'</td>
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