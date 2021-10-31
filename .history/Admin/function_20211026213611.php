<?php
include("./connection.php");

function selecttb($key,$id){
    if($key=='phone'){
        $sql="SELECT * FROM SanPham WHERE SanPham.MSSP = '$id';";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($rs);
    }
    return $data;
}

// Upload một file

function upOneFile($uploadfile){
    $filePath = "../img_upload";
    $errors = true;
    if(!is_dir($filePath)){
        mkdir($filePath, 0777, true);
    }
    $file = validateUploadFiles($uploadfile, $filePath);
    if($file != false){
        move_uploaded_file($file['tmp_name'], $filePath.'/'.$file['name']);
        $errors = true;
    }
    else{
        // $errors[] = "The file ".basename($file['name'])." isn't valid.";
        $errors = false;
    }
    return $errors;
}

// Kiểm tra tính hợp lệ của file

function validateUploadFiles($file, $filePath){
    // Kiểm tra có phải là file ảnh không
    $validTypes = array("jpg", "png", "git", "jpeg", "bmp");
    $fileType = substr($file['name'], strrpos($file['name'], '.') + 1 );
    if(!in_array($fileType, $validTypes)){
        return false;
    }

    // Kiểm tra file đã tồn tại chưa, nếu có thì đổi tên
    $num = 1;
    $fileName = substr($file['name'], 0, strrpos($file['name'], '.'));
    while(file_exists($filePath.'/'.$fileName.'.'.$fileType)){
        $fileName = $fileName.'('.$num.')';
        $num++;
    }
    $file['name'] = $fileName . '.' . $fileType;
    return $file;
}

// Kiểm tra tính hợp lệ của file
function uploadFiles($uploadfiles){
    $files = array();
    $errors = array();
    //Xử lý dữ liêu 
    foreach($uploadfiles as $key => $values){
        foreach ($values as $index => $value) {
            $files[$index][$key] = $value;
        }

    }
    //Kiểm tra thư mục lưu trữ file uplaod đã tồn tại chưa
    $filePath = "../img_upload/";
    if(!is_dir($filePath)){
        mkdir($filePath, 0777, true);
    }
    foreach ($files as $file) {
        $file = validateUploadFiles($file, $filePath);
        if($file != false){
            move_uploaded_file($file['tmp_name'], $filePath.'/'.$file['name']);
        }
        else{
            // $errors[] = "The file ".basename($file['name'])." isn't valid.";
            $errors[] = $file['name'];
        }
    }
    return $errors;
}




// function uploadFiles($uploadfile){
//     $files = array();
//     $errors = array();
//     //Xử lý dữ liêu 
//     foreach($uploadfile as $key => $values){
//         if(is_array($values)){
//             foreach ($values as $index => $value) {
//                 $files[$index][$key] = $value;
//             }
//         }else{
//             $file['key'] = $values;
//         }

//     }
//     //Kiểm tra thư mục lưu trữ file uplaod đã tồn tại chưa
//     $filePath = "../img_upload/";;
//     if(!is_dir($filePath)){
//         mkdir($filePath, 0777, true);
//     }
//     // foreach ($files as $file) {
//     //     $file = validateUploadFiles($file, $filePath);
//     //     if($file != false){
//     //         move_uploaded_file($file['tmp_name'], $filePath.'/'.$file['name']);
//     //     }
//     //     else{
//     //         $errors[] = "The file ".basename($file['name'])." isn't valid.";
//     //     }
//     // }
//     if(is_array(reset($files))){
//         foreach ($files as $file) {
//             $result = processUploadFile($file, $filePath);
//             if($result['error']){
//                 $errors = $result['message'];
//             }
//             else{
//                 $returnFiles[] = $result['path'];
//             }
//         }

//     }else{
//         $result = processUploadFile($files, $filePath);
//             if($result['error']){
//                 return array(
//                     'error' => $result['mesaage']
//                 );
//             }
//             else{
//                 return array(
//                     'path' => $result['path']
//                 );
//             }   
//     }
//     return array(
//         'error' => $errors,
//         'uploaded_files' => $returnFiles
//     );
// }

// function processUploadFile($file, $filePath){
//     $file = validateUploadFiles($file, $filePath);
//     if($file != false){
//         $file['name'] = str_replace(' ','_',$file['name']);
//         // move_uploaded_file($file['tmp_name'], $filePath.'/'.$file['name']);
//         if(move_uploaded_file($file['tmp_name'],$filePath.'/'.$file['name'])){
//             return array(
//                 'error' => false,
//                 'path' => str_replace('../','/',$filePath).'/'.$file['name']
//                 // 'path' => $file['name']
//             );
//         }else{
//             return array(
//                 'error' => false,
//                 'message' => "File tải lên ".basename($file['name']) . " không hợp lệ"
//             );
//         }
//     }
// }
// function validateUploadFiles($file, $filePath){
//     // Kiểm tra có phải là file ảnh không
//     $validTypes = array("jpg", "png", "git", "jpeg", "bmp");
//     $fileType = substr($file['name'], strrpos($file['name'], '.') + 1 );
//     if(!in_array($fileType, $validTypes)){
//         return false;
//     }

//     // Kiểm tra file đã tồn tại chưa, nếu có thì đổi tên
//     $num = 1;
//     $fileName = substr($file['name'], 0, strrpos($file['name'], '.'));
//     while(file_exists($filePath.'/'.$fileName.'.'.$fileType)){
//         $fileName = $fileName.'('.$num.')';
//         $num++;
//     }
//     $file['name'] = $fileName . '.' . $fileType;
//     return $file;
// }
?>