<!doctype "html">
<html>
<head>
<title>Business Card Design Suite</title>

</head>
<body>
<h3 style="font-size: 13px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; color: #135cae; text-align:left;"><u>Step 1:</u></h3><form name="busCardInfo" ng-init="fName="'Jason'" ng-submit="saveBusCard()">
<table style="border:medium, #06C; width:1125px; height:675px;" ng-controller="busCard-controller"><tr><td width="80" height="35"><button ng-model="boldButton" id="boldButton">Bold</button></td><td width="110"><button ng-model="underlineButton" id="underlineButton">Underline</button></td><td width="913"><button ng-model="italicButton" id="italicButton">Italic</button></td></tr>
  <td height="35"><label>First Name:</label></td><td colspan="2"><input type="text" name="fName" ng-model="busCardInfo.fName" ng-required="true"></td>
  </tr>
  <td><label>Last Name:</label></td><td colspan="2"><input name="lName" type="text" ng-model="busCardInfo.lName" ng-required="true"></td>
  </tr></table></form>
<div style="padding:35px; border:#F00, dashed, 3px;vertical-align:middle; horizontal-align:middle; width:972px; height:522px; background:#CFC;">

<form action="" id="BusinessCardDesign" method="post">
<div style="width:200px; height:250px;">
<img src="/DesignSuite/{{pictureUpload}}.png" width="200" height="250">

</div>




</form>
</div>
<br /> <form id="CustomPrintQuote" action="/gdform.php" method="post"> <fieldset id="PrintOptions"> <span class="HEADER3"><span style="text-decoration: underline;"><span style="-webkit-text-decorations-in-effect: none;">
<h3 style="font-size: 13px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; color: #135cae;">Step 3:</h3>
Print Options <br /> <input name="subject" type="hidden" value="Business Card Printing Form Submission" /> <input name="redirect" type="hidden" value="/IE/Imaging/Pages/Printing/SubmissionGuideline_Pages/PrintingSubmission_ThankyouPage.html" /> <br /> 
<table id="PrintOptionsTable" border="0" cellspacing="1" cellpadding="1" width="420">
<tbody>
<tr>
<td width="185" align="right" valign="bottom"><label for="ProductStock"> Product Stock:</label></td>
<td width="228" align="left" valign="bottom"><select id="001productStock" name="001productStock"> <option selected="selected" value="14pt. Matte Recycled Premium Sheet">14pt. Matte Recycled Premium Sheet</option> <option value="14pt. Linen Uncoated">14pt. Linen Uncoated</option> <option value="14pt. Premium Uncoated">14pt. Premium Uncoated</option> <option value="14pt. C1S">14pt. C1S (Coated 1 Side)</option><option value="14pt. C2S">14pt. C2S (Coated Both Sides)</option><option value="16pt. C2S">16pt. C2S (Coated Both Sides)</option></select></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="ProductSize">Product Size:</label></td>
<td align="left" valign="bottom"><select id="002productSize" name="002productSize"> <option selected="selected" value="3.5 x 2">3.5" x 2"</option> <option value="3.5 x 4">3.5" x 4"</option> <option value="4 x 3.5">4" x 3.5"</option> </select></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="select">Product Specs:</label></td>
<td align="left" valign="bottom"><select id="003productSpecs" name="003productSpecs"> <option selected="selected" value="4/0 - Full Color Front / Blank Back">4/0 - Full Color Front / Blank Back</option> <option value="4/1 - Full Color Front / Black Back">4/1 - Full Color Front / Black Back</option> <option value="4/4 - Full Color Front and Back">4/4 - Full Color Front and Back</option> </select></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="ProductQuantity">Product Quantity:</label></td>
<td align="left" valign="bottom"><select id="004productQuantity" name="004productQuantity"> <option value="500">500</option> <option value="1000">1000</option> <option value="2000">2000</option> <option value="2500">2500</option> <option value="5000">5000</option> <option value="7500">7500</option> <option value="10000">10000</option> <option value="15000">15000</option> <option value="20000">20000</option> <option value="25000">25000</option> </select></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="ProductQuantity">Turnaround Time:</label></td>
<td align="left" valign="bottom"><select id="005turnaroundTime" name="005turnaroundTime"> <option selected="selected" value="Standard 3-5 Days">Standard 3-5 Days</option> <option value="Wait and Save 5-7 Days">Wait and Save 5-7 Days</option> <option value="Wait and Save 7-10 Days">Wait and Save 7-10 Days</option> </select></td>
</tr>
<tr>
<td colspan="2" align="left" valign="bottom"></td>
</tr>
<tr>
<td class="HEADER3" colspan="2" align="left" valign="bottom"><span style="text-decoration: underline;">Delivery Options</span></td>
</tr>
<tr>
<td colspan="2" align="left" valign="bottom"><label for="SandHmethod">Preffered Shipping and Handling Method:</label></td>
</tr>
<tr>
<td align="left" valign="bottom"></td>
<td align="left" valign="bottom"><select id="006productS_Hmethod" name="006productS_Hmethod"> <option selected="selected" value="UPS Ground">UPS Ground</option> <option value="UPS 2nd Day Air">UPS 2nd Day Air</option> <option value="UPS Next Day Air">UPS Next Day Air</option> <option value="UPS 3 Day Select">UPS 3 Day Select</option> </select></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="productZip">Delivery Zip Code:</label></td>
<td align="left" valign="bottom"><input id="007productDeliveryZip" maxlength="12" name="007productDeliveryZip" size="12" type="text" /></td>
</tr>
</tbody>
</table>
</span></span></span></fieldset> <br /> <fieldset id="CustomerContactInformation"> <span class="HEADER3"><span style="text-decoration: underline;">Customer Contact / Shipping Information</span></span><br /> <br /> 
<table id="ContactInformationTable" border="0" cellspacing="1" cellpadding="1" width="565">
<tbody>
<tr>
<td width="210" align="right" valign="bottom"><label for="ProjectName">Project Name Listed in Step 1:</label></td>
<td width="203" align="left" valign="bottom"><input name="_000ProjectName" type="text" id="_000ProjectName" size="50" /></td>
</tr>
<tr>
<td width="210" align="right" valign="bottom"><label for="FirstName">First Name:</label></td>
<td width="203" align="left" valign="bottom"><input name="_001custFirstName" type="text" id="_001custFirstName" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="LastName">Last Name:</label></td>
<td align="left" valign="bottom"><input name="_002custLastName" type="text" id="_002custLastName" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="Email">Email:</label></td>
<td align="left" valign="bottom"><input name="_003custEmail" type="text" id="_003custEmail" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="Address1">Address 1:</label></td>
<td align="left" valign="bottom"><input name="_004custAddress1" type="text" id="_004custAddress1" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="Address2">Address 2:</label></td>
<td align="left" valign="bottom"><input name="_005custAddress2" type="text" id="_005custAddress2" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="City">City:</label></td>
<td align="left" valign="bottom"><input name="_006custCity" type="text" id="_006custCity" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="State">State:</label></td>
<td align="left" valign="bottom"><input name="_007custState" type="text" id="_007custState" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="Zip">Zip:</label></td>
<td align="left" valign="bottom"><input name="_008custZip" type="text" id="_008custZip" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="textfield">Phone:</label></td>
<td align="left" valign="bottom"><input name="_009custPhone" type="text" id="_009custPhone" size="50" /></td>
</tr>
</tbody>
</table>
<br /> 
</fieldset> <br />
<fieldset id="CustomerContactInformation"> <span class="HEADER3"><span style="text-decoration: underline;">Customer Contact / Shipping Information</span></span><br /> <br /> 
<table id="ContactInformationTable" border="0" cellspacing="1" cellpadding="1" width="565">
<tbody>
<tr>
<td width="210" align="right" valign="bottom"><label for="ProjectName">Project Name Listed in Step 1:</label></td>
<td width="203" align="left" valign="bottom"><input name="_000ProjectName" type="text" id="_000ProjectName" size="50" /></td>
</tr>
<tr>
<td width="210" align="right" valign="bottom"><label for="FirstName">First Name:</label></td>
<td width="203" align="left" valign="bottom"><input name="_001custFirstName" type="text" id="_001custFirstName" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="LastName">Last Name:</label></td>
<td align="left" valign="bottom"><input name="_002custLastName" type="text" id="_002custLastName" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="Email">Email:</label></td>
<td align="left" valign="bottom"><input name="_003custEmail" type="text" id="_003custEmail" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="Address1">Address 1:</label></td>
<td align="left" valign="bottom"><input name="_004custAddress1" type="text" id="_004custAddress1" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="Address2">Address 2:</label></td>
<td align="left" valign="bottom"><input name="_005custAddress2" type="text" id="_005custAddress2" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="City">City:</label></td>
<td align="left" valign="bottom"><input name="_006custCity" type="text" id="_006custCity" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="State">State:</label></td>
<td align="left" valign="bottom"><input name="_007custState" type="text" id="_007custState" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="Zip">Zip:</label></td>
<td align="left" valign="bottom"><input name="_008custZip" type="text" id="_008custZip" size="50" /></td>
</tr>
<tr>
<td align="right" valign="bottom"><label for="textfield">Phone:</label></td>
<td align="left" valign="bottom"><input name="_009custPhone" type="text" id="_009custPhone" size="50" /></td>
</tr>
</tbody>
</table>
<br /> 
</fieldset> <input id="Reset" name="Reset" type="reset" value="Reset" /> <input name="CustomerInformation" type="submit" value="Submit Order" /> </form>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/i.4.9/angular.min.js"></script>
<script src="js/businessCard_designSuite.js"></script>
</body>
</html>