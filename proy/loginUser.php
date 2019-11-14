<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$link = mysqli_connect('localhost', 'root', '', 'clase');
		try {			
			$userData 			=	$this->input->post("user",TRUE);
			$userPassword 		=	$this->input->post("password",TRUE);
			
			$sql='SELECT * from Usuarios where usuario=? OR password=? ORDER By id_Usuario';
			$user=$this->link->query($sql,array($userData,$userPassword));			
			if($user->num_rows()>0){
				if( $user->row()->password==$userPassword && $user->row()->usuario==$userData) {				
					$data= array(
						'id_Usuario' => $user->row()->id_Usuario,						
						'nombre_Usuario' => $user->row()->nombre						
					 );
					$this->session->unset_userdata("Habeats");  /// elimino las sesiones anteriores y creo una nueva

					$this->session->set_userdata("Habeats",$data);
					return "success";
				}	
				else{
					return "Verifique su contraseña"; //error en password 
				}
			}
			else{
				return "El usuario no está registrado"; //error usuario no existe
			}
			

		} catch (Exception $e) {
			return "error3";
		}
mysqli_close($link);
?>