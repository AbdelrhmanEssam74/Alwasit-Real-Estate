<?php include 'init.php'; ?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<h1 class="p-relative">Offers</h1>
<!-- Start Projects Table -->
<div class="projects p-20 bg-white rad-10 m-20">
  <h2 class="mt-0 mb-20">Offers</h2>
  <div class="responsive-table">
    <table class="fs-15 w-full txt-c">
      <thead>
        <tr>
          <td>Offers From</td>
          <td>Offers Content</td>
          <td>Offers About</td>
          <td>Date</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Ahmed Mohamed</td>
          <td>طلب تقليل سعر الإيجار مقابل تجديد الشقه </td>
          <td><a href="">شقة للإيجار الحي الاول</a></td>
          <td>04-04-2024</td>
          <td>
            <button class="btn-shape b-none bg-blue c-white mr-10">Accept</button>
            <button class="btn-shape b-none bg-red c-white">Refuse</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- End Projects Table -->
</div>
</div>
</div>
<?php include $templates . 'footer.php'; ?>