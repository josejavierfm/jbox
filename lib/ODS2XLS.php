<?

require_once 'PHPExcel/IOFactory.php';


function convierte_ODS_XLS($rutaods,$rutaxls){

	$objReader = PHPExcel_IOFactory::createReader('OOCalc');
	$objPHPExcel = $objReader->load($rutaods);


	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save($rutaxls);
	return true;
}