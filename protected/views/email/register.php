<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta charset="utf-8" />
  </head>
<body style='background-color: white'>
<table width="800" style="margin:0 auto;padding:0px;color:#333333;font-family:Arial;font-size:12px;" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-top:17px;padding-left:17px;"><img src="http://31.13.130.50/images/logo.jpg" /></td>
  </tr>
  <tr height="3">
    <td style="height:3px;"><img src="http://31.13.130.50/images/line.jpg" /></td>
  </tr>
  <tr>
    <td style="padding-top:17px;padding-left:17px;padding-right:17px;padding-bottom:50px;"><?php echo Yii::app()->request->baseUrl; ?>
      <h1 style="font-family:Georgia;font-size:20px;font-weight: normal;">Здравствуйте!</h1>
      Вы зарегистрировались в системе, помогающей претенденту пройти аттестацию или переаттестацию государственных экспертов на 
      право проведения государственной экспертизы.
        <table width="600" style="margin-left:20px;margin-top:22px;margin-bottom:50px;">
          <tr>
            <td colspan="2" style="font-weight:bold;">
              Ваши данные для входа в систему:
            </td>
          </tr>
          <tr>
            <td style="width:91px;color:#6a6868;padding-top:7px;">Логин:</td>
            <td style="width:500px;padding-top:7px;"><a href="#" style="color:#2279bb;"><?php echo $login; ?></a></td>
          <tr>
          <tr>
            <td style="width:91px;color:#6a6868;padding-top:7px;">Пароль:</td>
            <td style="width:500px;padding-top:7px;"><?php echo $pass; ?></td>
          <tr>
        </table>
      Для продолжения регистрации на сайте <a href="http://www.minregion.ru/" style="color:#2279bb;">mingerion.ru</a>, пожалуйста, перейдите по <a href="<?php echo $activate_url; ?>" style="color:#2279bb;">ссылке</a>.
    </td>
  </tr>
  <tr>
    <td style="color:#333333;background-color:#f1f1f1;padding-top:17px;padding-left:17px;padding-right:17px;padding-bottom:17px;color:#636363;font-size:11px;">
      127994, Москва <br/>
      ул. Садовая-Самотечная, д. 10/23, стр. 1 <br/>
      телефон: (495) 980-25-47 <br/>
      e-mail: <a href="#" style="color:#2279bb;">info@minregion.ru</a>
    </td>
  </tr>
</table>
  </body>
  </html>

