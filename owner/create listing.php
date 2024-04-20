<?php include 'init.php';
?>
<?php
$pageTitel = "Alwasit | إنشاء عقار جديد";
if (isset($_SESSION['uploaded_success'])) {
  echo '<p class="success-message ">تم إرسال العقار بنجاح <br> سيتم الموافقه عليه في اقرب وقت</p>';
  unset($_SESSION['uploaded_success']);
}
?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'create';
?>
<?php
switch ($action) {
  case 'create':
    //!SECTION START CREATE NEW PROPERTY FORM
?>
    <!-- Start Property form -->
    <h1 class="p-relative txt-r">إضافة عقار جديد</h1>
    <div class="projects  p-20 bg-white rad-10 m-20">
      <h2 class="mt-0 mb-20 txt-r">أنشئ عقار جديد</h2>
      <form enctype="multipart/form-data" method="POST" action="backend.php" class="responsive-form d-flex flex-direction-column w-full">
        <div class="propertyTitle form-group">
          <label for="propertyTitle">اسم العقار</label>
          <input required="required" name="propertyTitle" placeholder="مثال : شقة للبيع / للإيحار" type="text" class="form-control" id="propertyTitle">
        </div>
        <div class="propertyDescription form-group">
          <label for="propertyDescription">وصف العقار</label>
          <textarea name="propertyDescription" required="required" placeholder="وصف مفصل للعقار" class="form-control" id="propertyDescription" rows="7"></textarea>
        </div>
        <div class="type-conditions">
          <div class="Type_input form-group">
            <label>نوع العقار</label>
            <select required="required" name="propertyType" class="selectpicker form-select" data-live-search="true" data-width="100%">
              <option value="type1">شقة</option>
              <option value="Type2">فيلا</option>
            </select>
          </div>
          <div class="Type_input form-group">
            <label>حالة العقار</label>
            <select required="required" name="propertyStatus" class="selectpicker form-select" data-live-search="true" data-width="100%">
              <option value="status1">لللإيجار</option>
              <option value="status2">للبيع</option>
            </select>
          </div>
        </div>
        <div class="price-area-rooms">
          <div class="Price_input form-group">
            <div class="my_profile_setting_input form-group">
              <label for="formGroupExamplePrice">السعر</label>
              <input required="required" name="propertyPrice" placeholder="السعر بالجنيه المصري" type="number" class="form-control" id="formGroupExamplePrice">
            </div>
          </div>
          <div class="Area_input form-group">
            <label for="formGroupExampleArea">المساحه
            </label>
            <input required="required" name="propertyArea" placeholder="المساحه بالمتر المربع" type="number" class="form-control" id="formGroupExampleArea">
          </div>
          <div class="Rooms form-group">
            <label>الغرف</label>
            <select name="propertyRooms" required="required" class="selectpicker form-select" data-live-search="true" data-width="100%">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="more">other</option>
            </select>
            <p class="help-text"> غرف نوم / جميع غرف المنزل </p>
          </div>
          <div class="baths form-group">
            <label>الحمامات</label>
            <select name="propertyBaths" required="required" class="selectpicker form-select" data-live-search="true" data-width="100%">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>
        </div>
        <div class="Address form-group">
          <label for="propertyAddress">عنوان العقار</label>
          <input required="required" name="propertyAddress" placeholder="عنوان مفصل للعقار" type="text" class="form-control" id="propertyAddress">
        </div>
        <div class="city-neighborhood">
          <div class="form-group">
            <label for="neighborhood">الحي/البلدة</label>
            <input required="required" placeholder="مثال : الحميات / الرمد / الواسطي" type="text" name="propertyNeighborhood" class="form-control" id="neighborhood">
          </div>
          <div class="form-group">
            <label for="City">المحافظة</label>
            <input required="required" placeholder="مثال : بني سويف" type="text" class="form-control" name="propertyCity" id="City">
          </div>
        </div>
        <div class="latitude-longitude">
          <div class="form-group">
            <label for="locationURL">موقع العقار</label>
            <input required="required" type="text" name="locationURL" class="form-control" id="locationURL">
            <p class="help-text location"> <span>Google Map</span> لينك موقع العقار من تطبيق </p>
          </div>
          <div class="form-group">
            <label for="build-year">سنة البناء</label>
            <input required="required" type="text" class="form-control" id="build-year" name="buildingYear">
          </div>
        </div>
        <div class="form-group">
          <label for="imgs">قم بإرفاق 5 صور للعقار</label>
          <div class="file-drop-area">
            <span class="fake-btn">اختر الملفات</span>
            <span class="file-msg">أو قم بسحب الملفات هنا</span>
            <input required="required" class="file-input" id="imgs" type="file" multiple accept="image/*" name="imgs[]">
            <div class="item-delete"></div>
          </div>
        </div>
        <div class="form-group btn"> <button class="publish-btn">نشر</button> </div>
      </form>
    </div>
    <!-- End Property form -->
    <?php
    break;
  case 'Edit':
    //!SECTION START EDIT PROPERTY FORM
    $property_id = isset($_GET['PropID']) ? $_GET['PropID'] : 0;
    if ($property_id == 0) :
      echo '<h2 style="color:red;">Error in property ID.</h2>';
      exit();
    else :
      //NOTE - Get property data from database.
      $stmt = $conn->prepare("SELECT * FROM properties WHERE property_id = ? LIMIT 1");
      $stmt->execute(array($property_id));
      $count = $stmt->rowCount();
      if ($count > 0) :
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $propertyTitle = $row->title;
        $propertyDescription = $row->description;
        $propertyType = $row->type;
        $propertyStatus = $row->status;
        $propertyPrice = $row->price;
        $propertyArea = $row->area;
        $propertyRooms = $row->rooms;
        $propertyBaths = $row->bath;
        $propertyAddress = $row->address;
        $propertyNeighborhood = $row->neighborhood;
        $propertyCity = $row->city;
        $locationURL = $row->location_url;
        $buildingYear = $row->building_in;
        $imgs = $row->img;
    ?>
        <!-- Start Property form -->
        <h1 class="p-relative txt-r">تعديل عقار </h1>
        <div class="projects  p-20 bg-white rad-10 m-20">
          <h2 class="mt-0 mb-20 txt-r">تعديل عقار </h2>
          <form enctype="multipart/form-data" method="POST" action="edit_property.php" class="responsive-form d-flex flex-direction-column w-full">
            <div class="propertyTitle form-group">
              <input type="hidden" name="property_id" value="<?php echo $property_id?>">
              <label for="propertyTitle">اسم العقار</label>
              <input required="required" value="<?php echo $propertyTitle ?>" name="propertyTitle" placeholder="مثال : شقة للبيع / للإيحار" type="text" class="form-control" id="propertyTitle">
            </div>
            <div class="propertyDescription form-group">
              <label for="propertyDescription">وصف العقار</label>
              <textarea name="propertyDescription" required="required" placeholder="وصف مفصل للعقار" class="form-control" id="propertyDescription" rows="7"><?php echo htmlspecialchars($propertyDescription); ?></textarea>
            </div>
            <div class="type-conditions">
              <div class="Type_input form-group">
                <label>نوع العقار</label>
                <select required="required" name="propertyType" class="selectpicker form-select" data-live-search="true" data-width="100%">
                  <option value="type1"><?php echo $propertyType ?></option>
                  <option value="type2">فيلا</option>
                </select>
              </div>
              <div class="Type_input form-group">
                <label>حالة العقار</label>
                <select required="required" name="propertyStatus" class="selectpicker form-select" data-live-search="true" data-width="100%">
                  <option value="status1"><?php echo $propertyStatus ?></option>
                  <option value="status2">للبيع</option>
                </select>
              </div>
            </div>
            <div class="price-area-rooms">
              <div class="Price_input form-group">
                <div class="my_profile_setting_input form-group">
                  <label for="formGroupExamplePrice">السعر</label>
                  <input required="required" name="propertyPrice" value="<?php echo (int)$propertyPrice ?>" placeholder="السعر بالجنيه المصري" type="number" class="form-control" id="formGroupExamplePrice">
                </div>
              </div>
              <div class="Area_input form-group">
                <label for="formGroupExampleArea">المساحه
                </label>
                <input required="required" name="propertyArea" value="<?php echo (int)$propertyArea ?>" placeholder="المساحه بالمتر المربع" type="number" class="form-control" id="formGroupExampleArea">
              </div>
              <div class="Rooms form-group">
                <label>الغرف</label>
                <select name="propertyRooms" required="required" class="selectpicker form-select" data-live-search="true" data-width="100%">
                  <option value="<?php echo $propertyRooms ?>"><?php echo $propertyRooms ?></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="more">other</option>
                </select>
                <p class="help-text"> غرف نوم / جميع غرف المنزل </p>
              </div>
              <div class="baths form-group">
                <label>الحمامات</label>
                <select name="propertyBaths" required="required" class="selectpicker form-select" data-live-search="true" data-width="100%">
                  <option value="<?php echo $propertyBaths ?>"><?php echo $propertyBaths ?></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
            </div>
            <div class="Address form-group">
              <label for="propertyAddress">عنوان العقار</label>
              <input required="required" name="propertyAddress" value="<?php echo $propertyAddress ?> " placeholder="عنوان مفصل للعقار" type="text" class="form-control" id="propertyAddress">
            </div>
            <div class="city-neighborhood">
              <div class="form-group">
                <label for="neighborhood">الحي/البلدة</label>
                <input required="required" autocomplete="false" value="<?php echo $propertyNeighborhood ?> " placeholder="مثال : الحميات / الرمد / الواسطي" type="text" name="propertyNeighborhood" class="form-control" id="neighborhood">
              </div>
              <div class="form-group">
                <label for="City">المحافظة</label>
                <input autocomplete="false" required="required" value="<?php echo $propertyCity ?> " placeholder="مثال : بني سويف" type="text" class="form-control" name="propertyCity" id="City">
              </div>
            </div>
            <div class="latitude-longitude">
              <div class="form-group">
                <label for="locationURL">موقع العقار</label>
                <input required="required" type="text" value="<?php echo $locationURL ?> " name="locationURL" class="form-control" id="locationURL">
                <p class="help-text location"> <span>Google Map</span> لينك موقع العقار من تطبيق </p>
              </div>
              <div class="form-group">
                <label for="build-year">سنة البناء</label>
                <input required="required" type="text" value="<?php echo $buildingYear ?>" class="form-control" id="build-year" name="buildingYear">
              </div>
            </div>
            <div class="form-group">
              <label for="imgs">قم بإرفاق 5 صور للعقار</label>
              <div class="file-drop-area">
                <span class="fake-btn">اختر الملفات</span>
                <span class="file-msg">أو قم بسحب الملفات هنا</span>
                <input type="hidden" name="old-imgs" value="<?php echo $imgs ?>">
                <input  class="file-input" id="imgs" type="file" multiple accept="image/*" name="new-imgs[]">
                <div class="item-delete"></div>
              </div>
            </div>
            <div class="form-group btn"> <button class="save-btn">حفظ التعديل</button> </div>
          </form>
        </div>
        <!-- End Property form -->
<?php
      endif;
    endif;
  default:
    # code...
    break;
}
?>

</div>
</div>
</div>
<?php include $templates . 'footer.php'; ?>