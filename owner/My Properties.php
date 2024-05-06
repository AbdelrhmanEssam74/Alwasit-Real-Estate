<?php include 'init.php';
$pageTitel = " | My Properties"
?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<?php
// get all proparty which belong to owner
$owner_id = $_SESSION['owner_id'];
$prop_data = $conn->prepare("SELECT * FROM properties WHERE owner_id = ? AND `deleted` = 0");
$prop_data->execute([$owner_id]);
$prop_data = $prop_data->fetchAll(PDO::FETCH_OBJ);
?>
<h1 class="p-relative txt-r">العقارات</h1>
<!-- Start Projects Table -->
<div id="delete-modal" class="modal-overlay">
  <div class="close-overlay"></div>
  <div class="modal">
    <h2> ! سبب حذف العقار</h2>
    <textarea name="delete-reason" placeholder="اكتب سبب حذف العقار" id="delete-reason" cols="30" rows="10"></textarea>
    <p class="invalid"></p>
    <button id="delete-confirm-button">حذف</button>
  </div>
</div>
<p class="success-message2"></p>
<div class="projects p-20 bg-white rad-10 m-20">
  <h2 class="mt-0 mb-20 txt-r ">العقارات</h2>
  <div class="responsive-table">
    <table class="fs-15 w-full txt-c">
      <thead>
        <tr>
          <td>تعديل | حذف</td>
          <td>الحاله</td>
          <td>التعليقات</td>
          <td>المساحه</td>
          <td>السعر</td>
          <td>تاريخ النشر</td>
          <td>العنوان</td>
          <td>اسم العقار</td>
        </tr>
      </thead>
      <tbody>
        <?php
        //NOTE - display properties details 
        if (isset($prop_data)) :
          foreach ($prop_data as $property) :
            $_SESSION['property_title'] = $property->title . " | " . $property->neighborhood;
        ?>
            <tr id="row_<?php echo $property->property_id ?>">
              <td>
                <button data-owner="<?php echo $owner_id ?>" data-PropID="<?php echo $property->property_id ?>" class="delete-btn fs-14 bg-red c-white w-fit b-none btn-shape">حذف</button>
                <a href="create listing.php?action=Edit&PropID=<?php echo $property->property_id ?>" class=" fs-14 bg-blue c-white w-fit b-none btn-shape">تعديل</a>
              </td>
              <?php
              if ($property->active == 0) {
                echo " <td>  <p class='fs-15 bg-red c-white pt-5 pb-5 rad-6'> قيد الانتظار </p></td>";
              } else {
                echo " <td>  <p class='fs-15 bg-blue c-white pt-5 pb-5 rad-6'>تم الموافقه</p></td>";
              }
              ?>
              <td><?php echo $property->comments_num ?></td>
              <td><?php echo $property->area ?> m²</td>
              <td><?php echo number_format($property->price) ?></td>
              <td><?php echo $property->uploaded_at ?></td>
              <td><?php echo substr($property->address, 0, 50) ?></td>
              <td><a href="<?php echo $prop_details_page ?>?PId=<?php echo $property->property_id ?>"><?php echo $property->title ?></a></td>
            </tr>
        <?php
          endforeach;
        endif;
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- End Projects Table -->
</div>
</div>
</div>
<?php include $templates . 'footer.php'; ?>