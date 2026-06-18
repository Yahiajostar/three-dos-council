<?php
require_once "../helpers/JWT.php";
require_once "../repos/material.php";
require_once "../helpers/response.php";


//get all material
function getAllMaterials()
{
    VerifyToken();
    $materials = getAllMaterialsRepo();

    response(
        200,
        "Materials Retrieved Successfully",
        $materials
    );
}

//delete material
function deleteMaterial($id)
{
    $verifiedToken = VerifyToken();
    require_admin($verifiedToken);
    $material = getMaterialByIdRepo($id);

    if(!$material)
    {
        response(
            404,
            "Material Not Found"
        );
        return;
    }

    deleteMaterialRepo($id);

    response(
        200,
        "Material Deleted Successfully"
    );
}

//add material
function addMaterial(){
    $verifiedToken = VerifyToken();
    require_admin($verifiedToken);

    $data = json_decode(
        file_get_contents("php://input"),
        true
    );
    addMaterialRepo(
        $data["session_id"],
        $data["content"]
    );
    response(
        201,
        "Material Added Successfully"
    );
}

//update Material
function updateMaterial($id){
    $verifiedToken = VerifyToken();
    require_admin($verifiedToken);
    
    $material = getMaterialByIdRepo($id);

    if(!$material){
        response(
            404,
            "Material Not Found"
        );
        return;
    }
    $data = json_decode(
    file_get_contents("php://input"),
    true
    );
    updateMaterialRepo(
        $id,
        $data["content"]
    );
    response(
        200,
        "Material Updated Successfully"
    );
}
?>
