<?php
$wsdl =  new SoapClient('http://localhost:8080/JAX_WS/JAX_WS?WSDL');
$wsdl->aeTraDet(array("trans_det_id"=>"-1","trans_det_trans_id"=>"1","trans_det_prod_id"=>"2","trans_det_qty"=>"2"));