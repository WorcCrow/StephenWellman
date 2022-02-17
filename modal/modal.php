<?php
	if(isset($_GET['job'])){
		include($docroot."modal/preview-modal.php");
		include($docroot."modal/drone-preview-modal.php");
	}
	
	if(privilege() === 'administrator'){
		include($docroot."modal/personel-modal.php");
	}
	include($docroot."modal/spinner-modal.php");
?>

<script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'bottom-end',
      showConfirmButton: false,
      timer: 8000
    });
</script>