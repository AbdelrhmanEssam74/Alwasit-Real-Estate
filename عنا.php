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

    <!-- Start widget -->
    <div class="container info-content" dir="rtl" style="padding: 60px 0;">
        <div style="background-color: white;padding: 30px;border-radius: 10px;">
            <h1>من نحن</h1>
            <p>نحن موقع الوسيط لبيع وتأجير العقارات والشقق السكنية. نسعى لتوفير منصة موثوقة وموثوقة تجمع بين البائعين والمشترين أو المستأجرين في سوق العقارات. نحن ملتزمون بتقديم خدمة ممتازة لعملائنا، مع الحفاظ على سرية وأمان معلوماتهم الشخصية.</p>
            <p>فريقنا مكون من محترفين ذوي خبرة في صناعة العقارات وتكنولوجيا المعلومات. نعمل بجد لضمان أن تكون تجربة المستخدم ممتعة وسلسة، سواء كنت تبحث عن عقار للبيع أو للإيجار، أو كنت ترغب في عرض عقارك للبيع أو للتأجير.</p>
            <p>يمكنك الاعتماد علينا للحصول على الدعم والمساعدة في كل خطوة من خطوات عملية البيع أو الشراء أو التأجير. نحن هنا لمساعدتك في تحقيق أهدافك العقارية بسهولة وثقة.</p>
            <p>شكراً لاختيارك لموقعنا، ونحن نتطلع إلى خدمتك بأفضل ما لدينا.</p>

            <!-- إضافة الخريطة -->
            <iframe style="width: 100%; margin: 20px 0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3487.339444680816!2d31.101894024647773!3d29.066112775430785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145a25d1688e4685%3A0xeccc439d5b8f3785!2z2LPZhdiz2LfYpw!5e0!3m2!1sar!2seg!4v1710285030222!5m2!1sar!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!-- معلومات الاتصال -->
            <h2 style="margin-top: 30px;">معلومات الاتصال</h2>
            <p><strong>العنوان:</strong> شارع العقارات، مدينة العقارات، البلد</p>
            <p><strong>البريد الإلكتروني:</strong> info@alwaseet.com</p>
            <p><strong>رقم الهاتف:</strong> +1234567890</p>
        </div>
    </div>

    <!-- End widget -->
    <!-- start footer -->
    <?php include $templates . 'footer.php'; ?>
    <!-- End footer -->