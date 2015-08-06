<?php
session_start();
include("Sfa/EncryptionUtil.php");


$strMerchantId="00215325";
$astrFileName="http://16raagas.com/transaction/key/icici/00215325.key";
		 $astrClearData;
		 $ResponseCode = "";
		 $Message = "";
		 $TxnID = "";
		 $ePGTxnID = "";
	     $AuthIdCode = "";
		 $RRN = "";
		 $CVRespCode = "";
		 $Reserve1 = "";
		 $Reserve2 = "";
		 $Reserve3 = "";
		 $Reserve4 = "";
		 $Reserve5 = "";
		 $Reserve6 = "";
		 $Reserve7 = "";
		 $Reserve8 = "";
		 $Reserve9 = "";
		 $Reserve10 = "";


		 if($_POST){

			if($_POST['DATA']==null){
				print "null is the value";
			}
			 $astrResponseData=$_POST['DATA'];
			 $astrDigest = $_POST['EncryptedData'];
			 $oEncryptionUtilenc = 	new 	EncryptionUtil();
			 $astrsfaDigest  = $oEncryptionUtilenc->getHMAC($astrResponseData,$astrFileName,$strMerchantId);

			if (strcasecmp($astrDigest, $astrsfaDigest) == 0) {
			 parse_str($astrResponseData, $output);
			 if( array_key_exists('RespCode', $output) == 1) {
			 	$ResponseCode = $output['RespCode'];
			 }
			 if( array_key_exists('Message', $output) == 1) {
			 	$Message = $output['Message'];
			 }
			 if( array_key_exists('TxnID', $output) == 1) {
			 	$TxnID=$output['TxnID'];
			 }
			 if( array_key_exists('ePGTxnID', $output) == 1) {
			 	$ePGTxnID=$output['ePGTxnID'];
			 }
			 if( array_key_exists('AuthIdCode', $output) == 1) {
			 	$AuthIdCode=$output['AuthIdCode'];
			 }
			 if( array_key_exists('RRN', $output) == 1) {
			 	$RRN = $output['RRN'];
			 }
			 if( array_key_exists('CVRespCode', $output) == 1) {
			 	$CVRespCode=$output['CVRespCode'];
			 }
			}
		 }
	 	//print "<h6>Response Code:: $ResponseCode <br>";
	 	//print "<h6>Response Message:: $Message <br>";
	 	//print "<h6>Auth ID Code:: $AuthIdCode <br>";
	 	//print "<h6>RRN:: $RRN<br>";
	 	//print "<h6>Transaction id:: $TxnID<br>";//exit;
	 	//print "<h6>Epg Transaction ID:: $ePGTxnID<br>";
	 	//print "<h6>CV Response Code:: $CVRespCode<br>";
	     //  if($ResponseCode == 0)
	 	//{	?>
			 <script src="js/jquery.min.js"></script>
			 <script src="js/ajaxGetPost.js"></script>

			 <script>
			 	$(document).ready(function()
			 	{
			 		var ResponseCode = "<?php echo $ResponseCode;?>";
					var Message = "<?php echo $Message;?>";
					var TxnID = "<?php echo $TxnID;?>";
					var ePGTxnID = "<?php echo $ePGTxnID;?>";
					var AuthIdCode = "<?php echo $AuthIdCode;?>";
					var RRN = "<?php echo $RRN;?>";
					var CVRespCode = "<?php echo $CVRespCode;?>";
					var session_name="<?php echo ($_SESSION['session_raagas_name'])?>";
					var raagas_amount="<?php echo ($_SESSION['amount'])?>";
					var raagas_email="<?php echo ($_SESSION['session_email_16raagas'])?>";
					var url = "paymentsuccess";
					var encode = "ResponseCode="+ResponseCode+"&Message="+Message+"&TxnID="+TxnID+"&ePGTxnID="+ePGTxnID+"&AuthIdCode="+AuthIdCode+"&RRN="+RRN+"&CVRespCode"+CVRespCode+"&session_name"+session_name+"&raagas_amount="+raagas_amount+"&email="+raagas_email;
					var session_id_raagas="<?php echo ($_SESSION['session_id_raagas']);?>";
					
					var session_email_16raagas="<?php echo ($_SESSION['session_email_16raagas']);?>";
					post_ajax_data_header(url,encode,session_id_raagas, session_email_16raagas, function(data)
					{
					var error = (data.error);
					var message = (data.message);
					//alert (error);
					//alert (message);
					window.location = "../profile.php";
					});
});					
			 		</script>