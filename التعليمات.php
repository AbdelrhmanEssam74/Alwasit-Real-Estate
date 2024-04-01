<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'الوسيط | التعليمات';
$instructions_page = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<!-- Start widget -->
<div class="modal-container overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
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