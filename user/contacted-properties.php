<?php include_once 'init.php';
$DefultPage = '';
$pageTitel = 'Contacted Properties | Alwasit';
$setting_page = '';
?>
<?php include_once $templates . 'header.php' ?>
<!-- Start Header -->
<?php include_once $templates . 'navbar.php' ?>
<?php
include_once $config . 'config.php';
include_once $config . 'propertyTable.php';
// get all user information
$user_id = (isset($_SESSION['uID'])) ? $_SESSION['uID'] : 0;
$properties_obj = new PropertyTable;
// echo "<pre>";
// print_r($properties_obj->getContactedProperties($user_id));
// echo "</pre>";
$properties_data = $properties_obj->getContactedProperties($user_id);
?>
<!-- End Header -->
<div class="modal-container overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
<div class="setting">
  <p class="success-message"></p>
  <div class="container">
    <div class="parent">
      <div class="table-wrapper">
        <?php
        if (count($properties_data) > 0) :
        ?>
          <table class="fl-table">
            <thead>
              <tr>
                <th>الرقم المرجعي للعقار</th>
                <th>العرض</th>
                <th>الحالة</th>
                <th>التاريخ</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($properties_data as $property) :
                $timestamp = strtotime($property->offer_timestamp); // Convert string timestamp to integer
                $formattedDate = date("Y-m-d", $timestamp);
              ?>
                <tr>
                  <td><a href="<?php echo $main_link . "/property_details.php?PId=" . $property->property_id ?>"><?php echo $property->offer_property_id ?></a></td>
                  <td><?php echo $property->offer_content ?></td>
                  <td>
                    <?php
                    if ($property->offer_status == 0) :
                      echo "<p class='status wating'>قيد الانتظار</p>";
                    elseif ($property->offer_status == 1) :
                      echo "<p class='status accepted'>تم القبول</p>";
                    elseif ($property->offer_status == -1) :
                      echo "<p class='status refused'>مرفوض</p>";
                    endif;
                    ?>
                  </td>
                  <td><?php echo $formattedDate ?></td>
                  <td id="td-delete"><i data-uid="<?= $property->offer_user_id  ?>" data-pid="<?= $property->offer_property_id ?>" class=" delete-offer fa-solid fa-trash-can"></i></td>
                </tr>
              <?php
              endforeach;
              ?>
            <tbody>
          </table>
        <?php
        else :
          echo "<h2 class='no-query'>لم يتم الاستعلام عن اي عقار</h2>";
        endif;
        ?>
      </div>
      <nva class="sidebar">
        <a href="general-info.php" class="sidebar__list-item">
          <p> البيانات الشخصية</p>
          <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <a href="account-setting.php" class="sidebar__list-item">
          <p>إعدادت الحساب</p>
          <i class="fa fa-gear" aria-hidden="true"></i>
        </a>
        <a href="saved-properties.php" class="sidebar__list-item">
          <p>العقارات المحفوظة</p>
          <i class="fa-solid fa-heart"></i>
        </a>
        <a href="contacted-properties.php" class="sidebar__list-item is_active">
          <p>العقارات المتواصل بخصوصها</p>
          <i class="fa-solid fa-paperclip"></i>
        </a>
      </nva>
    </div>
  </div>
</div>
<script src="<?php echo $js ?>main.js"></script>
</body>

</html>