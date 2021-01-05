<?php
header('Content-Type: text/html; charset=UTF-8');
echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16pt; color: #000000; margin-bottom: 10px;">';
echo 'SUNAT. Facturación electrónica Perú.<br>';
echo '<span style="color: #000099; font-size: 15pt;">Crear archivo .XML correspondiente a la factura electrónica.</span>';
echo '<hr width="100%"></div>';

$xml = new DomDocument('1.0', 'ISO-8859-1');

//emisor
$ruc_emisor="20550250889";
$doc2="F002-00000026";
$tipo_doc="01";
$fecha="2016-12-12";
$moneda="PEN";
$razon_social="DESARROLLO DE SISTEMAS INTEGRADOS DE GESTIÓN";
$emisor="FERNANDO CARMELO MAMANI BLAS";
$direccion_emisor="Mercado 3 de Octubre Av-Brasil, B4, Comité 1 - JLB y Rivero";
$doc_emisor=6;


//usuario
$ruc_usuario="20550250889";
$razon_usuario="DESARROLLO DE SISTEMAS INTEGRADOS DE GESTIÓN";
$usuario="FERNANDO CARMELO MAMANI BLAS";
$doc_id=6;
$igv_total=18;
$total=118;
$total_ventas_operaciones_gravadas=round($total/1.18,2);

//producto
$id=1;
$cantidad=1;
$tipo_cantidad="ZZ";

$precio_unitario=118.00;
$a=1.18;

$valor_unitario=round($precio_unitario/$a,2);
//$valor_unitario=100;
$total_producto=round($valor_unitario*$cantidad,2);
//$total_producto=100;
$igv=0.18;
$total_igv=round($igv*$total_producto,2);

//print"$valor_unitario";

//print"<br>$total_producto";

$producto="CLAVO PARA CONCRETO DE 2";
$codigo="ALM";

$xml->standalone         = false;
$xml->preserveWhiteSpace = false;

$Invoice = $xml->createElement('Invoice');
$Invoice = $xml->appendChild($Invoice);
// Set the attributes.
$Invoice->setAttribute('xmlns', 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2');
$Invoice->setAttribute('xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
$Invoice->setAttribute('xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
$Invoice->setAttribute('xmlns:ccts', "urn:un:unece:uncefact:documentation:2");
$Invoice->setAttribute('xmlns:ds', "http://www.w3.org/2000/09/xmldsig#");
$Invoice->setAttribute('xmlns:ext', "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2");
$Invoice->setAttribute('xmlns:qdt', "urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2");
$Invoice->setAttribute('xmlns:sac', "urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1");
//$Invoice->setAttribute('xmlns:schemaLocation', "urn:oasis:names:specification:ubl:schema:xsd:Invoice-2 ../xsd/maindoc/UBLPE-Invoice-1.0.xsd");
$Invoice->setAttribute('xmlns:udt', "urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2");

$UBLExtension = $xml->createElement('ext:UBLExtensions');
$UBLExtension = $Invoice->appendChild($UBLExtension);

$ext = $xml->createElement('ext:UBLExtension');
$ext = $UBLExtension->appendChild($ext);

$contents = $xml->createElement('ext:ExtensionContent');
$contents = $ext->appendChild($contents);

$sac = $xml->createElement('sac:AdditionalInformation');
$sac = $contents->appendChild($sac);

$monetary = $xml->createElement('sac:AdditionalMonetaryTotal');
$monetary = $sac->appendChild($monetary);

$cbc = $xml->createElement('cbc:ID', '2005');
$cbc = $monetary->appendChild($cbc);

$cbc = $xml->createElement('cbc:PayableAmount', '0.00');
$cbc = $monetary->appendChild($cbc);
$cbc->setAttribute('currencyID', "PEN");

$monetary = $xml->createElement('sac:AdditionalMonetaryTotal');
$monetary = $sac->appendChild($monetary);

$cbc = $xml->createElement('cbc:ID', '1001');
$cbc = $monetary->appendChild($cbc);

$cbc = $xml->createElement('cbc:PayableAmount', "$total_ventas_operaciones_gravadas");
$cbc = $monetary->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$monetary = $xml->createElement('sac:AdditionalMonetaryTotal');
$monetary = $sac->appendChild($monetary);

$cbc = $xml->createElement('cbc:ID', '1002');
$cbc = $monetary->appendChild($cbc);

$cbc = $xml->createElement('cbc:PayableAmount', '0.00');
$cbc = $monetary->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$monetary = $xml->createElement('sac:AdditionalMonetaryTotal');
$monetary = $sac->appendChild($monetary);

$cbc = $xml->createElement('cbc:ID', '1003');
$cbc = $monetary->appendChild($cbc);

$cbc = $xml->createElement('cbc:PayableAmount', '0.00');
$cbc = $monetary->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$aditional = $xml->createElement('sac:AdditionalProperty');
$aditional = $sac->appendChild($aditional);

$cbc = $xml->createElement('cbc:ID', '1000');
$cbc = $aditional->appendChild($cbc);

$cbc = $xml->createElement('cbc:Value', '1000 AV BOLIVIA');
$cbc = $aditional->appendChild($cbc);

$aditional = $xml->createElement('sac:AdditionalProperty');
$aditional = $sac->appendChild($aditional);

$cbc = $xml->createElement('cbc:ID', '1002');
$cbc = $aditional->appendChild($cbc);

$cbc = $xml->createElement('cbc:Value', '1002 AAAAA');
$cbc = $aditional->appendChild($cbc);

$aditional = $xml->createElement('sac:AdditionalProperty');
$aditional = $sac->appendChild($aditional);

$cbc = $xml->createElement('cbc:ID', '2000');
$cbc = $aditional->appendChild($cbc);

$cbc = $xml->createElement('cbc:Value', '2000 BBBB');
$cbc = $aditional->appendChild($cbc);

$aditional = $xml->createElement('sac:AdditionalProperty');
$aditional = $sac->appendChild($aditional);

$cbc = $xml->createElement('cbc:ID', '2002');
$cbc = $aditional->appendChild($cbc);

$cbc = $xml->createElement('cbc:Value', '2002 CCC');
$cbc = $aditional->appendChild($cbc);

$aditional = $xml->createElement('sac:AdditionalProperty');
$aditional = $sac->appendChild($aditional);

$cbc = $xml->createElement('cbc:ID', '2003');
$cbc = $aditional->appendChild($cbc);

$cbc = $xml->createElement('cbc:Value', '2003 DDD');
$cbc = $aditional->appendChild($cbc);

$aditional = $xml->createElement('sac:AdditionalProperty');
$aditional = $sac->appendChild($aditional);

$cbc = $xml->createElement('cbc:ID', '2005');
$cbc = $aditional->appendChild($cbc);

$cbc = $xml->createElement('cbc:Value', '2005 EEE');
$cbc = $aditional->appendChild($cbc);

$aditional = $xml->createElement('sac:AdditionalProperty');
$aditional = $sac->appendChild($aditional);

$cbc = $xml->createElement('cbc:ID', '2006');
$cbc = $aditional->appendChild($cbc);

$cbc = $xml->createElement('cbc:Value', '2006 AAAAA');
$cbc = $aditional->appendChild($cbc);

$aditional = $xml->createElement('sac:AdditionalProperty');
$aditional = $sac->appendChild($aditional);

$cbc = $xml->createElement('cbc:ID', '2007');
$cbc = $aditional->appendChild($cbc);

$cbc = $xml->createElement('cbc:Value', '2007 GGG');
$cbc = $aditional->appendChild($cbc);

$aditional = $xml->createElement('sac:AdditionalProperty');
$aditional = $sac->appendChild($aditional);

$cbc = $xml->createElement('cbc:ID', '3000');
$cbc = $aditional->appendChild($cbc);

$cbc = $xml->createElement('cbc:Value', '3000 FOB');
$cbc = $aditional->appendChild($cbc);

$sunat = $xml->createElement('sac:SUNATTransaction');
$sunat = $sac->appendChild($sunat);

$cbc = $xml->createElement('cbc:ID', '1');
$cbc = $sunat->appendChild($cbc);

$ext = $xml->createElement('ext:UBLExtension');
$ext = $UBLExtension->appendChild($ext);

$contents = $xml->createElement('ext:ExtensionContent', ' ');
$contents = $ext->appendChild($contents);

$cbc = $xml->createElement('cbc:UBLVersionID', '2.0');
$cbc = $Invoice->appendChild($cbc);

$cbc = $xml->createElement('cbc:CustomizationID', '1.0');
$cbc = $Invoice->appendChild($cbc);

$cbc = $xml->createElement('cbc:ID', "$doc2");
$cbc = $Invoice->appendChild($cbc);

$cbc = $xml->createElement('cbc:IssueDate', "$fecha");
$cbc = $Invoice->appendChild($cbc);

$cbc = $xml->createElement('cbc:InvoiceTypeCode', "$tipo_doc");
$cbc = $Invoice->appendChild($cbc);

$cbc = $xml->createElement('cbc:DocumentCurrencyCode', "$moneda");
$cbc = $Invoice->appendChild($cbc);

$cac_signature = $xml->createElement('cac:Signature');
$cac_signature = $Invoice->appendChild($cac_signature);

$cbc = $xml->createElement('cbc:ID', "$ruc_emisor");
$cbc = $cac_signature->appendChild($cbc);

$cbc = $xml->createElement('cbc:Note', 'Elaborado por Sistemas Velazco');
$cbc = $cac_signature->appendChild($cbc);

$cbc = $xml->createElement('cbc:ValidatorID', '780086');
$cbc = $cac_signature->appendChild($cbc);

$cac_signatory = $xml->createElement('cac:SignatoryParty');
$cac_signatory = $cac_signature->appendChild($cac_signatory);

$cac = $xml->createElement('cac:PartyIdentification');
$cac = $cac_signatory->appendChild($cac);

$cbc = $xml->createElement('cbc:ID', "$ruc_emisor");
$cbc = $cac->appendChild($cbc);

$cac = $xml->createElement('cac:PartyName');
$cac = $cac_signatory->appendChild($cac);

$cbc = $xml->createElement('cbc:Name', "$razon_social");
$cbc = $cac->appendChild($cbc);

$agent = $xml->createElement('cac:AgentParty');
$agent = $cac_signatory->appendChild($agent);

$cac = $xml->createElement('cac:PartyIdentification');
$cac = $agent->appendChild($cac);

$cbc = $xml->createElement('cbc:ID', "$ruc_emisor");
$cbc = $cac->appendChild($cbc);

$cac = $xml->createElement('cac:PartyName');
$cac = $agent->appendChild($cac);

$cbc = $xml->createElement('cbc:Name', "$emisor");
$cbc = $cac->appendChild($cbc);

$cac = $xml->createElement('cac:PartyLegalEntity');
$cac = $agent->appendChild($cac);

$cbc = $xml->createElement('cbc:RegistrationName', "$emisor");
$cbc = $cac->appendChild($cbc);

$cac_digital = $xml->createElement('cac:DigitalSignatureAttachment');
$cac_digital = $cac_signature->appendChild($cac_digital);

$cac = $xml->createElement('cac:ExternalReference');
$cac = $cac_digital->appendChild($cac);

$cbc = $xml->createElement('cbc:URI', 'SIGN');
$cbc = $cac->appendChild($cbc);

$cac_accounting = $xml->createElement('cac:AccountingSupplierParty');
$cac_accounting = $Invoice->appendChild($cac_accounting);

$cbc = $xml->createElement('cbc:CustomerAssignedAccountID', "$ruc_emisor");
$cbc = $cac_accounting->appendChild($cbc);

$cbc = $xml->createElement('cbc:AdditionalAccountID', "$doc_emisor");
$cbc = $cac_accounting->appendChild($cbc);

$cac_party = $xml->createElement('cac:Party');
$cac_party = $cac_accounting->appendChild($cac_party);

$cac = $xml->createElement('cac:PartyName');
$cac = $cac_party->appendChild($cac);

$cbc = $xml->createElement('cbc:Name', "$razon_social");
$cbc = $cac->appendChild($cbc);

$address = $xml->createElement('cac:PostalAddress');
$address = $cac_party->appendChild($address);

$cbc = $xml->createElement('cbc:ID', '040101');
$cbc = $address->appendChild($cbc);

$cbc = $xml->createElement('cbc:StreetName', "$direccion_emisor");
$cbc = $address->appendChild($cbc);

$country = $xml->createElement('cac:Country');
$country = $address->appendChild($country);

$cbc = $xml->createElement('cbc:IdentificationCode', 'PER');
$cbc = $country->appendChild($cbc);

$legal = $xml->createElement('cac:PartyLegalEntity');
$legal = $cac_party->appendChild($legal);

$cbc = $xml->createElement('cbc:RegistrationName', "$emisor");
$cbc = $legal->appendChild($cbc);

$cac_accounting = $xml->createElement('cac:AccountingCustomerParty');
$cac_accounting = $Invoice->appendChild($cac_accounting);

$cbc = $xml->createElement('cbc:CustomerAssignedAccountID', "$ruc_usuario");
$cbc = $cac_accounting->appendChild($cbc);

$cbc = $xml->createElement('cbc:AdditionalAccountID', "$doc_id");
$cbc = $cac_accounting->appendChild($cbc);

$cac_party = $xml->createElement('cac:Party');
$cac_party = $cac_accounting->appendChild($cac_party);

$legal = $xml->createElement('cac:PartyLegalEntity');
$legal = $cac_party->appendChild($legal);

$cbc = $xml->createElement('cbc:RegistrationName', "$razon_usuario");
$cbc = $legal->appendChild($cbc);

$seller = $xml->createElement('cac:SellerSupplierParty');
$seller = $Invoice->appendChild($seller);

$cac_party = $xml->createElement('cac:Party');
$cac_party = $seller->appendChild($cac_party);

$address = $xml->createElement('cac:PostalAddress');
$address = $cac_party->appendChild($address);

$cbc = $xml->createElement('cbc:AddressTypeCode', '0');
$cbc = $address->appendChild($cbc);

$taxtotal = $xml->createElement('cac:TaxTotal');
$taxtotal = $Invoice->appendChild($taxtotal);

$cbc = $xml->createElement('cbc:TaxAmount', "$igv_total");
$cbc = $taxtotal->appendChild($cbc);
$cbc->setAttribute('currencyID', "PEN");

$taxtsubtotal = $xml->createElement('cac:TaxSubtotal');
$taxtsubtotal = $taxtotal->appendChild($taxtsubtotal);

$cbc = $xml->createElement('cbc:TaxAmount', "$igv_total");
$cbc = $taxtsubtotal->appendChild($cbc);
$cbc->setAttribute('currencyID', "PEN");

$taxtcategory = $xml->createElement('cac:TaxCategory');
$taxtcategory = $taxtsubtotal->appendChild($taxtcategory);

$taxscheme = $xml->createElement('cac:TaxScheme');
$taxscheme = $taxtcategory->appendChild($taxscheme);

$cbc = $xml->createElement('cbc:ID', '1000');
$cbc = $taxscheme->appendChild($cbc);

$cbc = $xml->createElement('cbc:Name', 'IGV');
$cbc = $taxscheme->appendChild($cbc);

$cbc = $xml->createElement('cbc:TaxTypeCode', 'VAT');
$cbc = $taxscheme->appendChild($cbc);

$legal = $xml->createElement('cac:LegalMonetaryTotal');
$legal = $Invoice->appendChild($legal);

$cbc = $xml->createElement('cbc:AllowanceTotalAmount', '0.00');
$cbc = $legal->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$cbc = $xml->createElement('cbc:ChargeTotalAmount', '0.00');
$cbc = $legal->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$cbc = $xml->createElement('cbc:PayableAmount', "$total");
$cbc = $legal->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$InvoiceLine = $xml->createElement('cac:InvoiceLine');
$InvoiceLine = $Invoice->appendChild($InvoiceLine);

$cbc = $xml->createElement('cbc:ID', "$id");
$cbc = $InvoiceLine->appendChild($cbc);

$cbc = $xml->createElement('cbc:InvoicedQuantity', "$cantidad");
$cbc = $InvoiceLine->appendChild($cbc);
$cbc->setAttribute('unitCode', "$tipo_cantidad");

$cbc = $xml->createElement('cbc:LineExtensionAmount', "$total_producto");
$cbc = $InvoiceLine->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$pricing = $xml->createElement('cac:PricingReference');
$pricing = $InvoiceLine->appendChild($pricing);

$cac = $xml->createElement('cac:AlternativeConditionPrice');
$cac = $pricing->appendChild($cac);

$cbc = $xml->createElement('cbc:PriceAmount', "$precio_unitario");
$cbc = $cac->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$cbc = $xml->createElement('cbc:PriceTypeCode', '01');
$cbc = $cac->appendChild($cbc);

$allowance = $xml->createElement('cac:AllowanceCharge');
$allowance = $InvoiceLine->appendChild($allowance);

$cbc = $xml->createElement('cbc:ChargeIndicator', 'false');
$cbc = $allowance->appendChild($cbc);

$cbc = $xml->createElement('cbc:Amount', '0.00');
$cbc = $allowance->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$taxtotal = $xml->createElement('cac:TaxTotal');
$taxtotal = $InvoiceLine->appendChild($taxtotal);

$cbc = $xml->createElement('cbc:TaxAmount', "$total_igv");
$cbc = $taxtotal->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$taxtsubtotal = $xml->createElement('cac:TaxSubtotal');
$taxtsubtotal = $taxtotal->appendChild($taxtsubtotal);

$cbc = $xml->createElement('cbc:TaxableAmount', "$total_igv");
$cbc = $taxtsubtotal->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$cbc = $xml->createElement('cbc:TaxAmount', "$total_igv");
$cbc = $taxtsubtotal->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

$taxtcategory = $xml->createElement('cac:TaxCategory');
$taxtcategory = $taxtsubtotal->appendChild($taxtcategory);

$cbc = $xml->createElement('cbc:TaxExemptionReasonCode', '10');
$cbc = $taxtcategory->appendChild($cbc);

$taxscheme = $xml->createElement('cac:TaxScheme');
$taxscheme = $taxtcategory->appendChild($taxscheme);

$cbc = $xml->createElement('cbc:ID', '1000');
$cbc = $taxscheme->appendChild($cbc);

$cbc = $xml->createElement('cbc:Name', 'IGV');
$cbc = $taxscheme->appendChild($cbc);

$cbc = $xml->createElement('cbc:TaxTypeCode', 'VAT');
$cbc = $taxscheme->appendChild($cbc);

$item = $xml->createElement('cac:Item');
$item = $InvoiceLine->appendChild($item);

$cbc = $xml->createElement('cbc:Description', "$producto");
$cbc = $item->appendChild($cbc);

$sellers = $xml->createElement('cac:SellersItemIdentification');
$sellers = $item->appendChild($sellers);

$cbc = $xml->createElement('cbc:ID', 'ALM');
$cbc = $sellers->appendChild($cbc);

$additional = $xml->createElement('cac:AdditionalItemIdentification');
$additional = $item->appendChild($additional);

$cbc = $xml->createElement('cbc:ID', 'A');
$cbc = $additional->appendChild($cbc);

$price = $xml->createElement('cac:Price');
$price = $InvoiceLine->appendChild($price);

$cbc = $xml->createElement('cbc:PriceAmount', "$valor_unitario");
$cbc = $price->appendChild($cbc);
$cbc->setAttribute('currencyID', "$moneda");

//segundo producto


//fin segundo producto

$xml->formatOutput = true;
$strings_xml       = $xml->saveXML();
$xml->save("factura-sin-firmar/$ruc_emisor-01-F002-00000026.xml");

chmod("factura-sin-firmar/$ruc_emisor-01-F002-00000026.xml", 0777);

echo '<span style="color: #015B01; font-size: 15pt;">Factura creada:</span>&nbsp;';
echo '<span style="color: #B21919; font-size: 15pt;">'.$ruc_emisor.'-01-F002-00000026.xml</span><br>';
  

echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16pt; color: #000000; margin-bottom: 10px;">';
echo 'SUNAT. Facturación electrónica Perú.<br>';
echo '<span style="color: #000099; font-size: 15pt;">Proceso para firmar factura electrónica.</span>';
echo '<hr width="100%"></div>';

require dirname(__FILE__) . '/robrichards/src/xmlseclibs.php';
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

// Cargar el XML a firmar
$doc = new DOMDocument();
$doc->load('factura-sin-firmar/'.$ruc_emisor.'-'.$tipo_doc.'-'.$doc2.'.xml');

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
$objKey->loadKey('archivos_pem/private_key.pem', true);
$objDSig->sign($objKey);

// Agregue la clave pública asociada a la firma
$objDSig->add509Cert(file_get_contents('archivos_pem/public_key.pem'), true, false, array('subjectName' => true)); // array('issuerSerial' => true, 'subjectName' => true));

// Anexar la firma al XML
$objDSig->appendSignature($doc->getElementsByTagName('ExtensionContent')->item(1));

// Guardar el XML firmado
$doc->save($ruc_emisor.'-'.$tipo_doc.'-'.$doc2.'.xml');
chmod($ruc_emisor.'-'.$tipo_doc.'-'.$doc2.'.xml', 0777);

echo '<span style="color: #015B01; font-size: 15pt;">Factura firmada:</span>&nbsp;';
echo '<span style="color: #B21919; font-size: 15pt;">'.$ruc_emisor.'-'.$tipo_doc.'-'.$doc2.'.xml</span><br>';
