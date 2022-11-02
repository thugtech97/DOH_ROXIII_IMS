<div id="report_dl" style="display: none;">
  <div class="dl-header" style="text-align: center">
    <center>
	    <table width="100%;">
	    	<tbody>
	    		<tr>
	    			<td style="width: 15%;"></td>
	    			<td style="width: 70%;"></td>
	    			<td style="width: 15%;"></td>
	    		</tr>
	    		<tr>
	    			<td rowspan="5" style="vertical-align: center; text-align: right;"><img src="../archives/img/<?php echo $_SESSION["company_logo"]; ?>" height="85" width="85"></td>
	    		</tr>
	    		<tr>
	    			<td style="text-align: center;">Republic of the Philippines</td>
	    			<td></td>
	    		</tr>
	    		<tr>
	    			<td style="text-align: center;">Department of Health</td>
	    			<td></td>
	    		</tr>
	    		<tr>
	    			<td style="text-align: center; font-weight: bold;">CENTER FOR HEALTH DEVELOPMENT - CARAGA</td>
	    			<td></td>
	    		</tr>
	    		<tr>
	    			<td style="text-align: center;">Butuan City</td>
	    			<td></td>
	    		</tr>
	    	</tbody>
	    </table>
	    <hr>
	   </center>
  </div>

  <div class="dl-footer" style="font-size: 11px;">
    <hr>Pizarro St., corner Narra Road, J.P. Rizal, 8600 Butuan City | Trunk Line: (085) 3425208 | Direct Line: (085) 3412579<br>Fax: (085) 2252970    |URL: <a href="http://caraga.doh.gov.ph">http://caraga.doh.gov.ph</a> | Email: <a href="#">dohro13caraga@gmail.com</a><br>
    <span style="float: right;">MMU-Form 2 Rev.0</span>

  </div>

  <table>
    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="dl-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <div class="page dl_content">
            <center><h3>DEMAND LETTER</h3></center>
            <p class="dl_date"></p>
            <p style="font-weight: bold;">The Manager<br><span class="dl_supp_name"></span><br><span class="dl_address" style="cursor: pointer;" onclick="edit_text(this.className);"></span><br><span>Butuan City</span>
            <p>Dear Ma'am/Sir:</p><p>Greetings!</p><p style="text-align: justify;">This is in reference to the DOH- Center for Health Caraga approved Purchase Order that <span class="linking_verb">are</span> beyond the delivery term.</p>
            <table style="border-collapse: collapse;" cellspacing="0" width="100%;">
            	<thead>
            		<tr>
            			<td style="border-style: solid; border-width: 1px; text-align: center; font-weight: bold;">Purchase Order No.</td>
            			<td style="border-style: solid; border-width: 1px; text-align: center; font-weight: bold;">Unit</td>
            			<td style="border-style: solid; border-width: 1px; text-align: center; font-weight: bold;">Item Description</td>
            			<td style="border-style: solid; border-width: 1px; text-align: center; font-weight: bold;">QTY</td>
            			<td style="border-style: solid; border-width: 1px; text-align: center; font-weight: bold;">Unit Cost</td>
            			<td style="border-style: solid; border-width: 1px; text-align: center; font-weight: bold;">Amount</td>
            		</tr>
            	</thead>
            	<tbody class="dl_tbody">
            		
            	</tbody>
            </table>
            <p style="text-align: justify;">Please be informed that as per inspection of our Supply Officer, we found out that the P.O <span class="linking_verb">are</span> already expired and despite our several verbal demands, your firm has not done any remedial measures to deliver the above-mentioned item(s).</p>
            <p style="text-align: justify;">Hence, this <span style="font-weight: bold;">final and formal demand</span> is made upon you to proceed with the delivery of the said P.O. expeditiously and without any further delay. Otherwise, we have no other recourse but to terminate the purchase order on such ground(s) which may be available on our favor. Such other administrative and civil remedies shall likewise be made against you.</p>
            <p style="text-align: justify;">Attached herewith <span class="linking_verb">are</span> <span class="copy_verb">the copies</span> of above- mentioned purchase order for your reference.</p>
            <p style="text-align: justify;">I am hoping for your prompt action.</p>
            <br><p style="text-align: justify;">Very truly yours,</p>
            <br><p style="text-align: justify;"><span style="font-weight: bold;"><?php echo strtoupper($_SESSION["company_head"]); ?></span><br><span><?php echo $_SESSION["company_head_designation"]; ?></span></p>
          </div>
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="dl-footer-space"></div>
        </td>
      </tr>
    </tfoot>
  </table>
</div>