<?php

function isActivePage($name) {
	return CURRENT_PAGE === $name ? 'class="active"' : '';
}