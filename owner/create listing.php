<?php include 'init.php'; ?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<h1 class="p-relative txt-r">إضافة عقار جديد</h1>
<!-- Start Property form -->
<div class="projects  p-20 bg-white rad-10 m-20">
  <h2 class="mt-0 mb-20 txt-r">أنشئ عقار جديد</h2>
  <div class="responsive-form d-flex flex-direction-column w-full">
    <div class="propertyTitle form-group">
      <label for="propertyTitle">عنوان العقار</label>
      <input required="required" type="text" class="form-control" id="propertyTitle">
    </div>
    <div class="propertyDescription form-group">
      <label for="propertyDescription">وصف العقار</label>
      <textarea required="required" class="form-control" id="propertyDescription" rows="7"></textarea>
    </div>
    <div class="type-conditions">
      <div class="Type_input form-group">
        <label>نوع العقار</label>
        <select required="required" class="selectpicker form-select" data-live-search="true" data-width="100%">
          <option data-tokens="type1">شقة</option>
          <option data-tokens="Type2">فيلا</option>
        </select>
      </div>
      <div class="Type_input form-group">
        <label>حالة العقار</label>
        <select required="required" class="selectpicker form-select" data-live-search="true" data-width="100%">
          <option data-tokens="type1">لللإيجار</option>
          <option data-tokens="Type2">للبيع</option>
        </select>
      </div>
    </div>
    <div class="price-area-rooms">
      <div class="Price_input form-group">
        <div class="my_profile_setting_input form-group"><label for="formGroupExamplePrice">السعر</label>
          <input required="required" type="number" class="form-control" id="formGroupExamplePrice">
        </div>
      </div>
      <div class="Area_input form-group">
        <label for="formGroupExampleArea">المساحه</label>
        <input required="required" type="text" class="form-control" id="formGroupExampleArea">
      </div>
      <div class="Rooms form-group">
        <label>الغرف</label>
        <select required="required" class="selectpicker form-select" data-live-search="true" data-width="100%">
          <option data-tokens="Status1">1</option>
          <option data-tokens="Status2">2</option>
          <option data-tokens="Status3">3</option>
          <option data-tokens="Status4">4</option>
          <option data-tokens="Status5">5</option>
        </select>
      </div>
      <div class="baths form-group">
        <label>الحمامات</label>
        <select required="required" class="selectpicker form-select" data-live-search="true" data-width="100%">
          <option data-tokens="Status1">1</option>
          <option data-tokens="Status2">2</option>
          <option data-tokens="Status2">3</option>
        </select>
      </div>
    </div>
    <div class="Address form-group">
      <label for="propertyAddress">عنوان العقار</label>
      <input required="required" type="text" class="form-control" id="propertyAddress">
    </div>
    <div class="city-neighborhood">
      <div class="form-group">
        <label for="neighborhood">الحي/البلدة</label>
        <input required="required" type="text" class="form-control" id="neighborhood">
      </div>
      <div class="form-group">
        <label for="City">المحافظة</label>
        <input required="required" type="text" class="form-control" id="City">
      </div>
    </div>
    <div class="latitude-longitude">
      <div class="form-group">
        <label for="Latitude">خط العرض</label>
        <input required="required" type="text" class="form-control" id="Latitude">
      </div>
      <div class="form-group">
        <label for="longitude">خط الطول</label>
        <input required="required" type="text" class="form-control" id="longitude">
      </div>
      <div class="form-group">
        <label for="longitude">سنة البناء</label>
        <input required="required" type="text" class="form-control" id="longitude">
      </div>
    </div>
    <div class="form-group">
      <label for="imgs">قم بإرفاق 5 صور للعقار</label>
      <div class="file-drop-area">
        <span class="fake-btn">Choose files</span>
        <span class="file-msg">or drop files here</span>
        <input required="required" class="file-input" id="imgs" type="file" multiple>
        <div class="item-delete"></div>
      </div>
    </div>
    <div class="form-group btn">
      <button class="publish-btn">نشر</button>
    </div>
  </div>
</div>
<!-- End Property form -->
</div>
</div>
</div>
<?php include $templates . 'footer.php'; ?>