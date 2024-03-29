<?php
include 'init.php';
include $config . 'config.php';
include $config . 'emailsTable.php';
$email = new EmailsTable();

// Function to generate the HTML model
function generateModel($text)
{
  return "
        <!DOCTYPE html>
        <html lang='ar'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                /* Center the text box */
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    background-color: #f0f0f0; 
                }
            
                .confirmation-box {
                    padding: 20px;
                    border: 2px solid #333;
                    border-radius: 10px;
                    background-color: #fff;
                    text-align: center;
                    font-size: 18px;
                    font-family: Arial, sans-serif;
                    line-height : 1.5;
                }
            </style>
        </head>
        <body>
            <div class='confirmation-box'>
                $text
            </div>
        </body>
        </html>
    ";
}

if (isset($_GET['send']) && $_GET['send'] == true) {
  echo generateModel("تم إرسال ايميل الي بريدك الإلكتروني <br>
    برجاء فحص البريدك الإلكتروني <br>
    يمكنك غلق هذه الصفحة");
  exit();
}
if (isset($_GET['vc']) && $_GET['uID']) {
  $id = isset($_GET['uID']) ? $_GET['uID'] : "";
  $hashed_code = isset($_GET['vc']) ? $_GET['vc'] : "";
  $data = [
    "id" => $id,
  ];
  // Check if the email is active or not
  $emailData = $email->GetOneColumnById($id);
  $_SESSION['email'] = $emailData['email'];
  if ($emailData['active'] == 1) {
    echo generateModel("لقد قمت بعملية التأكيد من قبل");
    header("refresh:2;url=" . $login);
  } else {
    if (password_verify($emailData['code'], $hashed_code)) {
      // Prepare update statement
      $updateQuery = "UPDATE `email_verification` SET `active` = 1 WHERE user_id = :id";
      if ($email->update($updateQuery, $data)) {
        echo generateModel("تم تأكيد البريد الإلكتروني بنجاح.<br>سيتم توجيهك إلى صفحة تسجيل الدخول.");
        header("refresh:2;url=" . $login);
        exit();
      } else {
        echo generateModel("حدث خطأ ما، يرجى المحاولة مرة أخرى لاحقًا.");
      }
    } else {
      echo generateModel("حدث خطأ ما، يرجى المحاولة مرة أخرى لاحقًا.");
    }
  }
}
