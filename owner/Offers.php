<?php include 'init.php';
$pageTitel = "Offers"
?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<?php
// get all proparty which belong to owner
$owner_id = $_SESSION['owner_id'];
$offers_data = $conn->prepare("SELECT * FROM offers JOIN users ON offers.offer_user_id = users.user_id WHERE offer_owner_id = ? AND `offer_status` = 0");
$offers_data->execute([$owner_id]);
$offers_data = $offers_data->fetchAll(PDO::FETCH_OBJ);
?>
<h1 class="p-relative">العروض</h1>
<!-- Start Projects Table -->
<div class="projects p-20 bg-white rad-10 m-20">
  <div id="loadingIcon" style="display: none;">
    <i class="fas fa-spinner fa-spin"></i> Loading...
  </div>
  <h2 class="mt-0 mb-20">العروض</h2>
  <?php
  if (count($offers_data) > 0) :
  ?>
    <div class="responsive-table">
      <table class="fs-15 w-full txt-c">
        <thead>
          <tr>
            <td>عرض من</td>
            <td>محتوي العرض</td>
            <td>الرقم المرجعي للعقار</td>
            <td>التاريخ</td>
            <td>رفض | قبول</td>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($offers_data as $offer) :
            $timestamp = strtotime($offer->offer_timestamp); // Convert string timestamp to integer
            $formattedDate = date("Y-m-d", $timestamp);
          ?>
            <tr id="row_<?php echo $offer->offer_user_id ?>">
              <td><?php echo $offer->FullName ?></td>
              <td><?php echo $offer->offer_content ?></td>
              <td><a href="<?php echo $prop_details_page ?>?PId=<?php echo $offer->offer_property_id ?>"><?php echo $offer->offer_property_id ?></a></td>
              <td><?php echo $formattedDate  ?></td>
              <td>
                <button data-userID="<?php echo $offer->offer_user_id ?>" data-PropID="<?php echo $offer->offer_property_id ?>" class="btn-shape b-none bg-blue c-white mr-10     acceptOffer">قبول</button>
                <button data-userID="<?php echo $offer->offer_user_id ?>" data-PropID="<?php echo $offer->offer_property_id ?>" class="btn-shape b-none bg-red c-white refuseOffer">رفض</button>
              </td>
            </tr>
          <?php
          endforeach;
          ?>
        </tbody>
      </table>
    </div>
  <?php
  else :
    echo "<h2 class='no-query'>لا يوجد عروض</h2>";
  endif;
  ?>
</div>
<!-- End Projects Table -->
</div>
</div>
</div>
<?php include $templates . 'footer.php'; ?>