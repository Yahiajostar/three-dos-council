<?php

require_once "../repos/material.php";
require_once "../helpers/response.php";


//get all material
function getAllMaterials()
{
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