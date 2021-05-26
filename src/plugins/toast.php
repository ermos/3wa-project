<?php

function setToast($type, $message): void {
	setcookie("toast", json_encode([ "type" => $type, "message" => $message ]), 0);
}

function toast(): void {
	if (isset($_COOKIE["toast"])) {
		$res = json_decode($_COOKIE["toast"], true);
		echo '<div id="toast" class="toast toast--'.$res["type"].'">'.$res["message"].'</div>';
		?>
		<script defer>
			setTimeout(() => document.querySelector("#toast").style.display = "none", 3000);
		</script>
		<?php
	}
}