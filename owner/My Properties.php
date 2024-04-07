<?php include 'init.php'; ?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<?php
// get all proparty which belong to owner
$owner_id = $_SESSION['owner_id'];
$prop_data = $conn->prepare("SELECT * FROM properties WHERE owner_id = ?");
$prop_data->execute([$owner_id]);
$prop_data = $prop_data->fetchAll(PDO::FETCH_OBJ);
?>
<h1 class="p-relative">My Properties</h1>
<!-- Start Projects Table -->
<div class="projects p-20 bg-white rad-10 m-20">
  <h2 class="mt-0 mb-20">My Properties</h2>
  <div class="responsive-table">
    <table class="fs-15 w-full txt-c">
      <thead>
        <tr>
          <td>Title</td>
          <td>Date published</td>
          <td>Comments</td>
          <td>Status</td>
          <td>Price</td>
          <td>Area</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <?php
        //NOTE - display properties details 
        if (isset($prop_data)) :
          foreach ($prop_data as $property) :
        ?>
            <tr>
              <td><?php echo $property->title ?></td>
              <td><?php echo $property->uploaded_at ?></td>
              <td><?php echo $property->comments_num ?></td>
              <?php
              if ($property->active == 0) {
                echo " <td>  <p class='fs-15 bg-red c-white pt-10 pb-10 rad-6'> قيد الانتظار </p></td>";
              } else {
                echo " <td>  <p class='fs-15 bg-blue c-white pt-10 pb-10 rad-6'>تم الموافقه</p></td>";
              }
              ?>
              <td><?php echo $property->price ?></td>
              <td><?php echo $property->area ?></td>
              <td><button class=" fs-14 bg-red c-white w-fit b-none btn-shape">حذف</button></td>
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