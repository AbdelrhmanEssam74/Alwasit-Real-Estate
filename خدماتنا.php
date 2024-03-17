<?php include 'init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main External Css file -->
    <link rel="stylesheet" href="<?php echo $css ?>rent2.css">
    <link rel="stylesheet" href="<?php echo $css ?>main.css">
    <link rel="stylesheet" href="<?php echo $css ?>footer.css">
    <!-- Reader all elements nomarlly -->
    <link rel="stylesheet" href="<?php echo $css ?>normalize.css" />
    <!-- Font awesome library -->
    <link rel="stylesheet" href="<?php echo $css ?>all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- animate text  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>من نحن</title>
</head>

<body>
    <!-- Start Header -->
    <?php include $templates . 'header.php' ?>
    <!-- End Header -->

    <div class="ag-format-container container">
        <h1>خدماتنا</h1>
        <div class="ag-courses_box">
            <div class="ag-courses_item">
                <div class="ag-courses-item_link">
                    <div class="ag-courses-item_bg"></div>
                    <div class="ag-courses-item_title">
                        <h4>البحث عن العقارات</h4>
                        <p> موقعنا يقدم مجموعة من الخدمات المفيدة والمتنوعة لمساعدتك في إيجاد العقار المناسب لك أو لعرض عقارك للبيع أو للإيجار. فيما يلي نظرة عامة على خدماتنا
                        </p>
                    </div>
                </div>
            </div>
            <div class="ag-courses_item">
                <div class="ag-courses-item_link">
                    <div class="ag-courses-item_bg"></div>
                    <div class="ag-courses-item_title">
                        <h4>عرض التفاصيل الكاملة</h4>
                        <p>بمجرد العثور على عقار مهم لك، يمكنك عرض التفاصيل الكاملة له بما في ذلك الوصف، الصور، وميزات العقار</p>
                    </div>
                </div>
            </div>
            <div class="ag-courses_item">
                <div class="ag-courses-item_link">
                    <div class="ag-courses-item_bg"></div>
                    <div class="ag-courses-item_title">
                        <h4>تقديم العروض</h4>
                        <p>إذا كنت تمتلك عقارًا ترغب في بيعه أو تأجيره، يمكنك إنشاء حساب البائع وتقديم العروض الخاصة بك لجذب المشترين</p>
                    </div>
                </div>
            </div>
            <div class="ag-courses_item">
                <div class="ag-courses-item_link">
                    <div class="ag-courses-item_bg"></div>
                    <div class="ag-courses-item_title">
                        <h4>خدمة العملاء</h4>
                        <p>يمكنك الاتصال بفريق خدمة العملاء لدينا في حالة وجود أي استفسارات أو مشكلات، وسنكون سعداء بمساعدتك</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- start footer -->
    <?php include $templates . 'footer.php'; ?>
    <!-- End footer -->