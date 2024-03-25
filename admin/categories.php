<?php
/*
	================================================
	== Category Page
	================================================
	*/
ob_start();
session_start();
$pageTitel = 'Category';
if (!(isset($_SESSION['login']) && $_SESSION['login'])) {
    header('Location: index.php');
    exit();
} else {
    include 'init.php';
    $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';
    //SECTION -  Manage Users
    switch ($action):
        case 'Manage':
?>
            <div class="container">
                <h1>Manage Categories</h1>
            <?php
            break;
        case 'Edit':
            //SECTION -  Logic of Edit Page 
            ?>
            <?php
            break;
        case 'Update':
            //SECTION -  Update page
            break;
        case 'Add':
            //!SECTION Add New Member page
            ?>
                <div class="container">
                    <h1 class="">Add New Category</h1>
                    <form action="?action=Insert" method="POST">
                        <!-- Start Name Field -->
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="name" class="form-control p-2" autocomplete="off" required="required" placeholder="Name Of The Category">
                            </div>
                        </div>
                        <!-- End Name Field -->
                        <!-- Start Description Field -->
                        <div class="row mb-3">
                            <label class="col-sm-2 control-label">Description:</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="description" class="form-control p-2" placeholder="Describe The Category" />
                            </div>
                        </div>
                        <!-- End Description Field -->
                        <!-- Start Ordering Field -->
                        <div class="row mb-3">
                            <label class="col-sm-2 control-label">Ordering</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="ordering" class="form-control p-2" placeholder="Number To Arrange The Categories" />
                            </div>
                        </div>
                        <!-- End Ordering Field -->
                        <!-- Start Category Type -->
                        <div class="row mb-3">
                            <label class="col-sm-2 control-label">Parent?</label>
                            <div class="col-sm-10 col-md-6">
                                <select class="form-select" aria-label="Default select example p-2">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Category Type -->
                        <!-- Start Visibility Field -->
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Visible:</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input id="vis-yes" name="visibility" value="1" checked class="form-check-input" type="radio">
                                    <label class="form-check-label" for="vis-yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="vis-no" name="visibility" value="0" class="form-check-input" type="radio">
                                    <label class="form-check-label" for="vis-no">
                                        No
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <!-- End Visibility Field -->
                        <!-- Start Commenting Field -->
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Visible:</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input d="com-yes" name="commenting" value="1" checked class="form-check-input" type="radio">
                                    <label class="form-check-label" for="vis-yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="com-no" name="commenting" value="0" class="form-check-input" type="radio">
                                    <label class="form-check-label" for="vis-no">
                                        No
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <!-- End Commenting Field -->
                        <!-- Start Ads Field -->
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Allow Ads:</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input d="ads-yes" name="ads" value="1" checked class="form-check-input" type="radio">
                                    <label class="form-check-label" for="ads-yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="ads-no" name="ads" value="0" class="form-check-input" type="radio">
                                    <label class="form-check-label" for="ads-no">
                                        No
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <!-- End Ads Field -->
                        <button type="submit" class="btn btn-primary btn-lg">Add Category</button>
                    </form>
                </div>
    <?php
            break;
        case 'Insert':
            //SECTION - insert page
            var_dump($_POST);
            break;
    endswitch;
}
include $templates . 'footer.php';
ob_end_flush();
