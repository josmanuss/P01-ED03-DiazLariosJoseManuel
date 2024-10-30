<?php
class DenunciaController{
    protected $denuncias;
    
    
    public function __construct(){
        require_once ("models/DenunciaModel.php");  
        $this->denuncias = new DenunciaModel();
    }

    public function index(){
        $data["titulo"] = "GESTION DE DENUNCIAS";
        $data["categorias"] = $this->denuncias->getDenuncia();

        require_once "views/denuncia.php";
    }
    public function registrarDenuncia() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'ubicacion' => $_POST['ubicacion'],
                'estado' => $_POST["estado"],  
                'ciudadano' => $_POST['ciudadano'],
                'telefono_ciudadano' => $_POST['telefono_ciudadano'],
            ];
            if ($this->denuncias->addDenuncia($data)) {
                header("Location: index.php");
                exit(); 
            } else {
                echo "ERROR DE REGISTRO";
            }
        }
    }
    
    public function actualizarDenuncia() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'ubicacion' => $_POST['ubicacion'],
                'estado' => $_POST['estado'],
                'ciudadano' => $_POST['ciudadano'],
                'telefono_ciudadano' => $_POST['telefono_ciudadano'],
            ];
            

            if($this->denuncias->updDenuncia($data)) {
                header('location: index.php');
            }
            else{
                echo 'ERROR DE ACTUALIZACION';
            }
        }
    }
    public function eliminarDenuncia($id) {

        if ($id > 0 && $this->denuncias->delDenuncia($id)) {
            header("Location: index.php");
            exit(); 
        } else {
            exit("ERROR DE ELIMINACION");
        }
    }
    
    

}

?>