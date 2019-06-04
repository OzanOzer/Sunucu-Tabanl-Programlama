<?php
header('Content-Type:application/json');
$baglanti=mysqli_connect("localhost","root","","kds");
$sorgu=mysqli_query($baglanti,"SELECT  gunler.gun_adi, round((sovlar.izleyici_sayisi/sovlar.musteri_sayisi),2) as izlenme_orani
FROM sovlar, oteller, gruplar,gunler
WHERE oteller.otel_id=sovlar.otel_id 
AND gunler.gun_id=sovlar.gun_id
AND gruplar.grup_id=sovlar.grup_id 
AND sovlar.tarih BETWEEN '2019-05-01' AND '2019-05-07'
AND gruplar.grup_id=1
ORDER BY sovlar.tarih);
$data=array();
foreach($sorgu as $row){
$data[]=$row;
}
mysqli_close($baglanti);
echo json_encode($data);
?>
