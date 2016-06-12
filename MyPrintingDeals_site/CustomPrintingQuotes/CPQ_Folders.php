<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>MyPrintingDeals.com - Folder Printing</title>
<link rel="stylesheet" href="/CSS/2col_leftNav.css" type="text/css" />
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
</head>
<!-- The structure of this file is exactly the same as 2col_rightNav.html;
     the only difference between the two is the stylesheet they use -->
<body><div id="content">
  <form action="/gdform.php" method="post" name="CustomPrintQuote" id="CustomPrintQuote" onsubmit="MM_validateForm('007productDeliveryZip','','RisNum','_001custFirstName','','R','_002custLastName','','R','_003custEmail','','RisEmail','_004custAddress1','','R','_006custCity','','R','_007custState','','R','_008custZip','','RisNum');return document.MM_returnValue">
      <span class="HEADER2">Folders
        <input name="000Interested_in" type="hidden" id="Interested_in" value="Folder Quote." />
      </span><br />
      <br />
      <fieldset id="PrintOptions">
      <span class="HEADER3"><u><br />
        Print Options</u></span> <br />
  <input type="hidden" name="subject" value="Folder Printing Quote Form Submission" />
  <input type="hidden" name="redirect" value="/websites/MyPrintingDeals/Printing/PrintingSubmission_ThankyouPage.html" />
  <br />
  <table border="0" cellpadding="1" cellspacing="1" id="PrintOptionsTable">
    <tr>
      <td width="191" align="right" valign="bottom"><label for="ProductStock"> Product Stock:</label></td>
      <td width="237" align="left" valign="bottom"><select name="001productStock" id="001productStock">
        <option value="12pt. Matte #1 Premium Sheet" selected="selected">12pt. Matte #1 Premium Sheet</option>
        <option value="130lb. RECYCLED Velvet Cover">130lb. RECYCLED Velvet Cover</option>
        <option value="14pt. C1S">14pt. C1S</option>
        <option value="14pt. C2S">14pt. C2S</option>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="bottom"><label for="ProductSize">Product Size:</label></td>
      <td align="left" valign="bottom"><select name="002productSize" id="002productSize">
        <option value="9 x 12 Right Pocket Folder" selected="selected">9&quot; x 12&quot; Right Pocket Folder</option>
        <option value="9 x 12 Two Pocket Folder">9&quot; x 12&quot; Two Pocket Folder</option>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="bottom"><label for="select">Product Specs:</label></td>
      <td align="left" valign="bottom"><select name="003productSpecs" id="003productSpecs">
        <option value="4/1 - Full Color Front / Black Back" selected="selected">4/1 - Full Color Front / Black Back</option>
        <option value="4/4 - Full Color Front and Back">4/4 - Full Color Front and Back</option>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="bottom"><label for="ProductQuantity">Product Quantity:</label></td>
      <td align="left" valign="bottom"><select name="004productQuantity" id="004productQuantity">
        <option value="250" selected="selected">250</option>
        <option value="500">500</option>
        <option value="1000">1000</option>
        <option value="2000">2000</option>
        <option value="2500">2500</option>
        <option value="5000">5000</option>
        <option value="10000">10000</option>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="bottom"><label for="ProductQuantity">Turnaround Time:</label></td>
      <td align="left" valign="bottom"><select name="005turnaroundTime" id="005turnaroundTime">
        <option value="Standard 5-7 Days" selected="selected">Standard 5-7 Days</option>
        <option value="Express 3 Day">Express 3 Day</option>
        <option value="Wait and Save 7-10 Days">Wait and Save 7-10 Days</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="left" valign="bottom">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="left" valign="bottom" class="HEADER3"><u>Delivery Options</u> </td>
    </tr>
    <tr>
      <td colspan="2" align="left" valign="bottom"><label for="SandHmethod">Preffered Shipping and Handling Method:</label></td>
    </tr>
    <tr>
      <td align="left" valign="bottom">&nbsp;</td>
      <td align="left" valign="bottom"><select name="006productS_Hmethod" id="006productS_Hmethod">
        <option value="UPS Ground" selected="selected">UPS Ground</option>
        <option value="UPS 2nd Day Air">UPS 2nd Day Air</option>
        <option value="UPS Next Day Air">UPS Next Day Air</option>
        <option value="UPS 3 Day Select">UPS 3 Day Select</option>
        <option value="Mailing Service">Mailing Service</option>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="bottom"><label for="productZip">Delivery Zip Code:</label></td>
      <td align="left" valign="bottom"><input name="007productDeliveryZip" type="text" id="007productDeliveryZip" size="12" maxlength="12" /></td>
    </tr>
  </table>
  <br />
      </fieldset>
      <br />
      <fieldset id="CustomerContactInformation">
      <span class="HEADER3"><u>Customer Contact Information</u></span><br />
      <br />
      <table border="0" cellpadding="1" cellspacing="1" id="ContactInformationTable">
        <tr>
          <td width="183" align="right" valign="bottom"><label for="FirstName">First Name:</label></td>
          <td width="230" align="left" valign="bottom"><input type="text" name="_001custFirstName" id="_001custFirstName" /></td>
        </tr>
        <tr>
          <td align="right" valign="bottom"><label for="LastName">Last Name:</label></td>
          <td align="left" valign="bottom"><input type="text" name="_002custLastName" id="_002custLastName" /></td>
        </tr>
        <tr>
          <td align="right" valign="bottom"><label for="Email">Email:</label></td>
          <td align="left" valign="bottom"><input type="text" name="_003custEmail" id="_003custEmail" /></td>
        </tr>
        <tr>
          <td align="right" valign="bottom"><label for="Address1">Address 1:</label></td>
          <td align="left" valign="bottom"><input type="text" name="_004custAddress1" id="_004custAddress1" /></td>
        </tr>
        <tr>
          <td align="right" valign="bottom"><label for="Address2">Address 2:</label></td>
          <td align="left" valign="bottom"><input type="text" name="_005custAddress2" id="_005custAddress2" /></td>
        </tr>
        <tr>
          <td align="right" valign="bottom"><label for="City">City:</label></td>
          <td align="left" valign="bottom"><input type="text" name="_006custCity" id="_006custCity" /></td>
        </tr>
        <tr>
          <td align="right" valign="bottom"><label for="State">State:</label></td>
          <td align="left" valign="bottom"><input type="text" name="_007custState" id="_007custState" /></td>
        </tr>
        <tr>
          <td align="right" valign="bottom"><label for="Zip">Zip:</label></td>
          <td align="left" valign="bottom"><input type="text" name="_008custZip" id="_008custZip" /></td>
        </tr>
        <tr>
          <td align="right" valign="bottom"><label for="textfield">Phone:</label></td>
          <td align="left" valign="bottom"><input type="text" name="_009custPhone" id="_009custPhone" /></td>
        </tr>
      </table>
        <br />
      </fieldset>
      <br />
      <input name="Reset" type="reset" id="Reset" value="Reset" />
      <input name="CustomerInformation" type="submit" value="Get Quote" />
    </form>
    <br />
  <br />
  <br />
  </div>
</body>
</html>