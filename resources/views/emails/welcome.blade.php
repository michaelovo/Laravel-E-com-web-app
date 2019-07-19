<!DOCTYPE html>
<html>
  <head>
    <title>Welcome Email</title>
  </head>
  <body>
    <table>
      <tr><td>Dear {{ $name }}!</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Your account has been activated successfully.<br> Below are your account information:</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Email: {{$email}} <br> Password:**** (as chosen by you)</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Thanks & Regards, <br> E-com website.</td> </tr>
    </table>
  </body>
</html>
