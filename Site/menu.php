    <?php
//we need to set a var to find what page we are on
$pageOn = basename($_SERVER['PHP_SELF']);
//this is used for the title bar
$mItem = $pageOn;
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>We are on the following page: <?=$mItem;?></title>
</head>

<body>
<?php
echo $pageOn;
?>
<div class="navigation">
<ul>
<li><a href="item.php"<?php if($pageOn == 'item.php'){?> id="selected"<?php }?>>Item Definition</a></li>
<li><a href="purchase.php"<?php if($pageOn == 'purchase.php'){?> id="selected"<?php }?>>Purchase Invoice</a></li>
<li><a href="sales.php"<?php if($pageOn == 'sales.php'){?> id="selected"<?php }?>>Sales Invoice</a></li>
<li><a href=".php"<?php if($pageOn == 'Listofquantity.php'){?> id="selected"<?php }?>>List of quantity</a></li>
</ul>
</div>
</html>
