    <div class="d-flex align-items-center justify-content-center">
      <div class="container" style="overflow:scroll;">
        <br>
        <a class="float-right btn btn-primary" href="<?php echo URL_ROOT.'categories/addCat';?>">
        اضافة صنف
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
          <table class="table table-striped" id="table-id" dir="rtl">
            <thead class="login-header">
              <tr>
                <th scope="col">
                  اكشن
                </th>
                <th scope="col">
                  اسم الصنف
                </th>
                <th scope="col">
                  التاريخ 
                </th>
              </tr>
            </thead>
            <tbody class="text-center" id="myTable">
              <?php
               foreach ($data["allCategories"] as $category){
                 echo '
              <tr>
                <td>
                  <a class="text-info" href="'.URL_ROOT.'categories/editCat/'.$category->c_id.'">
                  تعديل
                  </a>
                  |
                  <a class="text-danger del" href="'.URL_ROOT.'categories/deleteCat/'.$category->c_id.'">
                  حذف
                  </a>
                </td>
                <td>'.str_replace("_"," ",$category->cname).'</td>
                <td>'.$category->cdate.'</td>
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