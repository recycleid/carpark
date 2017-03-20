<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Carpark</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->

  <script type="text/javascript" src="<?=base_url('plugins/qrcode/qrcode.js');?>"></script>

<style>
body
{
      height: 842px;
      width: 660px;

}
</style>


  <script>
  function create_qrcode(text, typeNumber, errorCorrectionLevel, mode) {

    var qr = qrcode(typeNumber || 4, errorCorrectionLevel || 'M');
    qr.addData(text, mode);
    qr.make();

  //  return qr.createTableTag();
  //  return qr.createSvgTag();
    return qr.createImgTag();
  };

  function update_qrcode(str,obj) {
    var text = str.replace(/^[\s\u3000]+|[\s\u3000]+$/g, '');
    var t = '4';
    var e = 'H';
    var m = 'Byte';
    document.getElementById(obj).innerHTML = create_qrcode(text, t, e, m);
  };




  </script>


</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body>
  <?php
    for ($i=0; $i<count($data); $i++) {
  ?>
      <div style="width:325px; height:150px; border: 1px solid black; display: inline-block; float:left;">
        <center><label><h3>Carpark</h3></label></center>
        <table style="margin-left:10px; width:100%">
          <tr>
            <td><?=$data[$i]["memName"];?></td>
            <td rowspan="3" align="right" style="font-size:40px;"><?=$data[$i]["zone"].$data[$i]["number"];?></td>
            <td rowspan="3" align="right"><div id='card<?=$i;?>' name='card<?=$i;?>' style="margin-right:20px;"></div></td>

            <script>
              update_qrcode('<?=$data[$i]["carRegistration"];?>','card<?=$i;?>');
            </script>
          </tr>

          <tr>
            <td><?=$data[$i]["memtype"];?></td>
          </tr>

          <tr>
            <td><?=$data[$i]["carRegistration"];?></td>
          </tr>

        </table>
      </div>
  <?php
    }
  ?>


</body>


</html>
