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
<h1 class="p-relative txt-r">العروض</h1>
<!-- Start Projects Table -->
<div class="projects p-20  rad-10 m-20">
  <div id="loadingIcon" style="display: none;">
    <i class="fas fa-spinner fa-spin"></i> جاري التحميل
  </div>
  <?php
  if (count($offers_data) > 0) :
  ?>
    <div class="responsive-table">
      <?php
      foreach ($offers_data as $offer) :
        $timestamp = strtotime($offer->offer_timestamp); // Convert string timestamp to integer
        $formattedDate = date("Y-m-d", $timestamp);
      ?>
        <div class="offer_card" id="row_<?php echo $offer->offer_user_id ?>">
          <h3> عرض بخصوص عقار <a href="<?php echo $prop_details_page ?>?PId=<?php echo $offer->offer_property_id ?>"><?php echo $offer->offer_property_id ?></a></h3>
          <p class="m-0 p-10"> عرض من : <span><?php echo $offer->FullName ?> </span></p>
          <div class="offer_content">
            <h4>محتوي العرض</h4>
            <p class="offer_text m-0"><?php echo $offer->offer_content ?></p>
            <p class="posted_date">
              <i class='fa-regular fa-clock'></i> <?php echo $formattedDate  ?>
            </p>
          </div>
          <div class="status">
            <p data-userID="<?php echo $offer->offer_user_id ?>" data-PropID="<?php echo $offer->offer_property_id ?>" class='offer_status success  acceptOffer'>قبول</p>
            <p data-userID="<?php echo $offer->offer_user_id ?>" data-PropID="<?php echo $offer->offer_property_id ?>" class="delete-offer refuseOffer">رفض</p>
          </div>
        </div>
      <?php
      endforeach;
      ?>
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