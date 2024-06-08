<?php 
include_once 'init.php';
include_once $config . 'config.php';
include_once $config . 'search.php';
$DefultPage = '';
$search_page = "";
$search_obj = new search;
$status_arr = [
  "1" => "للبيع",
  "2" => "للإيجار"
];

$propertyStatus = (!empty($_GET['c'])) ? $_GET['c'] : "";           // Get the property status
$searchQuery    = (!empty($_GET['q'])) ? $_GET['q'] : "";           // Get the search query

$category_arr  = [];
$categories = $search_obj->search("SELECT * FROM `categories` ORDER BY `categories`.`category_id` ASC");
foreach ($categories as $category) {
  $category_arr[$category->category_id] = $category->category_name;
}
//NOTE - First the main search query must has the status of the property then check every input value
// echo "<pre>";
// print_r($search_obj->search_by_type($status_arr[$propertyStatus]));
// echo "</pre>";
$pageTitel = "عقارات " . $status_arr[$propertyStatus] . "  في بني سويف - " . $searchQuery;
include_once $templates . 'header.php'; // <!-- Start Header -->
include_once $templates . 'navbar.php';
?>
<div class="container">
  <form class="form_search" action="search.php" method="get">
    <div class="check_btn">
      <?php
      if ($propertyStatus == 1) {

        echo <<< _END
                          <label>
                          <input type="radio" class="toggle-radio" name="c" value="1" id="buy" checked>
                          <div class="toggle-buy"></div>
                          </label>
                          <label>
                          <input type='radio' class='toggle-radio' name='c' value='2' id='rent'>
                          <div class="toggle-rent"></div>
                          </label>
                _END;
      } else {
        echo <<< _END
                          <label>
                          <input type="radio" class="toggle-radio" name="c" value="1" id="buy" >
                          <div class="toggle-buy"></div>
                          </label>
                          <label>
                          <input type='radio' class='toggle-radio' name='c' value='2' id='rent' checked>
                          <div class="toggle-rent"></div>
                          </label>
                _END;
      }
      ?>
    </div>
    <div class="search_inputs">
      <div class="input_control_search">
        <input type="text" name="q" oninput="showSuggestions()" value="<?php echo $searchQuery ?>" autocomplete="false" id="searchInput" placeholder="الحي او المنطقة">
        <p class="no-suggestion-message" id="noSuggestionMessage"></p>
        <ul class="suggestion-list" id="suggestionList">
        </ul>
        <i class='bx bx-search'></i>
      </div>
      <div class="select_type">
        <select name="t" id="propertyTypeSelect">
          <option value="all">نوع العقار</option>
        </select>
      </div>
      <div class="select_price">
        <p class="price_text" data-min="<?php echo $minPrice ?>" data-max="<?php echo $maxPrice ?>">السعر</p>
        <div class="price_input">
          <div class="input_field">
            <div class="input_field_min">
              <input type="number" name="pmi" placeholder="الحد الادني للسعر" id="minPriceInput">
              <ul class="suggestion_min_price">
              </ul>
            </div>
            <span>-</span>
            <div class="input_field_max">
              <input type="number" name="pmx" placeholder="الحد الاقصي للسعر" id="maxPriceInput">
              <ul class="suggestion_max_price">
              </ul>
            </div>
          </div>
          <div class="rest_price_input">إعادة ضبط</div>
        </div>
      </div>
      <div class="select_area">
        <p class="area_text">المساحه <span>(متر مربع)</span></p>
        <div class="area_input">
          <div class="input_field">
            <div class="input_field_min">
              <input type="number" name="ami" placeholder="اقل مساحه" id="minAreaInput">
              <ul class="suggestion_min_area">
              </ul>
            </div>
            <span>-</span>
            <div class="input_field_max">
              <input type="number" name="amx" placeholder="اكبر مساحه" id="maxAreaInput">
              <ul class="suggestion_max_area">
              </ul>
            </div>
          </div>
          <div class="rest_area_input">إعادة ضبط</div>
        </div>
      </div>
      <div class="submit_btn">
        <button type="submit" value=""><i class="fa fa-search"></i></button>
      </div>
    </div>
  </form>
</div>
<!-- Start widget -->
<div class="modal-container modal-overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
<div class="modal-container-2 modal-overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn login" id="login-comment" for="modal-toggle"></button>
  </div>
</div>
<?php
// Get properties from the database
$query = "SELECT * FROM properties INNER JOIN owners ON properties.owner_id = owners.owner_id LEFT JOIN favorites ON favorites.fav_property_id = properties.property_id WHERE status LIKE '%" . ($status_arr[$propertyStatus]) . "%'";
if (!empty($searchQuery)) {
  $query .= " AND neighborhood LIKE '%" . trim($searchQuery) . "%'";
}
// Sorting configuration
$sortOptions = array(
  'd' => 'uploaded_at ASC',
  'pa' => 'price ASC',
  'pd' => 'price DESC',
  'aa' => 'area ASC',
  'ad' => 'area DESC'
);
$currentSort = isset($_GET['o']) ? $_GET['o'] : '';
// Modify the query to include the sorting order
if (array_key_exists($currentSort, $sortOptions)) {
  $query .= " ORDER BY " . $sortOptions[$currentSort];
}
// Pagination configuration
$itemsPerPage = 6;
$totalItemsQuery = $search_obj->search($query); // Execute query to get total items
$totalItems = count($totalItemsQuery);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Modify the query to include the limit and offset
$queryWithLimit = $query . " LIMIT $offset, $itemsPerPage";
$data = $search_obj->search($queryWithLimit); // Execute query with limit and offset

?>
<p class="success-message"></p>
<div class="sort-by-overlay"></div>
<div class="design">
  <div class="container" dir="rtl">
    <div class="text">
      <h2>عقارات <?php echo $status_arr[$propertyStatus] ?> في بني سويف</h2>
      <p><span><?php echo $totalItems ?></span>عقارات اخري </p>
    </div>
    <div class="sort-by">
      <div class="sort_by_btn">ترتيب حسب</div>
      <div class="sort_list">
        <?php
        $sortOptions = array(
          'o=d' => 'الأحدث',
          'o=pa' => 'اقل سعر',
          'o=pd' => 'اعلي سعر',
          'o=aa' => 'اقل مساحة',
          'o=ad' => 'اكبر مساحة'
        );
        $currentSort = isset($_GET['o']) ? $_GET['o'] : '';
        ?>
        <?php foreach ($sortOptions as $option => $label) : ?>
          <?php
          $url = $_SERVER['REQUEST_URI'];
          $urlParts = parse_url($url);
          $query = isset($urlParts['query']) ? $urlParts['query'] : '';
          parse_str($query, $existingParams);
          $existingParams['o'] = $option;
          $url = $urlParts['path'] . '?' . $urlParts['query'] . '&' . $existingParams['o'];
          ?>
          <a href="<?php echo $url; ?>"><?php echo $label; ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<div class="widget-container">
  <div class="container">
    <div class="widgets">
      <?php
      // Shuffle the data randomly
      // shuffle($data);
      if (!empty($data)) :
        foreach ($data as $prop) :
          $imgs = explode(",", $prop->img);
          $main_img = $imgs[0];
      ?>
          <div class="property-body">
            <div class="images-details">
              <a href="<?php echo $prop_details ?>?PId=<?php echo  $prop->property_id ?>" class="property-link">
                <img class="prop-img" src="<?php echo $owner ?>/upload/<?php echo $prop->owner_id . "/" . $prop->property_id . "/" . $main_img ?>" alt="">
              </a>
              <div class="details-top">
                <div class="details-type">
                  <div class="type1"><?php echo  $prop->type ?></div>
                  <?php
                  echo ($prop->status == 'لللإيجار') ? '<div class="rent">للإيجار</div>' : '<div class="buy">للبيع</div>';
                  ?>
                </div>
                <div class="favorite-box" data-fav="<?php echo ($prop->property_id == $prop->fav_property_id and $prop->checked == 1 and $prop->fav_user_id == $user_id) ? $prop->checked : 0 ?>" data-PID="<?php echo  $prop->property_id ?>" data-OID="<?php echo  $prop->owner_id ?>" data-UID="<?php echo $user_id ?>">
                  <button title="اضف للمفضلة" class=' property-favorite'>
                    <span class='icon-heart-o'>
                      <i class="fa-regular fa-heart"></i>
                    </span>
                  </button>
                </div>
              </div>
              <div class="details-bottom">
                <div class="property-details">
                  <div class="bath">
                    <p><?php echo $prop->bath ?></p>
                    <i class='bx bx-bath'></i>
                  </div>
                  <div class="rooms">
                    <p><?php
                        if ($prop->rooms == 0) {
                          echo '+5';
                        } else {
                          echo $prop->rooms;
                        }
                        ?></p>
                    <i class='bx bx-bed'></i>
                  </div>
                  <div class="area">
                    <p><?php echo $prop->area ?> m<sup>2</sup> </p>
                    <i class='bx bx-layout'></i>
                  </div>
                </div>
                <div class="photos">
                  <p>5</p>
                  <i class="fa-solid fa-camera"></i>
                </div>
              </div>
            </div>
            <div class="proparty-info">
              <div class="location">
                <i class="fa-solid fa-location-dot"></i>
                <p><?php echo $prop->neighborhood ?></p>
              </div>
              <div class="description">
                <p>......<?php echo substr($prop->description, 0, 55) ?></p>
              </div>
              <div class="price">
                <p><?php echo number_format($prop->price) ?> <span>جنيه</span></p>
              </div>
              <hr>
              <div class="owner">
                <a href="<?php echo APPURL ?>profile.php?ID=<?php echo $prop->owner_id ?>">
                  <p> : المالك </p>
                  <span><?php echo  $prop->full_name ?></span>
                </a>
              </div>
            </div>
          </div>
      <?php
        endforeach;
      endif;
      ?>
    </div>
  </div>
</div>
<?php
if (empty($data)) {
?>
  <div class='no-prop'>
    <h2>لاوجود لعقارت مطابقة لبحثك حالياً</h2>
    <p>بإمكانك تجربة التالي</p>
    <p>تغيير الموقع</p>
    <img src="../ar/images/img1.svg" alt="">
  </div>
<?php
}
?>
<!-- End widget -->
<!-- // Display pagination links -->
<div class="pagination">
  <?php if ($totalPages > 2) : ?>
    <?php if ($currentPage > 1) : ?>
      <?php
      $queryParams = $_GET;
      $queryParams['page'] = $currentPage - 1;
      $url = $_SERVER['REQUEST_URI'];
      $urlParts = parse_url($url);
      $query = isset($urlParts['query']) ? $urlParts['query'] : '';
      parse_str($query, $existingParams);
      $mergedParams = array_merge($existingParams, $queryParams);
      $mergedQuery = http_build_query($mergedParams);
      $url = $urlParts['path'] . '?' . $mergedQuery;
      ?>
      <a href="<?php echo $url; ?>" id="arrow">&lt;</a>
    <?php endif; ?>

    <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
      <?php
      $queryParams = $_GET;
      $queryParams['page'] = $page;
      $url = $_SERVER['REQUEST_URI'];
      $urlParts = parse_url($url);
      $query = isset($urlParts['query']) ? $urlParts['query'] : '';
      parse_str($query, $existingParams);
      $mergedParams = array_merge($existingParams, $queryParams);
      $mergedQuery = http_build_query($mergedParams);
      $url = $urlParts['path'] . '?' . $mergedQuery;
      ?>
      <?php if ($page == $currentPage) : ?>
        <span class="current-page"><?php echo $page; ?></span>
      <?php else : ?>
        <a href="<?php echo $url; ?>"><?php echo $page; ?></a>
      <?php endif; ?>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages) : ?>
      <?php
      $queryParams = $_GET;
      $queryParams['page'] = $currentPage + 1;
      $url = $_SERVER['REQUEST_URI'];
      $urlParts = parse_url($url);
      $query = isset($urlParts['query']) ? $urlParts['query'] : '';
      parse_str($query, $existingParams);
      $mergedParams = array_merge($existingParams, $queryParams);
      $mergedQuery = http_build_query($mergedParams);
      $url = $urlParts['path'] . '?' . $mergedQuery;
      ?>
      <a href="<?php echo $url; ?>" id="arrow">&gt;</a>
    <?php endif; ?>
  <?php else : ?>
    <!-- Display all pages if there are 2 or fewer pages -->
    <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
      <?php
      $queryParams = $_GET;
      $queryParams['page'] = $page;
      $url = $_SERVER['REQUEST_URI'];
      $urlParts = parse_url($url);
      $query = isset($urlParts['query']) ? $urlParts['query'] : '';
      parse_str($query, $existingParams);
      $mergedParams = array_merge($existingParams, $queryParams);
      $mergedQuery = http_build_query($mergedParams);
      $url = $urlParts['path'] . '?' . $mergedQuery;
      ?>
      <?php if ($page == $currentPage) : ?>
        <span class="current-page"><?php echo $page; ?></span>
      <?php else : ?>
        <a href="<?php echo $url; ?>"><?php echo $page; ?></a>
      <?php endif; ?>
    <?php endfor; ?>
  <?php endif; ?>
</div>
<?php
include  $templates . 'footer.php';
