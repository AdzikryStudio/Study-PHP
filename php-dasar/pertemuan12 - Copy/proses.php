<?php
include 'koneksi.php';

if(isset($_POST["aksi"])){
    if($_POST["aksi"] == "add"){
        $nip = htmlspecialchars($_POST['nip']);
        $nama_dosen = htmlspecialchars($_POST['nama_dosen']);
        $foto_dosen = basename($_FILES['foto_dosen']['name']);
        $jabatan = htmlspecialchars($_POST['jabatan']);
        $email = htmlspecialchars($_POST['email']);

        $dir = "img/";
        $tmpFile = $_FILES['foto_dosen']['tmp_name'];
        move_uploaded_file($tmpFile, $dir.$foto_dosen);

        $query ="INSERT INTO dt_dosen VALUES(null, '$nip', '$nama_dosen', '$foto_dosen','$jabatan', '$email')";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header('location: index.php');
            //echo "Data Berhasil Ditambahkan <a href='index.php'>Home</a>";
        } else {
            echo $query;
        }

        //echo $nip. " | ".$nama_dosen. " | ".$foto_dosen. " | ".$jabatan. " | ".$email;

       // echo "Tambah Data <a href='index.php'>Home</a>";
    } else if($_POST["aksi"] == "edit"){
        echo "Update Data <a href='index.php'>Home</a> ";

        $id_dosen = $_POST['id_dosen'];
        $nip = htmlspecialchars($_POST['nip']);
        $nama_dosen = htmlspecialchars($_POST['nama_dosen']);
        $jabatan = htmlspecialchars($_POST['jabatan']);
        $email = htmlspecialchars($_POST['email']);

        $query = "UPDATE dt_dosen SET nip='$nip', nama_dosen='$nama_dosen', jabatan='$jabatan', email='$email' WHERE id_dosen ='$id_dosen';"; 

        $sql = mysqli_query($conn, $query);

        if($sql){
            header('location: index.php');
            //echo "Data Berhasil Ditambahkan <a href='index.php'>Home</a>";
        } else {
            echo $query;
        }
    }

}
if(isset($_GET["delete"])){
    $id_dosen = $_GET['delete'];

    $queryShow = "SELECT * FROM dt_dosen WHERE id_dosen = '$id_dosen';";
    $sqlShow = mysqli_query($conn, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    $file_path = trim("img/".$result['foto_dosen']);
    unlink($file_path);
    

    $query = "DELETE FROM dt_dosen WHERE id_dosen = '$id_dosen';";
    $sql = mysqli_query($conn, $query);

    if($sql){
        header('location: index.php');
        //echo "Data Berhasil Ditambahkan <a href='index.php'>Home</a>";
    } else {
        echo $query;
    }

    //echo "Delete Data <a href='index.php'>Home</a> ";
}
?>