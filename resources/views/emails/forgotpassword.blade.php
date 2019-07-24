<!DOCTYPE html>
<html>
  <head>
    <title>Forgot/New password Email</title>
  </head>
  <body>
    <table>
      <tr><td>Dear {{ $name }}!</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
        <td>Your account has been updated successfully.<br> Below are your account information with new password:</td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Email: {{$email}}</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>New Password: {{$password}}</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Thanks & Regards, <br> E-com website.</td></tr>
    </table>
  </body>
</html>
