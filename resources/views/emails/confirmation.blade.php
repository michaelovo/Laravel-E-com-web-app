<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <table>
      <tr><td>Dear {{ $name }}!</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Please click on below link to activate your account</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td><a href="{{url('confirm/'.$code)}}">Confirm account</a></td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Thanks & Regards, <br> E-com website.</td> </tr>
    </table>
  </body>
</html>
