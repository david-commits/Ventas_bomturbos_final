<?php
    // conexion
  session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }
    
    
    include("../../config/db.php");
	include("../../config/conexion.php");
	$id_factura= intval($_GET['id_factura']);
        
	$sql_count=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Factura no encontrada')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
    $tienda1=$_SESSION['tienda'];
    $sql_factura=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
	
        
        
        
    date_default_timezone_set('America/Lima');

$moneda="PEN";
$folio=$rw_factura['folio'];
$numero_documento=$rw_factura['numero_factura'];
$fecha_emision=date("Y-m-d", strtotime($rw_factura['fecha_factura']));
//tipo de documento 01 factura   02 boleta
$estado=$rw_factura['estado_factura'];

if($estado==1)
{
$tipo_documento="01";    
}    
 if($estado==2)
{
$tipo_documento="02";    
} 

$sql_factura2=mysqli_query($con,"select * from sucursal where tienda='".$tienda1."'");
        $rw_factura2=mysqli_fetch_array($sql_factura2);
       
        
       
        //$correo=$rw_factura2['correo'];
        


    //datos del emisor
        $ruc_emisor=$rw_factura2['ruc'];;
//tipo doc emisor   6 ruc
        $tipo_doc_emisor="6";
        $razon_social_emisor=$rw_factura2['nombre'];
        $nombre_comercial_emisor=$rw_factura2['nombre'];
        $direccion_emisor=$rw_factura2['direccion'];;
        $pais="PER";
        $representante_legal="Chamorro Ysca";

        $motivo_baja="Error en el sistema";   
        $i=1;
        $ruta = 'baja/';
      // 1.- crear documento XML
        $xml = new DomDocument('1.0', 'ISO-8859-1'); $xml->standalone = false; $xml->preserveWhiteSpace = false;
        $Invoice = $xml->createElement('VoidedDocuments'); $Invoice = $xml->appendChild($Invoice);
        $Invoice->setAttribute('xmlns',"urn:sunat:names:specification:ubl:peru:schema:xsd:VoidedDocuments-1");
        $Invoice->setAttribute('xmlns:cac',"urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2");
        $Invoice->setAttribute('xmlns:cbc',"urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2");
        $Invoice->setAttribute('xmlns:ds',"http://www.w3.org/2000/09/xmldsig#");
        $Invoice->setAttribute('xmlns:ext',"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2");
        $Invoice->setAttribute('xmlns:sac',"urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1");
        $Invoice->setAttribute('xmlns:xsi',"http://www.w3.org/2001/XMLSchema-instance");
        $UBLExtension = $xml->createElement('ext:UBLExtensions'); $UBLExtension = $Invoice->appendChild($UBLExtension);
        $ext = $xml->createElement('ext:UBLExtension'); $ext = $UBLExtension->appendChild($ext);
        $contents = $xml->createElement('ext:ExtensionContent'); $contents = $ext->appendChild($contents);


        $cbc = $xml->createElement('cbc:UBLVersionID', '2.0'); $cbc = $Invoice->appendChild($cbc);
        $cbc = $xml->createElement('cbc:CustomizationID', '1.0'); $cbc = $Invoice->appendChild($cbc);
        $cbc = $xml->createElement('cbc:ID', 'RA-'.date('Ymd').'-'.$i); $cbc = $Invoice->appendChild($cbc);
        $cbc = $xml->createElement('cbc:ReferenceDate', "$fecha_emision"); $cbc = $Invoice->appendChild($cbc);
        $cbc = $xml->createElement('cbc:IssueDate', date('Y-m-d')); $cbc = $Invoice->appendChild($cbc);

        // Datos del emisor de la factura (surmotriz)
        $cac_accounting = $xml->createElement('cac:AccountingSupplierParty'); $cac_accounting = $Invoice->appendChild($cac_accounting);
        $cbc = $xml->createElement('cbc:CustomerAssignedAccountID', "$ruc_emisor"); $cbc = $cac_accounting->appendChild($cbc);
        $cbc = $xml->createElement('cbc:AdditionalAccountID', $tipo_doc_emisor); $cbc = $cac_accounting->appendChild($cbc);
        $cac_party = $xml->createElement('cac:Party'); $cac_party = $cac_accounting->appendChild($cac_party);
        $cac = $xml->createElement('cac:PartyName'); $cac = $cac_party->appendChild($cac);
        $cbc = $xml->createElement('cbc:Name', "$razon_social_emisor"); $cbc = $cac->appendChild($cbc);
        $legal = $xml->createElement('cac:PartyLegalEntity'); $legal = $cac_party->appendChild($legal);
        $cbc = $xml->createElement('cbc:RegistrationName', "$nombre_comercial_emisor"); $cbc = $legal->appendChild($cbc);


        $VoidedDocumentsLine = $xml->createElement('sac:VoidedDocumentsLine'); $VoidedDocumentsLine = $Invoice->appendChild($VoidedDocumentsLine);
        $cbc = $xml->createElement('cbc:LineID','1'); $cbc = $VoidedDocumentsLine->appendChild($cbc);
        $cbc = $xml->createElement('cbc:DocumentTypeCode',$tipo_documento); $cbc = $VoidedDocumentsLine->appendChild($cbc);
        $sac = $xml->createElement('sac:DocumentSerialID',"$folio"); $sac = $VoidedDocumentsLine->appendChild($sac);
        $sac = $xml->createElement('sac:DocumentNumberID',"$numero_documento"); $sac = $VoidedDocumentsLine->appendChild($sac);
        $sac = $xml->createElement('sac:VoidReasonDescription',"$motivo_baja"); $sac = $VoidedDocumentsLine->appendChild($sac);

        
        $xml->formatOutput = true;
        $strings_xml = $xml->saveXML();
        $xml->save($ruta.''.$ruc_emisor.'-RA-'.date('Ymd').'-'.($i).'.xml');
        

    


    // 2.- Firmar documento xml
    // ========================

    require './robrichards/src/xmlseclibs.php';
    use RobRichards\XMLSecLibs\XMLSecurityDSig;
    use RobRichards\XMLSecLibs\XMLSecurityKey;

    // Cargar el XML a firmar
    $doc = new DOMDocument();
    $doc->load($ruta.''.$ruc_emisor.'-RA-'.date('Ymd').'-'.($i).'.xml');

    // Crear un nuevo objeto de seguridad
    $objDSig = new XMLSecurityDSig();

    // Utilizar la canonización exclusiva de c14n
    $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);

    // Firmar con SHA-256
    $objDSig->addReference(
        $doc,
        XMLSecurityDSig::SHA1,
        array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'),
        array('force_uri' => true)
    );

    //Crear una nueva clave de seguridad (privada)
    $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'private'));

    //Cargamos la clave privada
    $objKey->loadKey('./archivos_pem/private_key.pem', true);
    $objDSig->sign($objKey);

    // Agregue la clave pública asociada a la firma
    $objDSig->add509Cert(file_get_contents('./archivos_pem/public_key.pem'), true, false, array('subjectName' => true)); // array('issuerSerial' => true, 'subjectName' => true));

    // Anexar la firma al XML
    $objDSig->appendSignature($doc->getElementsByTagName('ExtensionContent')->item(0));


    $doc->save($ruta.''.$ruc_emisor.'-RA-'.date('Ymd').'-'.($i).'.xml');
    chmod($ruta.''.$ruc_emisor.'-RA-'.date('Ymd').'-'.($i).'.xml', 0777);



// 3.- Enviar documento xml y obtener respuesta
// ============================================

require('./lib/pclzip.lib.php'); // Librería que comprime archivos en .ZIP

## Creación del archivo .ZIP
$arc=$ruc_emisor.'-RA-'.date('Ymd').'-'.($i);

$zip = new PclZip($ruta.''.$ruc_emisor.'-RA-'.date('Ymd').'-'.($i).'.zip');
$zip->create($ruta.''.$ruc_emisor.'-RA-'.date('Ymd').'-'.($i).'.xml',PCLZIP_OPT_REMOVE_ALL_PATH);
chmod($ruta.''.$ruc_emisor.'-RA-'.date('Ymd').'-'.($i).'.zip', 0777);


    
# Procedimiento para enviar comprobante a la SUNAT
class feedSoap extends SoapClient{

    public $XMLStr = "";

    public function setXMLStr($value)
    {
        $this->XMLStr = $value;
    }

    public function getXMLStr()
    {
        return $this->XMLStr;
    }

    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        $request = $this->XMLStr;

        $dom = new DOMDocument('1.0');

        try
        {
            $dom->loadXML($request);
        } catch (DOMException $e) {
            die($e->code);
        }

        $request = $dom->saveXML();

        //Solicitud
        return parent::__doRequest($request, $location, $action, $version, $one_way = 0);
    }

    public function SoapClientCall($SOAPXML)
    {
        return $this->setXMLStr($SOAPXML);
    }
}


function soapCall($wsdlURL, $callFunction = "", $XMLString)
{
    $client = new feedSoap($wsdlURL, array('trace' => true));
    $reply  = $client->SoapClientCall($XMLString);

    //echo "REQUEST:\n" . $client->__getFunctions() . "\n";
    $client->__call("$callFunction", array(), array());
    //$request = prettyXml($client->__getLastRequest());
    //echo highlight_string($request, true) . "<br/>\n";
    return $client->__getLastResponse();
}

// URL para enviar las solicitudes a SUNAT
$wsdlURL = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService?wsdl';
//$wsdlURL = 'billService.wsdl';
// 20532710066SURMOTR1  TOYOTA2051

//Estructura del XML para la conexión
$XMLString = '<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope 
 xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
 xmlns:ser="http://service.sunat.gob.pe" 
 xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
 <soapenv:Header>
     <wsse:Security>
          <wsse:UsernameToken Id="ABC-123">
             <wsse:Username>'.$ruc_emisor.'MODDATOS</wsse:Username>
             <wsse:Password>MODDATOS</wsse:Password>
         </wsse:UsernameToken>
     </wsse:Security>
 </soapenv:Header>
 <soapenv:Body>
     <ser:sendSummary>
        <fileName>'.''.$ruc_emisor.'-RA-'.date('Ymd').'-'.($i).'.zip</fileName>
        <contentFile>' . base64_encode(file_get_contents($ruta.''.$ruc_emisor.'-RA-'.date('Ymd').'-'.($i).'.zip')) . '</contentFile>
     </ser:sendSummary>
 </soapenv:Body>
</soapenv:Envelope>
';

//Realizamos la llamada a nuestra función
$result = soapCall($wsdlURL, $callFunction = "sendSummary", $XMLString);


// Actualiza la cdg_cab_doc sun_env=S
$sql_factura1=mysqli_query($con,"update facturas set baja='$arc' where id_factura='".$id_factura."'");

echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16pt; color: #000000; margin-bottom: 10px;">';
echo 'SUNAT. Facturacion electronica Perú.<br>';
echo '<span style="color: #6A0888; font-size: 15pt;">';
echo 'Documento de Baja.';
echo '</span>';
echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #000099; margin-top: 10px;">';
echo 'La factura '.$folio.'-'.$numero_documento.' ha sido dado de baja. Cerrar esta ventana.';
echo '</div>';

?>
