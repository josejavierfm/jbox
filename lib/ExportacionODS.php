<?php

/*
	Exportación de un array a ODT.
	Miguel Oñoro Pedregosa, 12 / 5 / 2011
*/

//define('RUTA_TEMP',	'./tmp/');		// Con '/' al final
//

#class ExportacionODS
#{
	// cab[] tipo[] datos[][]
	
	function exportarODS($tipo,$cabeceras,$datos,$salida_zip,$ruta_skel,$ruta_tmp,$imprimecabeceras=true)
	{
		// PREPARACIÓN
		//--------------------------------------------------------------
		
		// Los tipos a minúsculas
		if ($tipo==null || $cabeceras==null){// por defecto string para todoas las cabeceras y lso nombres de las columnas los coge del array
			if ($datos){
				$k=0;
				foreach ($datos as $fila){
					foreach($fila as $n=>$v){
						$cabeceras[$k]=$n;$tipo[$k]="string";$k++;
					}
					break;
				}
			}
		}
		for ($i = 0; $i < count($tipo); $i++)
		{
			$tipo[$i] = strtolower($tipo[$i]);
		}
		
		// Creamos un directorio que no exista en el temporal.
		
		for (	$NOMBRE_TEMP = mt_rand(0, 9999999);
				file_exists($ruta_tmp . $NOMBRE_TEMP);
				$NOMBRE_TEMP = mt_rand(0, 9999999)
		);
		
		$DIR_TEMP = $ruta_tmp . $NOMBRE_TEMP . '/';
		mkdir($DIR_TEMP);
		
		// Copiamos el skel en el temporal
		$s1='cp '.$ruta_skel.'skel.tar '. $DIR_TEMP; //copiamos el tar en la carpeta temporal.
		$s2='cd '.$DIR_TEMP.';tar -xvf skel.tar;';
		$s22='rm skel.tar; ';
		/*@system ($s1);
		@system ($s2);*///no se puede usar system porque genera trazas que impiden el header.
		@exec($s1);
		@exec($s2);
		@exec($s22);
		
		
		// Creamos el content.xml
		
		$res = fopen("$DIR_TEMP/content.xml",'wt');
		
		// CREACIÓN DEL CONTENIDO
		//--------------------------------------------------------------
		
		// Cabecera ODS
		
		fprintf($res,	'<?xml version="1.0" encoding="UTF-8"?>' . "\n".
						'<office:document-content xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:presentation="urn:oasis:names:tc:opendocument:xmlns:presentation:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rpt="http://openoffice.org/2005/report" xmlns:of="urn:oasis:names:tc:opendocument:xmlns:of:1.2" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:grddl="http://www.w3.org/2003/g/data-view#" xmlns:tableooo="http://openoffice.org/2009/table" xmlns:field="urn:openoffice:names:experimental:ooo-ms-interop:xmlns:field:1.0" xmlns:formx="urn:openoffice:names:experimental:ooxml-odf-interop:xmlns:form:1.0" xmlns:css3t="http://www.w3.org/TR/css3-text/" office:version="1.2" grddl:transformation="http://docs.oasis-open.org/office/1.2/xslt/odf2rdf.xsl">'.
						"\n".
						'<office:scripts/>'.
						"\n".
						'<office:font-face-decls>'.
						"\n".
						'<style:font-face style:name="Liberation Sans" svg:font-family="&apos;Liberation Sans&apos;" style:font-family-generic="swiss" style:font-pitch="variable"/>'.
						"\n".
						'<style:font-face style:name="DejaVu Sans" svg:font-family="&apos;DejaVu Sans&apos;" style:font-family-generic="system" style:font-pitch="variable"/>'.
						"\n".
						'</office:font-face-decls>'.
						"\n".
						'<office:automatic-styles>'.
						"\n".
						'<style:style style:name="co1" style:family="table-column">'.
						"\n".
						'<style:table-column-properties fo:break-before="auto" style:column-width="2.267cm"/>'.
						"\n".
						'</style:style>'.
						"\n".
						'<style:style style:name="ro1" style:family="table-row">'.
						"\n".
						'<style:table-row-properties style:row-height="0.452cm" fo:break-before="auto" style:use-optimal-row-height="true"/>'.
						"\n".
						'</style:style><style:style style:name="ta1" style:family="table" style:master-page-name="Default">'.
						"\n".
						'<style:table-properties table:display="true" style:writing-mode="lr-tb"/>'.
						"\n".
						'</style:style>'.
						"\n".
						'<number:date-style style:name="N36" number:automatic-order="true">'.
						"\n".
						'<number:day number:style="long"/>'.
						"\n".
						'<number:text>/</number:text>'.
						"\n".
						'<number:month number:style="long"/>'.
						"\n".
						'<number:text>/</number:text>'.
						"\n".
						'<number:year number:style="long"/>'.
						"\n".
						'</number:date-style>'.
						"\n".
						'<style:style style:name="ce1" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N36"/>'.
						"\n".
						'<style:style style:name="ce2" style:family="table-cell" style:parent-style-name="Default">'.
						"\n".
						'<style:table-cell-properties style:text-align-source="fix" style:repeat-content="false"/>'.
						"\n".
						'<style:paragraph-properties fo:text-align="center" fo:margin-left="0cm"/>'.
						"\n".
						'<style:text-properties fo:font-size="12pt" fo:font-weight="bold" style:font-size-asian="12pt" style:font-weight-asian="bold" style:font-size-complex="12pt" style:font-weight-complex="bold"/>'.
						"\n".
						'</style:style>'.
						"\n".
						'<style:style style:name="ta_extref" style:family="table">'.
						"\n".
						'<style:table-properties table:display="false"/>'.
						"\n".
						'</style:style>'.
						"\n".
						'</office:automatic-styles>'.
						"\n".
						'<office:body>'.
						"\n".
						'<office:spreadsheet>'.
						"\n".
						'<table:table table:name="Hoja1" table:style-name="ta1" table:print="false">'.
						"\n".
						'<table:table-column table:style-name="co1" table:number-columns-repeated="'.
						count($tipo) . /* Nº de cols. */
						'" table:default-cell-style-name="Default"/>' . "\n"
		);
		
		//
		//cabeceras
		if ($imprimecabeceras){
			fprintf($res,'<table:table-row table:style-name="ro1">' . "\n");
			foreach($cabeceras as $k=>$titulo)
			{
				
				fprintf($res,'<table:table-cell table:style-name="ce2" office:value-type="string"><text:p>'.$titulo.'</text:p></table:table-cell>');
			}
			fprintf($res,'</table:table-row>'. "\n");
		}
		// Contenido
		
		//while ($fila = each($datos))
		$indicefila=0;
		if ($datos){
		foreach($datos as $k=>$fila)
		{
			// Fila
			
			
			fprintf($res,'<table:table-row table:style-name="ro1">' . "\n");
			$j=0;
			foreach($fila as $l=>$celda)
			{
				// Celda: Elegimos el tipo e imprimimos
				// en consecuencia
				$celda=trim($celda);
				$celda=utf8_encode ($celda);
				$celda=str_replace("<","&lt;",$celda);
				$celda=str_replace(">","&gt;",$celda);
				$celda=str_replace("&","&amp;",$celda);
				
				switch ($tipo[$j])
				{
					case 'string':
					{
						$cod = '<table:table-cell office:value-type="string"><text:p>'.$celda.'</text:p></table:table-cell>';
						
					}break;
					
					case 'float':
					{
						$cod = '<table:table-cell office:value-type="float" office:value="'.$celda.'"><text:p>'.$celda.'</text:p></table:table-cell>';
						
					}break;
					
					case 'date':
					{
						if ($celda==""){
							$cod = '<table:table-cell table:style-name="ce1"/>';
						}else{
						//$cod = '<table:table-cell office:value-type="date" office:date-value="2010-02-02">';
							$cod = '<table:table-cell table:style-name="ce1" office:value-type="date" office:date-value="'.fecNormal2ODS($celda).'"><text:p>'.$celda.'</text:p></table:table-cell>';
						}
						
					}break;
					
					default:
					{
						print_r($fila);
						die ("\nERROR: Tipo ($tipo[$j]) erróneo. j=$j\n");
					}
				}
				
				// La cabecera anterior
				
				fprintf($res,"%s\n",$cod);
				
				// El texto (aparte de lo anterior)
				// Para las fechas cambiamos '-' por '/'
				
				
				
				// Fin de la celda
				
				$j++;
				
			}
			
			
			
			// Fin de fila
			fprintf($res,'</table:table-row>'. "\n");
			
			$indicefila++;
			
		}
		}
		// Pie ODS
		fprintf($res,	'</table:table>' . "\n".
						'</office:spreadsheet></office:body></office:document-content>'
		);
		
		// COMPRESIÓN
		//--------------------------------------------------------------
		
		// Cerramos el content.xml
		
		fclose($res);
		
		// Comprimimos en zip (ods es realmente un zip)
		$s3="cd $DIR_TEMP; zip -r ../$salida_zip . 2>&1 >/dev/null";
		
		// Borramos el directorio temporal.
		@exec($s3);
		$s4="rm -rf $DIR_TEMP";
		@exec($s4);
	}
	
	function fecNormal2ODS($valor){
	if($valor!="" && $valor!="00/00/0000"){
		$y=substr($valor,6,4);
		$m=substr($valor,3,2);
		$d=substr($valor,0,2);
		return $y."-".$m."-".$d;
	}else{
		return "";
	}
}
#}
/*
exportar(	array('string','float','date'),
			array(	array('hola' , 1, '2011-01-02'),
					array('adios', 2, '2011-02-03')
			),
			'/tmp/resultado.ods'

);
*/
?>
