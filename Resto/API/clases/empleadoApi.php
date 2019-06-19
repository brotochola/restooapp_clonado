<?php

require_once 'AccesoDatos.php';
require_once 'empleado.php';
require_once 'Classes/PHPExcel.php';

class empleadoApi extends empleado
{ 
        
    public function TraerUnEmpleado($request, $response, $args) 
    {   

        $objDelaRespuesta = new stdclass();  
        $objDelaRespuesta->itsOK = false;  
        $objDelaRespuesta->mensaje = "El empleado no existe";            
        $vector = $request->getParsedBody();
        //print_r($vector);die();
    
        //$vUsuario = $vector['usuario'];  
        $vEmail = $vector['email'];  
        $vClave = $vector['clave']; 

        $var = empleado::TraerUnoEmail($vEmail);
        
        if($var != null)
        {
            $var = empleado::TraerUnoEmailClave($vEmail,$vClave);           
            if($var != null)
            {  
                $objDelaRespuesta->elEmpleado = new empleado();
                $objDelaRespuesta->itsOK = true;
                $objDelaRespuesta->elEmpleado = $var[0]; 
                $objDelaRespuesta->token = AutentificadorJWT::CrearToken($var[0]);  
                $objDelaRespuesta->elEmpleado->sueldo = null;
                $objDelaRespuesta->elEmpleado->clave = null; 
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

    public function CargarEmpleado($request, $response,$args)
    {
        $Hora = new DateTime(); 
        $aux = date_format($Hora,"Y/m/d H:i:s");

        $emp = new empleado();
       // $vector = $request->getParams('usuario','nombre_completo','id_rol','fecha_ingreso','fecha_egreso','clave','sueldo','fecha_nac','dni','habilitado');
        $vector = $request->getParsedBody();        

	    $var = $emp::TraerUltimoIdEmpleado();

        $emp->id_empleado = $var[0]["id_empleado"] + 1;
        $emp->usuario = $vector['usuario'];
        $emp->nombre_completo = $vector['nombre_completo'];
        $emp->id_rol = $vector['id_rol'];
        $emp->fecha_nac = $vector['fecha_nac'];
        $emp->dni = $vector['dni'];
                
        $emp->habilitado = $vector['habilitado'];
        $emp->email = $vector['email'];
        $emp->sueldo = $vector['sueldo'];

        if (isset($_POST["foto"]) && !empty($_POST["foto"])) {
            $emp->foto = $vector['foto']; 
        } else {  
            $emp->foto = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEXFxcX////CwsLGxsb7+/vT09PJycn19fXq6urb29vOzs7w8PDe3t7n5+f5+fnt7e2uCwolAAAFHUlEQVR4nO2dC5qqMAyFMTwUFNz/bq+VYYrKKJCkOfXmXwHna5uTpA+KwnEcx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3EcA2iO9cdIc5PUdO2l78+BU39p66b4HplE3eU6VIcnqmNfl1+gksr6+iIucr50WYukor7+re6Hoe1y1UhNO3zUd+fUFRmKpOa0Tt6dY5ubRCouG/QFzk1WGmnt/JxzykcjdZ/jyxJDLlOV2l36AtcsJJb9boG3YcR3DuqODIE3LtYKPkDdmwRmpUToUaSaq++AvRgZMWbOubQW8hdCAm8ZDugoikzREdCJ2okJPBx6azFLNOwoOgcxojJ98JkaTSJxMpklKrCAKhZGI0drTY/wU5lXoJYibannV9NYy4oozNEAkPHTjop+DTDxVGkIgYJNoyQQJtiIW+EMjGAjm649AjGIaqswcEZQKJ2QPlJbqytki6ZXAAZRJ52J2McaUowzAfs+uFzrYhnzaapphiPWdaJWShqxjqa6kTTQ205TVbsfMa6htL0iYOsXpJrQjHSmCkv1QGPtiHqlYcQ21Gj7fcDU8xOEUuNgSltPzexh+HqFlanCBHZ4OLhCV+gK/3OF6vWvucLv98MUOY2pwu/PS/+D2qJU7pYGbOvDFDW+bbON9p3o3oRxn0bfLgZTgSn6pSfrtr56qLHemtHPTK2319SzGvtjQ9qeb39Wgc66Cm073nd0U1PzDdJCO3Gzn6TKpl9Zq7ujGWsQhlA3NwWIMwG9zM08Y/tBrR9VWeczv5CSQuuUNKIUTk23ZJ5RKfVhjnkXotfWIlgX2BSCDYbZR+QTcLhb3dKZDUY2M0d4KWItwhHRah/zsrOgKw4wycwjcgEVcgQDQo23CqSiWEJkFAfod2oE1uIZdA1OsCPqFXYNTjCfb8Ez+iX2x5sKLlVbhtqdDcar9ZevhnbZxoBUD35k23t0d304LYs1ELVbnfFaZ/REJJX9niP8Q19moZGo3m8XR/yBvOnjFftncI2c8ZuNo7WMP5HQh6yRGrlmFOJTnyTcT+zRlqPUBI2gTVWNUzUna1ERgecgF4GpNBQ38jGqxVLzQA1A31Rrhk6Yz9QEh/WND0GnuG9huhiTXJkxfAizTHLr6cbJKN6UCU6x/2DTRE1xEeEXi3O0ZUqBN4nJRzHhFB1JPlFTBZlI2kQ8zc3KJ1Le8DIRmFJiknuVS6RK4Ej/JtBfJErDSzOBiY4wJHX6Z1I4v1GUmdCPNirnLLeg3oJLcbX5PcpHNbRvOa1A956QmRPOUXVF+zkaUJynpkYR0bOMJH2nNej1pqyV/aKkz9jr5yj5vrXXz1F5SQLACiMapmierj2ikLyleKdlA/I/2oFxiglxx9B+mHwz0lf34IZQfhDRhlD6bhvgEAoPYooHkTczSIZTLC+cEExsoNKZiGBiY9cCfo/Y/SjIOBMQizWWTe73CMUasJx7jlD+DdKdWUKoY4PRYFtGpO0G1Lx4RaadgTtJhf4fiGqGIwKWCGuGIwKWqP+7IxYCzygjR9IAO5pC7Da9g70TBVpWRNgFBlgT8RV2WxHbKwJMv4BOaEaYaU2K16yZMN/qgV+G7IWIvwyZCxHeDQMsR8wg0DBDDXB5H2EV+hkEGmaoySHQsEJNFoGGFWrAq98JRhUMX1iMMMqLLEIpK5jCbd4vw9nSt/72lewXiN6jmdjfq8Hdknlk92ZwJnbIMMRM7JBhiFlUFoHd1UWaP1QKsPsHA5mkNB+Smn9r+138jGzYzgAAAABJRU5ErkJggg==';
        }
           
        if($vector['fecha_ingreso'] == ""){
            $emp->fecha_ingreso =  $aux;
        }            
        else{
            $emp->fecha_ingreso = $vector['fecha_ingreso'];
        }

        if (isset($_POST["fecha_egreso"]) && !empty($_POST["fecha_egreso"])) {
            $emp->fecha_egreso = $vector['fecha_egreso']; 
        } else {  
            $emp->fecha_egreso = '2050-02-23';
        }
      
        $resultado = $emp->Insertar();    
        
        $objDelaRespuesta= new stdclass();
        $objDelaRespuesta->cantidad=$resultado;
	$objDelaRespuesta->itsOk = false;
    
        if($resultado > 0)
	{
		$objDelaRespuesta->mensaje = "Se hizo el alta del empleado!";
		$objDelaRespuesta->itsOk = true;
	}        
        elseif($resultado < 1) $objDelaRespuesta->mensaje = "No se pudo hacer el alta!";
                        
	    return $response->withJson(empleado::TraerTodoLosEmpleados(), 200);	
     
    }

    public function TraerEmpleados($request, $response, $args) 
    {  
        $Empleados = empleado::TraerTodoLosEmpleados();        
        $newResponse = $response->withJson($Empleados, 200);  
        return $newResponse;
    }  
     
    public function ModificarEmpleado($request, $response,$args)
    {
        $emp = new empleado();
        
        $vector = $request->getParsedBody(); //ahora viene por post
       // print_r( $vector );die();
        //$vector = $request->getParams('id_empleado','usuario','nombre_completo','id_rol','fecha_ingreso','fecha_egreso','clave','sueldo','fecha_nac','dni','habilitado');

        $emp->id_empleado = $vector['id_empleado'];
        $emp->usuario = $vector['usuario'];
        $emp->nombre_completo = $vector['nombre_completo'];
        $emp->id_rol = $vector['id_rol'];
        $emp->fecha_nac = $vector['fecha_nac'];
        $emp->dni = $vector['dni'];
                
        $emp->habilitado = $vector['habilitado'];
        $emp->email = $vector['email'];
        $emp->sueldo = $vector['sueldo'];
        $emp->clave = $vector['clave']; 

//        return $response->withJson($emp, 200);	

           $resultado = $emp->ModificarUno();

           $empleados=empleado::TraerTodoLosEmpleados();
         
           
	    return $response->withJson(empleado::TraerTodoLosEmpleados(), 200);	
    }

    public function DesactivarUnEmpleado($request, $response,$args)
    {  
        return self::ModificarEstadoEmpleado($request, $response, "Desactivar"); 	
    }

    public function ActivarUnEmpleado($request, $response, $args)
    {           
        return self::ModificarEstadoEmpleado($request, $response,"Activar"); 
    }

    public static function BorrarEmpleado($request, $response) 
    {
        $id = $request->getParsedBody()["id"];
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $sql="delete from empleados where id_empleado=".$id;

      //  echo $sql;die();
        $consulta =$objetoAccesoDato->RetornarConsulta($sql);
        $consulta->execute();



        return $response->withJson(empleado::TraerTodoLosEmpleados(), 200);	

      //  return self::ModificarEstadoEmpleado($request, $response,"Borrar"); 
    }
            
    public function ModificarEstadoEmpleado($request, $response, $tarea)
    {
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->itsOk = false;
        $objDelaRespuesta->resultado = "El empleado no existe";

        $vector = $request->getParams('id_empleado');        
        $emp = new empleado();
       
        $id_empleado = $vector['id_empleado'];        
        $var = empleado::TraerUnoId($id_empleado);
        
        if($var != null)
        {
            $emp = $var[0];
            
            if($tarea == "Borrar")
            {

                try
                {
                    $cantidadDeBorrados = $emp->BorrarUno();                     
                    $objDelaRespuesta->resultado = "Se eliminó un empleado";
                    $objDelaRespuesta->itsOk = true;
                    
                }
                catch(Exception $e)
                {
                    $objDelaRespuesta->mensaje = "El empleado no se puede dar de baja porque tiene elementos vinculados 
                    a su usuario en la base de datos";
                    $objDelaRespuesta->itsOk = false;        
                }            
            } 
            else
            {
                if($tarea == "Activar")
                {
                    $emp->activo = 1;
                    $objDelaRespuesta->resultado = "El empleado fue activado";
                    $objDelaRespuesta->tarea="Activar";
                }
                else if($tarea == "Desactivar")
                {
                    $emp->activo = 0;
                    $objDelaRespuesta->resultado = "El empleado fue desactivado";
                    $objDelaRespuesta->tarea="Desactivar";
                }
                $resultado = $emp->ModificarUno();           
                $objDelaRespuesta->itsOk = true;
            }
            
        }      
	    return $response->withJson($objDelaRespuesta, 200);	
    }


    
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

    // //excel
//         public function TraerDatosParaExportarExcel($request, $response, $args)
//         {

//         $arrayEmpleados = empleado::TraerTodoLosEmpleados();

//        // return var_dump($arrayEmpleados);

//         if (count($arrayEmpleados) > 0) {
//             $objPHPExcel = new PHPExcel();
            
//             //Informacion del excel
//             $objPHPExcel->
//             getProperties()
//                 ->setCreator("Olinuck Darío")
//                 ->setLastModifiedBy("Olinuck Darío")
//                 ->setTitle("ListaEmpleados")
//                 ->setSubject("Ejemplo 1")
//                 ->setDescription("Documento generado con PHPExcel")
//                 ->setKeywords("Olinuck Darío")
//                 ->setCategory("Empleados");

//         //ESTILOS 

//         $styleArray = array(
//             'font'  => array(
//                 'bold'  => true,
//                 'color' => array('rgb' => '000000'),
//                 'size'  => 12,
//                 'name'  => 'Verdana'
//             ));

//         $styleColor = array(
//                 'fill' => array(
//                     'type' => PHPExcel_Style_Fill::FILL_SOLID,
//                     'color' => array('rgb' => 'FF0000')
//                 )
//         );

//         $styleTextCenter = array(
//                 'alignment' => array(
//                     'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//                 )
//             );

//             $bordes = array(
//             'borders' => array(
//                 'allborders' => array(
//                 'style' => PHPExcel_Style_Border::BORDER_THIN,
//                 'color' => array('argb' => 'FF000000'),
//                 )
//             ),
//         );

//         $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(false);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("18");
//         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(false);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("25");
//         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("38");   
//         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(false);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("18");

//         //`id_empleado`, `nombre_completo`, 'id_rol','fecha_ingreso'

//         $objPHPExcel->getActiveSheet()->getCell('A1')->setValue('id_empleado');
//         $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
//         $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleColor);
//         $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleTextCenter);
//         $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($bordes);

//         $objPHPExcel->getActiveSheet()->getCell('B1')->setValue('nombre_completo');
//         $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
//         $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleColor);
//         $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleTextCenter);
//         $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($bordes);

//         $objPHPExcel->getActiveSheet()->getCell('C1')->setValue('id_rol');
//         $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
//         $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleColor);
//         $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleTextCenter);
//         $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($bordes);

//         $objPHPExcel->getActiveSheet()->getCell('D1')->setValue('fecha_ingreso');
//         $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
//         $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleColor);
//         $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleTextCenter);
//         $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($bordes);


//         for($i=0;$i<count($arrayEmpleados);$i++)
//             {
//             $objPHPExcel->setActiveSheetIndex(0)
//             ->getStyle('A'.($i+2))
//             ->applyFromArray($bordes);
//             $objPHPExcel->setActiveSheetIndex(0)
//             ->getStyle('B'.($i+2))
//             ->applyFromArray($bordes);
//             $objPHPExcel->setActiveSheetIndex(0)
//             ->getStyle('C'.($i+2))
//             ->applyFromArray($bordes);
//             $objPHPExcel->setActiveSheetIndex(0)
//             ->getStyle('D'.($i+2))
//             ->applyFromArray($bordes);
        

//             $objPHPExcel->setActiveSheetIndex(0)
//             ->getStyle('A'.($i+2))
//             ->applyFromArray($styleTextCenter);
//             $objPHPExcel->setActiveSheetIndex(0)
//             ->getStyle('B'.($i+2))
//             ->applyFromArray($styleTextCenter);
//             $objPHPExcel->setActiveSheetIndex(0)
//             ->getStyle('C'.($i+2))
//             ->applyFromArray($styleTextCenter);
//             $objPHPExcel->setActiveSheetIndex(0)
//             ->getStyle('D'.($i+2))
//             ->applyFromArray($styleTextCenter);
            
//          //   $cantOperaciones=Operaciones::TraerOperacionesPorEmpleado($arrayEmpleados[$i]["IdEmpleado"]);

//         //`id_empleado`, `nombre_completo`, 'id_rol','fecha_ingreso'

//             $objPHPExcel->setActiveSheetIndex(0)
//                     ->setCellValue('A'.($i+2), $arrayEmpleados[$i]["id_empleado"])
//                     ->setCellValue('B'.($i+2),$arrayEmpleados[$i]["nombre_completo"])
//                     ->setCellValue('C'.($i+2),$arrayEmpleados[$i]["id_rol"])
//                     ->setCellValue('D'.($i+2),$arrayEmpleados[$i]["fecha_ingreso"]);
//         }

//         $styleArrayFecha = array(
//             'font'  => array(
//                 'bold'  => true,
//                 'color' => array('rgb' => '008000'),
//                 'size'  => 10,
//                 'name'  => 'Verdana'
//             ));

//         $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
//         $fecha_creacion = $dateTime->format("Y/m/d h:i A");
//         $objPHPExcel->getActiveSheet()->getCell('I1')->setValue("Fecha de creación:");
//         $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($styleArrayFecha);
//         $objPHPExcel->getActiveSheet()->getCell('I2')->setValue($fecha_creacion);
//         $objPHPExcel->getActiveSheet()->getStyle('I2')->applyFromArray($styleArrayFecha);

//         }
//         header('Content-Type: application/vnd.ms-excel');
//         header('Content-Disposition: attachment;filename="listadoEmpleados.xlsx"');
//         header('Cache-Control: max-age=0');
//         $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
//         $objWriter->save('php://output');

//     }

}

?>
