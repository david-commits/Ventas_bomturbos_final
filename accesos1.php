<?php
session_start();
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$nombres= $_POST['nombres'];  




/*$a1= intval($_POST['a1']);               
                  $a2 =intval( $_POST['a2']);                  
                  $a3 = intval($_POST['a3']);                  
                  $a4 = intval($_POST['a4']); 
                  $a5 = intval($_POST['a5']);    
                  $a6 = intval( $_POST['a6']); 
                  $a7 = intval($_POST['a7']); 
                  $a8 = intval($_POST['a8']); 
                  $a9 = intval( $_POST['a9']); 
                  $a10 =intval( $_POST['a10']); 
                  $a11 = intval($_POST['a11']); 
                  $a12 = intval($_POST['a12']); 
                  $a13 = intval($_POST['a13']); 
                  $a14 =intval( $_POST['a14']); 
                  $a15 =intval( $_POST['a15']); 
                  $a16 =intval( $_POST['a16']); 
                  $a17 =intval( $_POST['a17']); 
                  $a18 =intval($_POST['a18']); 
                  $a19 =intval( $_POST['a19']);
                  $a20 =intval($_POST['a20']);
                  $a21 =intval($_POST['a21']);
                  $a22 =intval($_POST['a22']);
                  $a23 =intval($_POST['a23']);
                  $a24 =intval($_POST['a24']);
                  $a25 =intval($_POST['a25']);
                  $a26 =intval($_POST['a26']);
                  $a27 =intval($_POST['a27']);
                  $a28 =intval($_POST['a28']);
                  $a29 =intval($_POST['a29']);
                  
                  $a30 =intval($_POST['a30']);
                  $a31 =intval($_POST['a31']);
                  $a32 =intval($_POST['a32']);
                  $a33 =intval($_POST['a33']);
                  $a34 =intval($_POST['a34']);
                  $a35 =intval($_POST['a35']);
                  
                  $a36 =intval($_POST['a36']);
                  $a37 =intval($_POST['a37']);
                  $a38 =intval($_POST['a38']);
                  $a39 =intval($_POST['a39']);
                  
                  $a40 =intval($_POST['a40']);
                  $a41 =intval($_POST['a41']);
                  $a42 =intval($_POST['a42']);
                  $a43 =intval($_POST['a43']);
                  $a44 =intval($_POST['a44']);
                  $a45 =intval($_POST['a45']);
                  $a46 =intval($_POST['a46']);
                  $a47 =intval($_POST['a47']);
                  $a48 =intval($_POST['a48']);
                  $a49 =intval($_POST['a49']);    */          
if (isset($_POST['a1'])&& $_POST['a1'] !=NULL) {
  $a1 = intval($_POST['a1']);
}else{
  $a1 = 0 ;
}
if (isset($_POST['a2'])&& $_POST['a2'] !=NULL) {
  $a2 = intval($_POST['a2']);
}else{
  $a2 = 0 ;
}
if (isset($_POST['a3'])&& $_POST['a3'] !=NULL) {
  $a3 = intval($_POST['a3']);
}else{
  $a3 = 0 ;
}

if (isset($_POST['a4'])&& $_POST['a4'] !=NULL) {
  $a4 = intval($_POST['a4']);
}else{
  $a4 = 0 ;
}

if (isset($_POST['a5'])&& $_POST['a5'] !=NULL) {
  $a5 = intval($_POST['a5']);
}else{
  $a5 = 0 ;
}
if (isset($_POST['a6'])&& $_POST['a6'] !=NULL) {
  $a6 = intval($_POST['a6']);
}else{
  $a6 = 0 ;
}
if (isset($_POST['a7'])&& $_POST['a7'] !=NULL) {
  $a7 = intval($_POST['a7']);
}else{
  $a7 = 0 ;
}
if (isset($_POST['a8'])&& $_POST['a8'] !=NULL) {
  $a8 = intval($_POST['a8']);
}else{
  $a8 = 0 ;
}
if (isset($_POST['a9'])&& $_POST['a9'] !=NULL) {
  $a9 = intval($_POST['a9']);
}else{
  $a9 = 0 ;
}
if (isset($_POST['a10'])&& $_POST['a10'] !=NULL) {
  $a10 = intval($_POST['a10']);
}else{
  $a10 = 0 ;
}
if (isset($_POST['a11'])&& $_POST['a11'] !=NULL) {
  $a11 = intval($_POST['a11']);
}else{
  $a11 = 0 ;
}
if (isset($_POST['a12'])&& $_POST['a12'] !=NULL) {
  $a12 = intval($_POST['a12']);
}else{
  $a12 = 0 ;
}
if (isset($_POST['a13'])&& $_POST['a13'] !=NULL) {
  $a13 = intval($_POST['a13']);
}else{
  $a13 = 0 ;
}
if (isset($_POST['a14'])&& $_POST['a14'] !=NULL) {
  $a14 = intval($_POST['a14']);
}else{
  $a14 = 0 ;
}
if (isset($_POST['a15'])&& $_POST['a15'] !=NULL) {
  $a15 = intval($_POST['a15']);
}else{
  $a15 = 0 ;
}
if (isset($_POST['a16'])&& $_POST['a16'] !=NULL) {
  $a16 = intval($_POST['a16']);
}else{
  $a16 = 0 ;
}
if (isset($_POST['a17'])&& $_POST['a17'] !=NULL) {
  $a17 = intval($_POST['a17']);
}else{
  $a17 = 0 ;
}
if (isset($_POST['a18'])&& $_POST['a18'] !=NULL) {
  $a18 = intval($_POST['a18']);
}else{
  $a18 = 0 ;
}
if (isset($_POST['a19'])&& $_POST['a19'] !=NULL) {
  $a19 = intval($_POST['a19']);
}else{
  $a19 = 0 ;
}
if (isset($_POST['a20'])&& $_POST['a20'] !=NULL) {
  $a20 = intval($_POST['a20']);
}else{
  $a20 = 0 ;
}
if (isset($_POST['a21'])&& $_POST['a21'] !=NULL) {
  $a21 = intval($_POST['a21']);
}else{
  $a21 = 0 ;
}
if (isset($_POST['a22'])&& $_POST['a22'] !=NULL) {
  $a22 = intval($_POST['a22']);
}else{
  $a22 = 0 ;
}
if (isset($_POST['a23'])&& $_POST['a23'] !=NULL) {
  $a23 = intval($_POST['a23']);
}else{
  $a23 = 0 ;
}
if (isset($_POST['a24'])&& $_POST['a24'] !=NULL) {
  $a24 = intval($_POST['a24']);
}else{
  $a24 = 0 ;
}
if (isset($_POST['a25'])&& $_POST['a25'] !=NULL) {
  $a25 = intval($_POST['a25']);
}else{
  $a25 = 0 ;
}
if (isset($_POST['a26'])&& $_POST['a26'] !=NULL) {
  $a26 = intval($_POST['a26']);
}else{
  $a26 = 0 ;
}
if (isset($_POST['a27'])&& $_POST['a27'] !=NULL) {
  $a27 = intval($_POST['a27']);
}else{
  $a27 = 0 ;
}
if (isset($_POST['a28'])&& $_POST['a28'] !=NULL) {
  $a28 = intval($_POST['a28']);
}else{
  $a28 = 0 ;
}
if (isset($_POST['a29'])&& $_POST['a29'] !=NULL) {
  $a29 = intval($_POST['a29']);
}else{
  $a29 = 0 ;
}
if (isset($_POST['a30'])&& $_POST['a30'] !=NULL) {
  $a30 = intval($_POST['a30']);
}else{
  $a30 = 0 ;
}
if (isset($_POST['a31'])&& $_POST['a31'] !=NULL) {
  $a31 = intval($_POST['a31']);
}else{
  $a31 = 0 ;
}
if (isset($_POST['a32'])&& $_POST['a32'] !=NULL) {
  $a32 = intval($_POST['a32']);
}else{
  $a32 = 0 ;
}
if (isset($_POST['a33'])&& $_POST['a33'] !=NULL) {
  $a33 = intval($_POST['a33']);
}else{
  $a33 = 0 ;
}
if (isset($_POST['a34'])&& $_POST['a34'] !=NULL) {
  $a34 = intval($_POST['a34']);
}else{
  $a34 = 0 ;
}
if (isset($_POST['a35'])&& $_POST['a35'] !=NULL) {
  $a35 = intval($_POST['a35']);
}else{
  $a35 = 0 ;
}
if (isset($_POST['a36'])&& $_POST['a36'] !=NULL) {
  $a36 = intval($_POST['a36']);
}else{
  $a36 = 0 ;
}
if (isset($_POST['a37'])&& $_POST['a37'] !=NULL) {
  $a37 = intval($_POST['a37']);
}else{
  $a37 = 0 ;
}
if (isset($_POST['a38'])&& $_POST['a38'] !=NULL) {
  $a38 = intval($_POST['a38']);
}else{
  $a38 = 0 ;
}
if (isset($_POST['a39'])&& $_POST['a39'] !=NULL) {
  $a39 = intval($_POST['a39']);
}else{
  $a39 = 0 ;
}
if (isset($_POST['a40'])&& $_POST['a40'] !=NULL) {
  $a40 = intval($_POST['a40']);
}else{
  $a40 = 0 ;
}
if (isset($_POST['a41'])&& $_POST['a341'] !=NULL) {
  $a41 = intval($_POST['a41']);
}else{
  $a41 = 0 ;
}
if (isset($_POST['a42'])&& $_POST['a42'] !=NULL) {
  $a42 = intval($_POST['a42']);
}else{
  $a42 = 0 ;
}
if (isset($_POST['a43'])&& $_POST['a43'] !=NULL) {
  $a43 = intval($_POST['a43']);
}else{
  $a43 = 0 ;
}
if (isset($_POST['a44'])&& $_POST['a44'] !=NULL) {
  $a44 = intval($_POST['a44']);
}else{
  $a44 = 0 ;
}
if (isset($_POST['a45'])&& $_POST['a45'] !=NULL) {
  $a45 = intval($_POST['a45']);
}else{
  $a45 = 0 ;
}
if (isset($_POST['a46'])&& $_POST['a46'] !=NULL) {
  $a46 = intval($_POST['a46']);
}else{
  $a46 = 0 ;
}
if (isset($_POST['a47'])&& $_POST['a47'] !=NULL) {
  $a47 = intval($_POST['a47']);
}else{
  $a47 = 0 ;
}
if (isset($_POST['a48'])&& $_POST['a48'] !=NULL) {
  $a48 = intval($_POST['a48']);
}else{
  $a48 = 0 ;
}
if (isset($_POST['a49'])&& $_POST['a49'] !=NULL) {
  $a49 = intval($_POST['a49']);
}else{
  $a49 = 0 ;
}




   /*$a1 = (isset($a1)&& $a1 !=NULL)?$a1:'0';
    $a2 = (isset($a2)&& $a2 !=NULL)?$a2:'0';
    $a3 = (isset($a3)&& $a3 !=NULL)?$a3:'0';
    $a4 = (isset($a4)&& $a4 !=NULL)?$a4:'0';
    $a5 = (isset($a5)&& $a5 !=NULL)?$a5:'0';
    $a6 = (isset($a6)&& $a6 !=NULL)?$a6:'0';
    $a7 = (isset($a7)&& $a7 !=NULL)?$a7:'0';
    $a8 = (isset($a8)&& $a8 !=NULL)?$a8:'0';
    $a9 = (isset($a9)&& $a9 !=NULL)?$a9:'0';
    $a10 = (isset($a10)&& $a10 !=NULL)?$a10:'0';
    $a11 = (isset($a11)&& $a11 !=NULL)?$a11:'0';
    $a12 = (isset($a12)&& $a12 !=NULL)?$a12:'0';
    $a13 = (isset($a13)&& $a13 !=NULL)?$a13:'0';
    $a14 = (isset($a14)&& $a14 !=NULL)?$a14:'0';
    $a15 = (isset($a15)&& $a15 !=NULL)?$a15:'0';
    $a16 = (isset($a16)&& $a16 !=NULL)?$a16:'0';
    $a17 = (isset($a17)&& $a17 !=NULL)?$a17:'0';
    $a18 = (isset($a18)&& $a18 !=NULL)?$a18:'0';
    $a19 = (isset($a19)&& $a19 !=NULL)?$a19:'0';
    $a20 = (isset($a20)&& $a20 !=NULL)?$a20:'0';
    $a21 = (isset($a21)&& $a21 !=NULL)?$a21:'0';
    $a22 = (isset($a22)&& $a22 !=NULL)?$a22:'0';
    $a23 = (isset($a23)&& $a23 !=NULL)?$a23:'0';
    $a24 = (isset($a24)&& $a24 !=NULL)?$a24:'0';
    $a25 = (isset($a25)&& $a25 !=NULL)?$a25:'0';
    $a26 = (isset($a26)&& $a26 !=NULL)?$a26:'0';
    $a27 = (isset($a27)&& $a27 !=NULL)?$a27:'0';
    $a28 = (isset($a28)&& $a28 !=NULL)?$a28:'0';
    $a29 = (isset($a29)&& $a29 !=NULL)?$a29:'0';
    $a30 = (isset($a30)&& $a30 !=NULL)?$a30:'0';
    $a31 = (isset($a31)&& $a31 !=NULL)?$a31:'0';
    $a32 = (isset($a32)&& $a32 !=NULL)?$a32:'0';
    $a33 = (isset($a33)&& $a33 !=NULL)?$a33:'0';
    $a34 = (isset($a34)&& $a34 !=NULL)?$a34:'0';
    $a35 = (isset($a35)&& $a35 !=NULL)?$a35:'0';
    $a36 = (isset($a36)&& $a36 !=NULL)?$a36:'0';
    $a37 = (isset($a37)&& $a37 !=NULL)?$a37:'0';
    $a38 = (isset($a38)&& $a38 !=NULL)?$a38:'0';
    $a39 = (isset($a39)&& $a39 !=NULL)?$a39:'0';
    $a40 = (isset($a40)&& $a40 !=NULL)?$a40:'0';
    $a41 = (isset($a41)&& $a41 !=NULL)?$a41:'0';
    $a42 = (isset($a42)&& $a42 !=NULL)?$a42:'0';
    $a43 = (isset($a43)&& $a43 !=NULL)?$a43:'0';
    $a44 = (isset($a44)&& $a44 !=NULL)?$a44:'0';
    $a45 = (isset($a45)&& $a45 !=NULL)?$a45:'0';
    $a46 = (isset($a46)&& $a46 !=NULL)?$a46:'0';
    $a47 = (isset($a47)&& $a47 !=NULL)?$a47:'0';
    $a48 = (isset($a48)&& $a48 !=NULL)?$a48:'0';
    $a49 = (isset($a49)&& $a49 !=NULL)?$a49:'0';*/
$c=$a1.".".$a2.".".$a3.".".$a4.".".$a5.".".$a6.".".$a7.".".$a8.".".$a9.".".$a10.".".$a11.".".$a12.".".$a13.".".$a14.".".$a15.".".$a16.".".$a17.".".$a18.".".$a19.".".$a20.".".$a21.".".$a22.".".$a23.".".$a24.".".$a25.".".$a26.".".$a27.".".$a28.".".$a29.".".$a30.".".$a31.".".$a32.".".$a33.".".$a34.".".$a35.".".$a36.".".$a37.".".$a38.".".$a39.".".$a40.".".$a41.".".$a42.".".$a43.".".$a44.".".$a45.".".$a46.".".$a47.".".$a48.".".$a49;      

$sql = "UPDATE users SET accesos='".$c."'
                            WHERE nombres='".$nombres."';";
                    $query_update = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_update) {
                        header("location:acceso.php?usuario=$nombres&mensaje=Actualizado Satisfactoriamente");
                    } else {
                        header("location:acceso.php?usuario=$nombres&mensaje=No Actualizado Satisfactoriamente");
                    } 

?>       

