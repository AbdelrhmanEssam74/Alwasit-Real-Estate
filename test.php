<?php include 'init.php'; ?>
<?php
include  $emails_libs . 'index.php';
$ip = "154.182.109.22"; // Get the IP address of the user
$api_url = "http://ip-api.com/json/{$ip}"; // API endpoint for ip-api.com
// Make a request to the API
$response = file_get_contents($api_url);
// Decode the JSON response
$data = json_decode($response);
// Retrieve the location information
$country = $data->country;
$region = $data->regionName;
$city = $data->city;
$devise = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'];
$Login_email_subject  = 'تنبيه تسجيل الدخول';
$current_date = date('Y-m-d h:i');
$Login_mailBody = "
<!DOCTYPE html>
<html dir='rtl'>
<head>
  <meta charset='UTF-8'>
  <title> Alwasit تنبيه تسجيل الدخول - نشاط على حسابك في </title>
  <style>
  p{
    color : #333;
    line-height : 1.8;
    padding:15px;
  }
  h3{
    color : #ff9a33;
  }
  </style>
</head>
<body>
  <div style='font-family: Arial, sans-serif; text-align: right; padding:15px'>
    <h1>عزيزي [اسم المستخدم]</h1>
    <p>نأمل أن تكون بخير. نود أن نبلغك بأنه تم اكتشاف تسجيل دخول على حسابك في Alwasit. نحن نولي أهمية قصوى لأمان حسابك ونرغب في التأكد من أنك على علم بأي نشاط يتعلق بحسابك.</p>
    <h4>تفاصيل التسجيل:</h4>
    <ul>
      <li>التاريخ والوقت: [$current_date]</li>
      <li>الجهاز : [$devise]</li>
      <li>الدولة : [$country]</li>
      <li>المحافظة: [$city]</li>
      <li>المنطقة: [$region ]</li>
    </ul>
    <p>إذا قمت مؤخرًا بتسجيل الدخول إلى حسابك، يمكنك تجاهل هذا البريد الإلكتروني. ومع ذلك، إذا لم تقم بتسجيل الدخول هذا أنت أو تشتبه في أي وصول غير مصرح به، فإننا نوصي باتخاذ الخطوات التالية لتأمين حسابك:</p>
    <ol>
      <li>تغيير كلمة المرور: قم بزيارة [اسم تطبيق الويب الخاص بك] وانتقل إلى إعدادات حسابك. حدد الخيار لتغيير كلمة المرور وقم بإنشاء كلمة مرور قوية وفريدة وغير قابلة للتخمين.</li>
    </ol>
    <p>نحن ملتزمون بالحفاظ على بيئة آمنة لجميع مستخدمينا، وسنواصل مراقبة حسابك لأي نشاط مشبوه. إذا ك
    نحن ملتزمون بالحفاظ على بيئة آمنة لجميع مستخدمينا، وسنواصل مراقبة حسابك لأي نشاط مشبوه. إذا كان لديك أي أسئلة أو مخاوف، فلا تتردد في الاتصال بفريق الدعم لدينا.</p>
    <p>شكرًا لاستخدامك لخدماتنا وثقتك فينا.</p>
    <p>مع أطيب التحيات،<br>
    فريق</p>
    <h3>Alwasit</h3>
  </div>
</body>
</html>
        ";

$send_login_obj = new EmailSender('abdelrhmanroshdy8@gmail.com', $email_subject, $mailBody);
$send_login_obj->sendEmail();
