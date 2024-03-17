<?php include 'init.php' ?>
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

    <!-- Start widget -->
    <div class="container info-content" dir="rtl" style="padding: 60px 0;">
        <div>
            <h1>سياسة الخصوصية</h1>
            <div class="ol-div">
                <ol>
                    <li><strong>جمع المعلومات:</strong> نحن نقوم بجمع المعلومات الشخصية التي تقدمها لنا المستخدمين عند التسجيل على الموقع أو عند استخدام خدماتنا. يمكن أن تشمل هذه المعلومات الاسم، عنوان البريد الإلكتروني، رقم الهاتف، وعناوين العقارات المهتمة بشرائها أو تأجيرها.</li>
                    <li><strong>استخدام المعلومات:</strong> نحن نستخدم المعلومات التي نجمعها لتقديم خدماتنا كوسيط للعقارات، بما في ذلك عرض العقارات المتاحة للبيع أو الإيجار، والاتصال بالمستخدمين للتواصل بشأن استفساراتهم أو طلباتهم.</li>
                    <li><strong>مشاركة المعلومات:</strong> نحن لا نقوم ببيع أو تأجير معلومات المستخدمين لأطراف ثالثة دون موافقتهم، ولكن قد نشارك بعض المعلومات مع الشركاء التجاريين الذين يساعدوننا في تقديم الخدمات مثل مزودي الدفع عبر الإنترنت أو خدمات الاستضافة.</li>
                    <li><strong>حماية المعلومات:</strong> نحن نتخذ التدابير اللازمة لحماية المعلومات الشخصية للمستخدمين من الوصول غير المصرح به أو الاستخدام أو الإفصاح أو التعديل أو الحذف غير المصرح به.</li>
                    <li><strong>حقوق الوصول والتحكم:</strong> نحن نوفر للمستخدمين حق الوصول إلى معلوماتهم الشخصية والقدرة على تصحيحها أو حذفها عند الحاجة، وذلك عبر الاتصال بنا عن طريق معلومات الاتصال المتاحة على الموقع.</li>
                    <li><strong>تحديثات السياسة:</strong> قد نقوم بتحديث سياسة الخصوصية هذه من وقت لآخر لتعكس التغييرات في الممارسات الخاصة بنا أو لضمان الامتثال للتشريعات واللوائح الجديدة. يجب على المستخدمين مراجعة سياسة الخصوصية بشكل دوري لمعرفة أحدث المعلومات.</li>
                </ol>
                <p>
                    تأمين خصوصية المستخدمين هو أمر بالغ الأهمية بالنسبة لنا، ونحن نلتزم بالتعامل مع معلوماتهم الشخصية بأقصى درجات الحرفية والاحترافية.
                </p>
            </div>
        </div>
    </div>

    <!-- End widget -->

    <!-- Start footer -->
    <?php include $templates . 'footer.php' ?>
    <!-- End footer -->