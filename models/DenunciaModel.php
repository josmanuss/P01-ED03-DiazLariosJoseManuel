<?php
class DenunciaModel{
    protected $db;

    public function __construct(){
        $this->db = Conexion::Conexion();
    }

    public function getDenuncia(){
        try {
            $stmt = $this->db->prepare("SELECT * FROM denuncias");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            error_log("" . $e->getMessage());
        }
    }
    

    public function addDenuncia($datos): bool {
        try {
            $stmt = $this->db->prepare("INSERT INTO denuncias (titulo, descripcion, ubicacion, estado, ciudadano, telefono_ciudadano) VALUES (:titulo, :descripcion, :ubicacion, :estado, :ciudadano, :telefono_ciudadano)");
            
            $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR); // Estado
            $stmt->bindParam(":ciudadano", $datos["ciudadano"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono_ciudadano", $datos["telefono_ciudadano"], PDO::PARAM_STR);
            
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount() > 0;
            return $filasAfectadas;
    
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }
    
            
    public function updDenuncia($datos): bool {
        try {
            $stmt = $this->db->prepare("UPDATE denuncias SET 
                titulo = :titulo, 
                descripcion = :descripcion, 
                ubicacion = :ubicacion, 
                estado = :estado, 
                ciudadano = :ciudadano, 
                telefono_ciudadano = :telefono_ciudadano 
                WHERE id = :id"
            );
 
            $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
            $stmt->bindParam(":ciudadano", $datos["ciudadano"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono_ciudadano", $datos["telefono_ciudadano"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT); 
    
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount() > 0;
            return $filasAfectadas;
    
        } 
        catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return false; 
        }
    }
    

    public function delDenuncia($id): bool {
        try {
            $stmt = $this->db->prepare("DELETE FROM denuncias WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount() > 0;
            return $filasAfectadas;
        } 
        catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return false; 
        }
    }
    
            
}


?>