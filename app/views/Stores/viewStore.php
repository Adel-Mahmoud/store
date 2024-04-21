    <!-- Modal Add QTY-->
    <div class="modal fade" id="exampleModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary" >
            <h3 class="text-center text-light w-100" >
              اضافة كمية
            </h3>
          </div>
          <div class="modal-body">
            <form method="post">
              <div class="w-100">
                <input id="product_id" type="hidden" name="a_id">
                <input class="form-control" type="number" name="qty" placeholder="
                ادخل الكمية 
                ">
                <br>
                <button class="btn btn-primary btn-block" name="addQty">
                  اضافة 
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Model transfer QTY -->
    <div class="modal fade" id="exampleModalTransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary" >
            <h3 class="text-center text-light w-100" >
              نقل كمية
            </h3>
          </div>
          <div class="modal-body">
            <form method="post">
              <div class="w-100">
                <input id="a_id" type="hidden" name="a_id">
                <input id="p_id" type="hidden" name="p_id">
                <br>
                  <select class="form-control" name="store2_id" dir="auto" required >
                  <?php
                    echo ' 
                    <option value="">
                      اختار اسم المخزن
                    </option>';
                    foreach($data["allStores"] as $store){
                      if($data["storeName"]->storename !== $store->storename){
                        echo '
                        <option value="'.$store->store_id.'">
                        '.str_replace("_"," ",$store->storename).'
                        </option>
                        ';
                      }
                    }
                  ?>
                  </select>
                <br>
                <select class="form-control" id="aQty" name="tqty" dir="auto" required>
                  <option value="">
                    اختار الكمية
                  </option>
                  
                </select>
                <br>
                <button class="btn btn-primary btn-block" name="transfer">
                  نقل 
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="d-flex align-items-center justify-content-center">
      <div class="container">
        <br>
        <?php if(isset($data["status"])){echo $data["status"];}?>
        <br>
        <h3 class="text-primary text-center">
          <?php echo str_replace("_"," ",$data["storeName"]->storename);?>
        </h3>
        <br>
        <a class="float-right btn btn-primary" href="<?php echo URL_ROOT.'stores/index';?>">
        الرجوع للمخازن
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
                <th scope="col" style="width:200px;">
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
                  Part Number 
                </th>
                <th scope="col">
                  الكمية  
                </th>
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
               foreach ($data["storeData"] as $storeData){
                 echo '
              <tr>
                <td>
                  <button class="btn btn-primary btn-sm btnAddQty" data-toggle="modal" data-target="#exampleModalAdd" onclick="addQty('.$storeData->a_id.')">
                   اضافه
                  </button>
                  <a class="btn btn-danger btn-sm del" href="'.URL_ROOT.'stores/deleteProduct/'.$storeData->a_id.'">
                  حذف
                  </a>
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalTransfer" onclick="transfer('.$storeData->a_id.','.$storeData->aqty.','.$storeData->p_id.')">
                   &nbsp;نقل&nbsp; 
                  </button>
                </td>
                <td>'.str_replace("_"," ",$storeData->pname).'</td>
                <td>'.str_replace("_"," ",$storeData->mname).'</td>
                <td>'.str_replace("_"," ",$storeData->cname).'</td>
                <td>'.$storeData->barcode.'</td>
                <td>'.$storeData->aqty.'</td>
                <td>'.$storeData->price.'</td>
                <td>'.$storeData->pdate.'</td>
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
