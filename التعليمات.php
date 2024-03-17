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
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>rent2.css">
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>footer.css">
    <!-- Reader all elements nomarlly -->
    <link rel="stylesheet" href="<?php echo $css ?>normalize.css" />
    <!-- Font awesome library -->
    <link rel="stylesheet" href="<?php echo $css ?>all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- animate text  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>Home</title>
</head>

<body>
    <!-- Start Header -->
    <?php include $templates . 'header.php' ?>
    <!-- End Header -->
    <!-- Start widget -->
    <div class="container info-content" dir="rtl">
        <div>
            <h1>التعليمات</h1>
            <div class="ol-div">
                <p style="margin: 60px 0 40px 0;">نرحب بك في موقعنا لبيع وتأجير العقارات والشقق السكنية. فيما يلي بعض التعليمات والإرشادات حول كيفية التعامل داخل الموقع:</p>
                <ol>
                    <li><strong>التسجيل:</strong> للاستفادة الكاملة من خدماتنا، يجب عليك التسجيل في الموقع من خلال إنشاء حساب مستخدم باستخدام عنوان بريد إلكتروني صالح وكلمة مرور آمنة.</li>
                    <li><strong>بحث عن العقارات:</strong> يمكنك استخدام واجهة البحث لتصفح العقارات المتاحة للبيع أو الإيجار. يمكنك تحديد المعايير المطلوبة مثل الموقع، النوع، السعر، وغيرها لتضييق نطاق البحث.</li>
                    <li><strong>عرض التفاصيل:</strong> بمجرد العثور على عقار يناسب احتياجاتك، يمكنك النقر عليه لعرض التفاصيل الكاملة بما في ذلك الوصف، الصور، والمزيد من المعلومات.</li>
                    <li><strong>التواصل مع البائع:</strong> إذا كنت مهتماً بعقار معين، يمكنك التواصل مع البائع مباشرة من خلال نموذج الاتصال المتوفر في صفحة التفاصيل.</li>
                    <li><strong>تقديم العروض:</strong> إذا كنت ترغب في بيع أو تأجير عقارك، يمكنك إنشاء حساب البائع وتقديم العروض الخاصة بك، مع إضافة تفاصيل العقار والصور لجذب المشترين.</li>
                    <li><strong>الحفاظ على الأمان:</strong> يجب عليك توخي الحذر والحفاظ على سرية معلوماتك الشخصية. لا تشارك معلوماتك الشخصية مع أطراف غير موثوق بها وابق على علم بسياسة الخصوصية للموقع.</li>
                </ol>
                <p>نأمل أن تجد موقعنا مفيدًا وسهل الاستخدام. إذا كان لديك أي أسئلة أو استفسارات، فلا تتردد في الاتصال بنا عبر معلومات الاتصال المتاحة.</p>
            </div>
        </div>
    </div>

    <!-- End widget -->
    <!-- Start footer -->
    <?php include $templates . 'footer.php' ?>
    <!-- End footer -->