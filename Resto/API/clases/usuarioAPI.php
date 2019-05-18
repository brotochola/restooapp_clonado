<?php

require_once 'AccesoDatos.php';
require_once 'usuario.php';


class usuarioAPI extends usuario
{ 

	  public function CargarObjeto($request, $response, $args) {   
        
   	$vector = $request->getParsedBody();

//para angular
$var = json_decode($vector['usr'], true);

//return var_dump($vector); 

	

	$elUsuario = new usuario();
	$elUsuario->nombre = $var['nombre'];	
	$elUsuario->mail = $var['mail'];
	$elUsuario->perfil = $var['perfil'];
	$elUsuario->clave = $var['clave'];

	$res = usuario::Insertar($elUsuario); 

	$newResponse = $response->withJson($res, 200);        
        return $newResponse;

	/*



	


        $objDelaRespuesta = new stdclass();  
        $objDelaRespuesta->itsOK = false;  
        $objDelaRespuesta->mensaje = "El ususario no existe";            
        $vector = $request->getParsedBody();

	return var_dump($vector);

        $vId = $vector['mail'];  
        $vClave = $vector['clave']; 

        $var = usuario::TraerUnoMail($vId);
        
        if($var != null)
        {
            $var = usuario::TraerUno($vId,$vClave);           
            if($var != null)
            {  
                $objDelaRespuesta->elUsuario = new usuario();
                $objDelaRespuesta->itsOK = true;
                $objDelaRespuesta->elUsuario = $var[0]; 
                $objDelaRespuesta->token = AutentificadorJWT::CrearToken($var[0]);  
                $objDelaRespuesta->elUsuario->clave = null; 
                $objDelaRespuesta->mensaje = "Login correcto";  
                $newResponse = $response->withJson($objDelaRespuesta, 200);        
                return $newResponse;        
            }
            else
            {
                $objDelaRespuesta->mensaje = "Clave incorrecta";
            }

        }       
        $newResponse = $response->withJson($objDelaRespuesta, 200);        
        return $newResponse;              */
    }


        
    public function TraerUnUsuario($request, $response, $args) {   
        
        $objDelaRespuesta = new stdclass();  
        $objDelaRespuesta->itsOK = false;  
        $objDelaRespuesta->mensaje = "El ususario no existe";            
        $vector = $request->getParsedBody();

	//return var_dump($vector);

        $vId = $vector['mail'];  
        $vClave = $vector['clave']; 

        $var = usuario::TraerUnoMail($vId);
        
        if($var != null)
        {
            $var = usuario::TraerUno($vId,$vClave);           
            if($var != null)
            {  
                $objDelaRespuesta->elUsuario = new usuario();
                $objDelaRespuesta->itsOK = true;
                $objDelaRespuesta->elUsuario = $var[0]; 
                $objDelaRespuesta->token = AutentificadorJWT::CrearToken($var[0]);  
                $objDelaRespuesta->elUsuario->clave = null; 
                $objDelaRespuesta->mensaje = "Login correcto";  
                $newResponse = $response->withJson($objDelaRespuesta, 200);        
                return $newResponse;        
            }
            else
            {
                $objDelaRespuesta->mensaje = "Clave incorrecta";
            }

        }       
        $newResponse = $response->withJson($objDelaRespuesta, 200);        
        return $newResponse;              
    }

	//     public function TraerUnEmpleadoGet($request, $response, $args) {   
        
    //     $objDelaRespuesta = new stdclass();  
    //     $objDelaRespuesta->itsOK = false;  
    //     $objDelaRespuesta->mensaje = "El empleado no existe";            
    //     $vector = $request->getParams('usuario','clave');

    //     $vUsuario = $vector['usuario'];  
    //     $vClave = $vector['clave']; 

    //     $var = empleado::TraerUnoUsuario($vUsuario);
        
    //     if($var != null)
    //     {
    //         $var = empleado::TraerUsuario($vUsuario,$vClave);           
    //         if($var != null)
    //         {  
    //             $objDelaRespuesta->elEmpleado = new empleado();
    //             $objDelaRespuesta->itsOK = true;
    //             $objDelaRespuesta->elEmpleado = $var[0]; 
    //             $objDelaRespuesta->token = AutentificadorJWT::CrearToken($var[0]);  
    //             $objDelaRespuesta->elEmpleado->sueldo = null;
    //             $objDelaRespuesta->elEmpleado->clave = null; 
    //             $objDelaRespuesta->mensaje = "Login correcto";  
    //             $newResponse = $response->withJson($objDelaRespuesta, 200);        
    //             return $newResponse;        
    //         }
    //         else
    //         {
    //             $objDelaRespuesta->mensaje = "Clave incorrecta";
    //         }

    //     }       
    //     $newResponse = $response->withJson($objDelaRespuesta, 200);        
    //     return $newResponse;              
    // }



    // public function CargarEmpleado($request, $response,$args){
    
    //     $Hora = new DateTime(); 
    //     $aux = date_format($Hora,"Y/m/d H:i:s");

    //     $emp = new empleado();

    //     $vector = $request->getParams('id_empleado','nombre_completo','id_rol','fecha_ingreso','fecha_egreso','clave','sueldo');
        
    //     $emp->id_empleado = $vector['id_empleado'];
    //     $emp->nombre_completo = $vector['nombre_completo'];
    //     $emp->id_rol = $vector['id_rol'];
        
    //     $emp->activo = 1;
    //     $emp->sueldo = $vector['sueldo'];
    //     $emp->clave = $vector['clave'];  

            
    //     if($vector['fecha_ingreso'] == ""){
    //         $emp->fecha_ingreso =  $aux;
    //     }            
    //     else{
    //         $emp->fecha_ingreso = $vector['fecha_ingreso'];
    //     } 
        
    //     if($vector['fecha_egreso'] == ""){
    //         $emp->fecha_egreso = '0000-00-00';
    //     }            
    //     else{
    //         $emp->fecha_egreso = $vector['fecha_egreso'];
    //     }       
    //     $resultado = $emp->Insertar();    
        
    //     $objDelaRespuesta= new stdclass();
    //     $objDelaRespuesta->cantidad=$resultado;
    
    //     if($resultado > 0)$objDelaRespuesta->resultado = "Se hizo el alta del empleado!";
        
    //     elseif($resultado < 1) $objDelaRespuesta->resultado = "No se pudo hacer el alta!";
                        
    //     $newResponse = $response->withJson($objDelaRespuesta, 200);  
    //     return $newResponse; 

    // }

    // public function TraerEmpleados($request, $response, $args) {
        
    //     $Empleados = empleado::TraerTodoLosEmpleados();        
    //     $newResponse = $response->withJson($Empleados, 200);  
    //     return $newResponse;
    // }  
     

    // public function ModificarEmpleado($request, $response,$args)
    // {
    //     $emp = new empleado();
    //     $vector = $request->getParams('id_empleado','nombre_completo','id_rol','fecha_ingreso','fecha_egreso','clave','sueldo','activo');
       

    //     $emp->id_empleado = $vector['id_empleado'];
    //     $emp->nombre_completo = $vector['nombre_completo'];
    //     $emp->id_rol = $vector['id_rol'];
    //     $emp->fecha_ingreso = $vector['fecha_ingreso'];
    //     $emp->fecha_egreso = $vector['fecha_egreso'];
    //     $emp->sueldo = $vector['sueldo'];
    //     $emp->clave = $vector['clave'];
    //     $emp->activo = $vector['activo'];

	//    	$resultado =$emp->ModificarUno();
	//   	$responseObj= new stdclass();
	//     $responseObj->resultado=$resultado;
    //     $responseObj->tarea="modificar";
	//     return $response->withJson($responseObj, 200);	
    // }

    // public function TraerUnEmpleadoId($request, $response,$args)
    // {  
       
    //     $responseObj = new stdclass();
    //     $responseObj->itsOk = FALSE;
        
    //     $vector = $request->getParams('id_empleado');
    //     $emp = new empleado();
       
    //     $id_empleado = $vector['id_empleado'];        
    //     $var = empleado::TraerUnoId($id_empleado);

    //     if($var != null)
    //     {
    //         $emp = $var[0];          
    //         $responseObj->elEmpleado= $emp;
    //         $responseObj->tarea="Consulta";
    //         $responseObj->itsOk = TRUE;
    //     }      
	//     return $response->withJson($emp, 200);	
    // }

    // public function DesactivarUnEmpleado($request, $response,$args)
    // {  
       
    //     $responseObj = new stdclass();
    //     $responseObj->itsOk = FALSE;
        
    //     $vector = $request->getParams('id_empleado');
    //     $emp = new empleado();
       
    //     $id_empleado = $vector['id_empleado'];        
    //     $var = empleado::TraerUnoId($id_empleado);

    //     if($var != null)
    //     {
    //         $emp = $var[0];
    //         $resultado = $emp->DesactivarEmpleado();           
    //         $responseObj->resultado=$resultado;
    //         $responseObj->tarea="Desactivar";
    //         $responseObj->itsOk = TRUE;
    //     }      
	//     return $response->withJson($responseObj, 200);	
    // }

    // public function ActivarUnEmpleado($request, $response,$args)
    // {  
       
    //     $responseObj = new stdclass();
    //     $responseObj->itsOk = FALSE;
        
    //     $vector = $request->getParams('id_empleado');
    //     $emp = new empleado();
       
    //     $id_empleado = $vector['id_empleado'];        
    //     $var = empleado::TraerUnoId($id_empleado);

    //     if($var != null)
    //     {
    //         $emp = $var[0];
    //         $resultado = $emp->ActivarEmpleado();           
    //         $responseObj->resultado=$resultado;
    //         $responseObj->tarea="Activar";
    //         $responseObj->itsOk = TRUE;
    //     }      
	//     return $response->withJson($responseObj, 200);	
    // }


    // public function BorrarEmpleado($request, $response, $args) {

    //     $objDelaRespuesta = new stdclass();  
    //     $objDelaRespuesta->itsOK = false;
    //     $objDelaRespuesta->resultado = "El empleado no existe";   
                        
    //     $vector = $request->getParams('id_empleado');
    //     $vId = $vector['id_empleado'];  
        
    //     $var = empleado::TraerUnoId($vId);
        
    //     if($var != null){
               
    //         $emp = new empleado();
    //         $emp = $var[0];  

    //         try{

    //             $cantidadDeBorrados= $emp->BorrarUno(); 

    //         }
    //         catch(Exception $e){

    //             $objDelaRespuesta->resultado = $e->getMessage();
    //             $objDelaRespuesta->itsOK = false;        
    //         }
    //         if($objDelaRespuesta->itsOK)
    //         {
    //             $objDelaRespuesta->itsOK = true;
    //             $objDelaRespuesta= new stdclass();
    //             $objDelaRespuesta->cantidad=$cantidadDeBorrados;

    //             if($cantidadDeBorrados == 1)$objDelaRespuesta->resultado="Se borró un elemento!!!";
                
    //             elseif($cantidadDeBorrados > 1) $objDelaRespuesta->resultado="Se borró más de un elemento!!!";
                
    //             elseif($cantidadDeBorrados < 1) $objDelaRespuesta->resultado="No se borró ningún elemento!!!";                
    //         }
           
    //     }
    //     $newResponse = $response->withJson($objDelaRespuesta, 200);  
    //     return $newResponse; 
    // }

    //     //EXCEL


    //     public function TraerDatosParaExportarExcel($request, $response, $args)
    //     {

    //     $arrayEmpleados = empleado::TraerTodoLosEmpleados();

    //    // return var_dump($arrayEmpleados);

    //     if (count($arrayEmpleados) > 0) {
    //         $objPHPExcel = new PHPExcel();
            
    //         //Informacion del excel
    //         $objPHPExcel->
    //         getProperties()
    //             ->setCreator("Olinuck Darío")
    //             ->setLastModifiedBy("Olinuck Darío")
    //             ->setTitle("ListaEmpleados")
    //             ->setSubject("Ejemplo 1")
    //             ->setDescription("Documento generado con PHPExcel")
    //             ->setKeywords("Olinuck Darío")
    //             ->setCategory("Empleados");

    //     //ESTILOS 

    //     $styleArray = array(
    //         'font'  => array(
    //             'bold'  => true,
    //             'color' => array('rgb' => '000000'),
    //             'size'  => 12,
    //             'name'  => 'Verdana'
    //         ));

    //     $styleColor = array(
    //             'fill' => array(
    //                 'type' => PHPExcel_Style_Fill::FILL_SOLID,
    //                 'color' => array('rgb' => 'FF0000')
    //             )
    //     );

    //     $styleTextCenter = array(
    //             'alignment' => array(
    //                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    //             )
    //         );

    //         $bordes = array(
    //         'borders' => array(
    //             'allborders' => array(
    //             'style' => PHPExcel_Style_Border::BORDER_THIN,
    //             'color' => array('argb' => 'FF000000'),
    //             )
    //         ),
    //     );

    //     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(false);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("18");
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(false);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("25");
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("38");   
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(false);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("18");

    //     //`id_empleado`, `nombre_completo`, 'id_rol','fecha_ingreso'

    //     $objPHPExcel->getActiveSheet()->getCell('A1')->setValue('id_empleado');
    //     $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
    //     $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleColor);
    //     $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleTextCenter);
    //     $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($bordes);

    //     $objPHPExcel->getActiveSheet()->getCell('B1')->setValue('nombre_completo');
    //     $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
    //     $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleColor);
    //     $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleTextCenter);
    //     $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($bordes);

    //     $objPHPExcel->getActiveSheet()->getCell('C1')->setValue('id_rol');
    //     $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
    //     $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleColor);
    //     $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleTextCenter);
    //     $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($bordes);

    //     $objPHPExcel->getActiveSheet()->getCell('D1')->setValue('fecha_ingreso');
    //     $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
    //     $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleColor);
    //     $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleTextCenter);
    //     $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($bordes);


    //     for($i=0;$i<count($arrayEmpleados);$i++)
    //         {
    //         $objPHPExcel->setActiveSheetIndex(0)
    //         ->getStyle('A'.($i+2))
    //         ->applyFromArray($bordes);
    //         $objPHPExcel->setActiveSheetIndex(0)
    //         ->getStyle('B'.($i+2))
    //         ->applyFromArray($bordes);
    //         $objPHPExcel->setActiveSheetIndex(0)
    //         ->getStyle('C'.($i+2))
    //         ->applyFromArray($bordes);
    //         $objPHPExcel->setActiveSheetIndex(0)
    //         ->getStyle('D'.($i+2))
    //         ->applyFromArray($bordes);
        

    //         $objPHPExcel->setActiveSheetIndex(0)
    //         ->getStyle('A'.($i+2))
    //         ->applyFromArray($styleTextCenter);
    //         $objPHPExcel->setActiveSheetIndex(0)
    //         ->getStyle('B'.($i+2))
    //         ->applyFromArray($styleTextCenter);
    //         $objPHPExcel->setActiveSheetIndex(0)
    //         ->getStyle('C'.($i+2))
    //         ->applyFromArray($styleTextCenter);
    //         $objPHPExcel->setActiveSheetIndex(0)
    //         ->getStyle('D'.($i+2))
    //         ->applyFromArray($styleTextCenter);
            
    //      //   $cantOperaciones=Operaciones::TraerOperacionesPorEmpleado($arrayEmpleados[$i]["IdEmpleado"]);

    //     //`id_empleado`, `nombre_completo`, 'id_rol','fecha_ingreso'

    //         $objPHPExcel->setActiveSheetIndex(0)
    //                 ->setCellValue('A'.($i+2), $arrayEmpleados[$i]["id_empleado"])
    //                 ->setCellValue('B'.($i+2),$arrayEmpleados[$i]["nombre_completo"])
    //                 ->setCellValue('C'.($i+2),$arrayEmpleados[$i]["id_rol"])
    //                 ->setCellValue('D'.($i+2),$arrayEmpleados[$i]["fecha_ingreso"]);
    //     }

    //     $styleArrayFecha = array(
    //         'font'  => array(
    //             'bold'  => true,
    //             'color' => array('rgb' => '008000'),
    //             'size'  => 10,
    //             'name'  => 'Verdana'
    //         ));

    //     $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
    //     $fecha_creacion = $dateTime->format("Y/m/d h:i A");
    //     $objPHPExcel->getActiveSheet()->getCell('I1')->setValue("Fecha de creación:");
    //     $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($styleArrayFecha);
    //     $objPHPExcel->getActiveSheet()->getCell('I2')->setValue($fecha_creacion);
    //     $objPHPExcel->getActiveSheet()->getStyle('I2')->applyFromArray($styleArrayFecha);

    //     }
    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="listadoEmpleados.xlsx"');
    //     header('Cache-Control: max-age=0');
    //     $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
    //     $objWriter->save('php://output');

    // }



}



?>
