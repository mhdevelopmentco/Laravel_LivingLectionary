<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Untitled Document</title>
</head>

<body>
<table border="0" cellspacing="0" cellpadding="0" width="600" align="center" style="border:2px solid #ff8400;">

    <tr bgcolor="#fff">
        <td style="height:20px;">&nbsp;</td>
    </tr>
    <tr bgcolor="#fff">
        <td align="center"><img src="<?php echo url(); ?>/themes/images/logo/sitelogo1.png" width="190" height="90"
                                alt="'.$site_name.'" style="margin:0 30px 20px 40px;"/></td>
    </tr>
    <tr>
        <td style="border:3px solid #fff;"></td>
    </tr>
    <tr>
        <td style="border:1px solid #ff8400;height:30px;"><b>Password Recovery Details For Merchant.</b></td>
    </tr>
    <tr>
        <td style=" margin:0 auto; font-size:16px;text-align:left; font-family:Arial, Helvetica, sans-serif; padding:10px 10px 10px;">
            <table cellspacing="10">
                <tr>
                    <th colspan="3"><h4 style="color:#F60;"> Your Login Credentials Are: </h4></th>
                </tr>
                <tr>
                    <th>User Name</th>
                    <th>:</th>
                    <td>{!! $name !!}</td>

                    <th>Email link</th>
                    <th>:</th>
                    <td><a href="<?php echo url('forgot_pwd_email/' . $encodeemail); ?>">Please click the link to reset
                            your password!</a></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <a href="<?php echo url('forgot_pwd_email/' . $encodeemail); ?>"></a>
    </tr>
    <tr bgcolor="#101010">
        <td style="height:50px;text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:14px;"><a
                    href="http://www.nexploc.com/" target="_blank"
                    style="text-decoration:none;color:#ff8400;font-weight:800;"> &copy; Nex eMerchant 2014</a></td>
    </tr>

</table>
</body>
</html>
