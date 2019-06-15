<style>
table.blueTable {
    border: 1px solid #1C6EA4;
        background-color: #EEEEEE;
        width: 100%;
        max-width:1200px;
        text-align: left;
        border-collapse: collapse;
    }
    table.blueTable td, table.blueTable th {
    border: 1px solid #AAAAAA;
        padding: 5px 5px;
    }
    table.blueTable tbody td {
    font-size: 13px;
    }
    table.blueTable tr:nth-child(even) {
background: #D0E4F5;
    }
    table.blueTable thead {
    background: #1C6EA4;
    background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        border-bottom: 2px solid #444444;
        margin:10px;
    }
    table.blueTable thead th {
    font-size: 15px;
        font-weight: bold;
        color: #FFFFFF;
        border-left: 2px solid #D0E4F5;
        margin:5px;
    }
    table.blueTable thead th:first-child {
    border-left: none;
    }

    table.blueTable tfoot {
    font-size: 14px;
        font-weight: bold;
        color: #FFFFFF;
        background: #D0E4F5;
        background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        border-top: 2px solid #444444;
    }
    table.blueTable tfoot td {
    font-size: 14px;
    }
    table.blueTable tfoot .links {
    text-align: right;
    }
    table.blueTable tfoot .links a{
    display: inline-block;
    background: #1C6EA4;
    color: #FFFFFF;
    padding: 2px 8px;
        border-radius: 5px;
    }
</style>
<?php
$consensushalvinginterval=intval(525600/2.5); // consensus halving
$z=0;
$substart=3200;
$generationspeed=2.5;
$totalsupply=3200000000; // 1 Milliard  600 Millions
$halvingvalue=1.618033988750; // golden ratio
$nsyear=3200000000;
$nsday=0;
echo "<small>Note: *average and rounded</small><br>";
    $height=0/$generationspeed;
    $nSubsidy = $substart;
    $years= ($height / $consensushalvinginterval)+1;
    $halving=($years)/$halvingvalue;
    $nSubsidy=$nSubsidy/($halving);
/*//echo "<small>Mining stops rewarding coins when the value for 1 block < 1 KYF, miners are then rewarded with a commission on the transactions only.<br></small>";
echo "<small>Subsidy starts at ".intval($nSubsidy)." KYF / block (Bitcoin at 50)<br></small>";
echo "<small>New block target is 1 block every $generationspeed minute (Bitcoin is 1 block every 10 minutes).<br></small>";
echo "<small>After block 52000, Block subsidy is recalculated every block (Bitcoin every 210,000 blocks).<br></small>";
echo "<small>Difficulty retarget is every 10 blocks or 25 minutes.(Bitcoin is 2016 block or 20160 minutes).<br></small>";
echo "<small>Mining reward is divided by year/$halvingvalue every block (Bitcoin is divided by 2 every 210,000 blocks) after block 52000.<br></small>";
echo "<hr><br>";
*/

echo "<h1>1000 Years</h1>";
echo "<table class=\"blueTable\"><tr><th>Block</th><th>Year</th><th>Halving*</th><th>Subsidy/Block*</th><th>Subsidy/day*</th><th>Subsidy/Year*</th><th>Total Supply KYF*</th><th>Total Millions KYF*</th></tr>";

for ($i=0;$i<500000000;$i++) {

    $height=$i;
    $nSubsidy = $substart;

    $years= ($height / $consensushalvinginterval )+1;
    if ($height<=52000) $years=1; // private maning advantage 5177 KYF per Block
    $halving=$years/$halvingvalue;
    $nSubsidy=$nSubsidy/$halving;
    if ($nSubsidy<1.0) break;
    $totalsupply+=$nSubsidy;
    $nsyear+=$nSubsidy;
    $nsday+=$nSubsidy;


    //if ($height % 17520==0 || intval($height)==0) {
    if (intval($height%(2102400))==0) {
        echo "<tr><td>".$i."</td><td>".intval($years-1)."</td><td>".nformat($halving)."</td><td>".nformat($nSubsidy)."</td><td>".nformat($nSubsidy*576)."</td><td>".nformat($nsyear)."</td><td>".nformat($totalsupply)."</td><td>".nformat($totalsupply/1000000)."</td></tr>";
        if ($z>10000) break;
        $z++;

    }
    if ($height%210240==0)
    {$nsyear=0;}
    if ($height % 576==0)
    {$nsday=0;}
    if ($years>=1000) break;

}
echo "</table>";

/**
 * @param $i
 *
 * @return string
 */function nformat($i){
    return number_format(intval($i), 0, ',', ' ');
}
?>
