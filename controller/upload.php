<?php
		function upload($file, $url){
			$time = date('Y_m_d_h_m_s');
			$nome_file = basename($time.$file['name']);
			move_uploaded_file($file['tmp_name'],"../upload/".$nome_file);
			$url_file = $url."upload/".$nome_file;
			return $url_file;
		}
?>