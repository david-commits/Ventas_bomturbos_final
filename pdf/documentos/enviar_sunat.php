<?php

//------------------FIRMA DE XML--------------------------
require_once('api_signature/XMLSecurityKey.php');
require_once('api_signature/XMLSecurityDSig.php');
require_once('api_signature/XMLSecEnc.php');
//funcion para firmar
class Signature {
    public function signature_xml($flg_firma, $ruta, $ruta_firma, $pass_firma,$ruta1) {
        //flg_firma:
        //          01, 03, 07, 08: Firmar en el nodo uno.
        //          00: Firmar en el Nodo Cero (para comprobantes de Percepción o Retención)
        
        $doc = new DOMDocument();

        $doc->formatOutput = FALSE;
        $doc->preserveWhiteSpace = TRUE;
        $doc->load($ruta . '.xml');

        $objDSig = new XMLSecurityDSig(FALSE);
        $objDSig->setCanonicalMethod(XMLSecurityDSig::C14N);
        $options['force_uri'] = TRUE;
        $options['id_name'] = 'ID';
        $options['overwrite'] = FALSE;

        $objDSig->addReference($doc, XMLSecurityDSig::SHA1, array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'), $options);
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'private'));

        $pfx = file_get_contents($ruta_firma);
        $key = array();

        openssl_pkcs12_read($pfx, $key, $pass_firma);
        $objKey->loadKey($key["pkey"]);
        $objDSig->add509Cert($key["cert"], TRUE, FALSE);
        $objDSig->sign($objKey, $doc->documentElement->getElementsByTagName("ExtensionContent")->item($flg_firma));

        $atributo = $doc->getElementsByTagName('Signature')->item(0);
        $atributo->setAttribute('Id', 'SignatureSP');
        
        //===================rescatamos Codigo(HASH_CPE)==================
        $hash_cpe = $doc->getElementsByTagName('DigestValue')->item(0)->nodeValue;
       
        //$doc->save($ruta . '.XML');
        $doc->save($ruta1 . '.xml');
        chmod(''.$ruta1.'.xml', 0777);
        $doc->save('factura-firmada/'.$ruta1.'.xml');
        chmod('factura-firmada/'.$ruta1.'.xml', 0777);
        $resp['respuesta'] = 'ok';
        $resp['hash_cpe'] = $hash_cpe;
        return $resp;
    }
}
//firmar
$doc3=$_GET['fac'];
$rutas = array();
$rutas['ruta_xml'] = "factura-sin-firmar/$doc3";
//archivo donde esta alojado el certificado digital para beta:

$rutas['ruta_firma'] = "certificados/beta/LLAMA-PE-CERTIFICADO-DEMO-10704418341.pfx";
$rutas['pass_firma'] = 'D4n13l1t0';
$rutas['ruta_xml1'] = "$doc3";
$signature = new Signature();
$flg_firma = "0";
$resp_firma = $signature->signature_xml($flg_firma, $rutas['ruta_xml'], $rutas['ruta_firma'], $rutas['pass_firma'], $rutas['ruta_xml1']);
if($resp_firma['respuesta'] == 'error') {
    return $resp_firma;
}

require('lib/pclzip.lib.php'); 


//------------------ENVIAR XML SUNAT-------------------
echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16pt; color: #000000; margin-bottom: 10px;">';
echo 'SUNAT. Facturacion electronica Peru.<br>';
echo '<span style="color: #6A0888; font-size: 15pt;">';
echo 'Firma y envio de factura electronica al servidor de SUNAT';
echo 'y obtencion de la Constancia de Recepción (CDR).';
echo '</span>';
echo '<hr width="100%"></div>';

echo '<span style="color: #015B01; font-size: 15pt;">Factura firmada:</span>&nbsp;';
echo '<span style="color: #B21919; font-size: 15pt;">'.$doc3.'.xml</span><br>';
// NOMBRE DE ARCHIVO A PROCESAR.
$NomArch=$doc3;


## =============================================================================
## Creación del archivo .ZIP
echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #000099; margin-bottom: 10px;">';
echo 'Archivo .XML (factura electrónica) a comprimir.<br>';
echo '<span style="color: #000000;">'.$NomArch.'.xml</span>';
echo '</div>';

echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #000099; margin-bottom: 10px;">';
echo 'Archivo .ZIP (conteniendo el doc. electronico) a enviar al servidor de SUNAT.<br>';
echo '<span style="color: #000000;">'.$NomArch.'.zip</span>';
echo '</div>';

$zip = new PclZip($NomArch.".zip");
$zip->create($NomArch.".xml");
chmod($NomArch.".zip", 0777);

$zip = new PclZip('factura-firmada/'.$NomArch.".zip");
$zip->create('factura-firmada/'.$NomArch.".xml");
chmod('factura-firmada/'.$NomArch.".zip", 0777);


# ==============================================================================
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
    $client->__call("$callFunction", array(), array());
    return $client->__getLastResponse();
}

//URL para enviar las solicitudes a SUNAT
//DIRECCION DE PRUEBA
$wsdlURL = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService?wsdl';
//DIRECCION DE PRODUCCION
//$wsdlURL = 'https://e-factura.sunat.gob.pe/ol-ti-itcpfegem/billService';


echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #000099; margin-bottom: 10px;">';
echo 'URL Beta de SUNAT:<br>';
echo '<span style="color: #000000;">'.$wsdlURL.'</span>';
echo '</div>';
//Poner ruc ,username y password
$ruc="10704418341";  //Ruc sol
$usuario_sol="KALVERCI"; //usuario sol
$pass_sol="aterieful";    //password sol    
//Estructura del XML para la conexión

$XMLString = '<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.sunat.gob.pe" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
 <soapenv:Header>
     <wsse:Security>
         <wsse:UsernameToken Id="ABC-123">
             <wsse:Username>' . $ruc . $usuario_sol . '</wsse:Username>
             <wsse:Password>' . $pass_sol . '</wsse:Password>
         </wsse:UsernameToken>
     </wsse:Security>
 </soapenv:Header>
 <soapenv:Body>
     <ser:sendBill>
        <fileName>'.$NomArch.'.zip</fileName>
        <contentFile>' . base64_encode(file_get_contents($NomArch.'.zip')) . '</contentFile>
     </ser:sendBill>
 </soapenv:Body>
</soapenv:Envelope>';

echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #000099;">';
echo 'SOAP de envio al servidor de SUNAT con el metodo sendBill.';
echo '</div>';
echo $XMLString;


//Realizamos la llamada a nuestra función
$result = soapCall($wsdlURL, $callFunction = "sendBill", $XMLString);

echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #000099; margin-top: 10px;">';
echo 'Respuesta del servidor de SUNAT:<br>';
echo '<span style="color: #000000;">'.$result.'</span>';
echo '</div>';

//Descargamos el Archivo Response
$archivo = fopen('C'.$NomArch.'.xml','w+');
fputs($archivo,$result);
fclose($archivo);


/*LEEMOS EL ARCHIVO XML*/
$xml = simplexml_load_file('C'.$NomArch.'.xml'); 
foreach ($xml->xpath('//applicationResponse') as $response){ }

/*AQUI DESCARGAMOS EL ARCHIVO CDR(CONSTANCIA DE RECEPCIÓN)*/
$cdr=base64_decode($response);

//Dirección donde será guardado el cdr  cdr/
$archivo = fopen('cdr/R-'.$NomArch.'.zip','w+');
fputs($archivo,$cdr);
fclose($archivo);
chmod('cdr/R-'.$NomArch.'.zip', 0777);

echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #000099; margin-top: 10px;">';
echo 'Archivo .ZIP recibido.<br>';
echo '<span style="color: #000000;">R-'.$NomArch.'.zip</span>';
echo '</div>';

$archive = new PclZip('cdr/R-'.$NomArch.'.zip');
if ($archive->extract("cdr/")==0) { 
    die("Error : ".$archive->errorInfo(true)); 
}else{
    chmod('cdr/R-'.$NomArch.'.xml', 0777);    
} 

echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #000099; margin-top: 10px;">';
echo 'Archivo .XML constancia de recepcion (CDR) ya descomprimido.<br>';
echo '<span style="color: #A70202;">R-'.$NomArch.'.xml</span>';
echo '</div>';

/*Eliminamos los archivos auxiliares creados*/
unlink('C'.$NomArch.'.XML');
unlink($NomArch.'.XML');
unlink($NomArch.'.zip');


