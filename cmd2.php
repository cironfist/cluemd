<?php
function doMakeBonusTable($p)
{
	if(!isset($p->date))
		return ;

	$db = new jkDB('cluemd');

	$sql="SELECT online_sale,offline_sale,persons FROM sales WHERE date='$p->date';";
	$salear=$db->getQuery($sql);
	if(!$salear)
		return $p->setFailMsg("cannot find sales data at($p->date)");

	$sql="SELECT idx,salary,hour,rate FROM user WHERE current='fulltime' OR current='parttime';";
	$uar=$db->getQuery($sql);	

	$obnus=$salear['online_sale']/$salear['persons'];
	$bpercent = getBonusPercent($salear['offline_sale']);

	$sbonus = $tbonus = $tsalary = $salary = $hour = $rate = $idx = 0;
	foreach($uar as $user)
	{
		$idx = $user['idx'];
		$hour = $user['hour'];
		$rate = $user['rate'];
		if($user['current']=='parttime')
			$salary = $hour*$rate;
		else
			$salary = $user['salary'];

		$sbonus = $salary*$bpercent/100;
		$tbonus = $sbonus+$obonus;
		$tsalary = $tbonus+$salary;
		$sql="INSERT INTO bonus(idx,tbonus,sbonus,tsalary,obonus,bpercent,date,hour,salary,rate) 
		VALUES ('$idx','$tbonus','$sbonus','$tsalary','$obonus','$p->date','$houor','$rate','$salary');";

		$db->setQuery($sql);
	}
}

function setSalesInfo($p)
{
	if(!isset($p->date,$p->offline_sale,$p->online_sale))
		return ;

	$db = new jkDB('cluemd');

	$sql="INSERT INTO sales(date,offline_sale,online_sale) 
	VALUES ('$p->date','$p->offline_sale','$p->online_sale'";
	if(isset($p->persons)) 
		$sql.=",'$p->persons');";
	else
	{
		$sql2="SELECT count(idx) FROM user WHERE current='fulltime' OR current='parttime';";
		$r = $db->getQuery($sql2);
		if( $r )
		{
			log1($r);
			$counut = $r['count'];
			$sql.=",'$counut');";
		}
		else
			$sql.=");";		
	}

	if( $db->setQuery($sql) )
		$p->setSuccessMsg("$p->date : sales data set. person($count)");
	else
		$p->setFailMsg($db->getFailMsg());
}

function getBonusPercent($sales)
{
	$bpercent = 0;
	if( $sales >= 150000000 && $sales <160000000 )
		$bpercent = 5;
	else if($sales >= 160000000 && $sales <170000000)
		$bpercent = 10;
	else if($sales >= 170000000 && $sales <180000000)
		$bpercent = 15;
	else if($sales >= 180000000 && $sales <190000000)
		$bpercent = 20;
	else if($sales >= 190000000 && $sales <200000000)
		$bpercent = 25;
	else if($sales >= 200000000 && $sales <210000000)
		$bpercent = 30;
	else if($sales >= 210000000 && $sales <220000000)
		$bpercent = 35;
	else if($sales >= 220000000 && $sales <230000000)
		$bpercent = 40;
	else if($sales >= 230000000 && $sales <240000000)
		$bpercent = 45;
	else if($sales >= 240000000)
		$bpercent = 50;

	return $bpercent;
}
?>
