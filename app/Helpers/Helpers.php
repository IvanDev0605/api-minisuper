<?php
/**
 * Verifica si un usuario tiene los permisos necesarios y devuelve una respuesta JSON.
 *
 * @param bool $status Un booleano que indica si el usuario tiene los permisos necesarios.
 * @param array $data Un array que contiene información adicional sobre los permisos requeridos.
 * @return mixed La respuesta JSON indica que el usuario no tiene los permisos necesarios.
 */

function respPermisos($status=null, $data = null)
{
  if (!$status) {
    return response()->json([
      'status' => $status,
      'message' => "Tu usuario no cuenta con los permisos para ". $data,
    ]);
  }
}

/**
 * Crea una respuesta JSON que indica si el registro se guardó correctamente o no.
 *
 * @param string|null $modelo El nombre del modelo que se está registrando.
 * @param array|null $data array que almacena toda la info del registro
 * @param bool|null $status Indica si el registro se guardó correctamente o no.
 * @return mixed La respuesta JSON indica si el registro se guardó correctamente.
 */

function respRegistro($modelo = null, $data = null, $status=null){
    if($status){  
      return response()->json([
      'status' => $status,
      'message' => "El registro se guardo con éxito ".$modelo,
      'data' => $data
    ]);
  }else{
    return response()->json([
      'status' => $status,
      'message' => $modelo,
      'data' => $data
    ],422);
  }}
  

/**
 * Función para responder a una consulta.
 *
 * @param string|null $modelo El nombre del modelo consultado.
 * @param object|null $data la información del modelo consultado
 * @return mixed La respuesta JSON indica si hay registros de esa consulta.
*/

  function respConsulta($modelo=null, $data=null)
{
  if (!$data->isEmpty()) {
    return response()->json([
      'status' => true,
      'message' => "Se consulto con éxito ".$modelo,
      'data' => $data
    ]);
  } else {
    return response()->json([
      'status' =>false,
      'message' => "No hay registros en ".$modelo
    ]);
  }
}



function respEliminar($modelo = null, $data = null){
    return response()->json([
        'status' => true,
        'message' => "El registro se elimino con exito ".$modelo,
        'data' => $data
      ]);
}

