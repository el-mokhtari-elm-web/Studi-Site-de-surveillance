<?php 

class Adminmanager extends Dbconnect {

    public function getAdminChecked(Admin $newAdmin) {
        $emailAdmin = $newAdmin->getEmailAdmin();
        $passAdmin = $newAdmin->getPassAdmin();
        $stmt = self::$_instance_db->prepare("SELECT id, first_name, email_admin, pass_admin, level_right FROM administrators WHERE email_admin = :emailAdmin AND pass_admin = :passAdmin");
        $stmt->bindParam(':emailAdmin', $emailAdmin);
        $stmt->bindParam(':passAdmin', $passAdmin);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $row;
    }

}