<!-- Camera -->
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
    <div id="statu"></div>
    <div class="login" >
      <h2 class="login-header">
        المبيعات
      </h2>
        <div class="searchManual login-container" >
          
          <h6 class="text-center text-danger errrorSearch"></h6>
          <p class="sales-search" dir="rtl">
          	<span id="openCamera" data-toggle="modal" data-target="#exampleModalCenter">
	            📷
	          </span>
            <button class="btn btn-success" id="btnSearch1">
            	بحث 
            </button>
            <input type="text" list="datalist" id="search1" value="" placeholder="
            Part Number
            " />
            <datalist id="datalist"></datalist>
          </p>
          <!--
          <p class="sales-search" dir="rtl">
            <button class="btn btn-success" id="btnSearch2">
            	بحث 2
            </button>
            <input type="text" list="mylist" id="search2" value="" placeholder="
            إسم المنتج
            " />
            <datalist id="mylist"></datalist>
          </p>
          -->
          <hr>
          <p>
            <select class="form-control" id="ScName" name="ScName" dir="auto" required >
              <option value="">
              اختار اسم الصنف
              </option>
            </select>
          </p>
          <p>
            <select class="form-control" id="SmName" name="SmName" dir="auto" required>
              <option value="">
              اختار اسم الفئة
              </option>
            </select>
          </p>
          <p>
            <select class="form-control" id="SpName" name="SpName" dir="auto" required>
              <option value="">
              اختار اسم المنتج
              </option>
            </select>
          </p>
          <p>
            <select class="form-control" id="Sqty" name="Sqty" dir="auto" required>
              <option value="">
                اختار الكمية
              </option>
            </select>
          </p>
          <h1 class="d-none" id="resultPrice"></h1>
          <p>
            <input type="text" style="text-align:right;" id="pPrice" value="
            سعر المنتج : 0
            " disabled/>
          </p>
          <p id="conPrice">
            <input type="hidden" name="p_id" id="p_id" required>
            <input type="hidden" name="price" id="price" required>
            <input class="text-right" type="text" name="" id="totalP" dir="rtl" disabled value="
            السعر الاجمالي :  0
            " />
          </p>
          <p><input name="addS" type="submit" id="addS" value="حفظ"></p>
          <p>
          	<a href="" class="text-info float-right">
          		إعادة البحث
          	</a>
            <?php
            if(isset($_SESSION["management"])){
             echo '<a href="'.URL_ROOT.'Sales/index" class="float-left btn text-primary">
            الرجوع للمبيعات
             </a>';
            }?>
          </p>
          <br>
        </div>
    </div>
  </div>
</div>