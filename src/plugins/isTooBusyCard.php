<?php

function isTooBusyCard($card) {
	return $card["free"] <= 5 ? "red" : ($card["free"] <= 10 ? "orange" : "green");
}