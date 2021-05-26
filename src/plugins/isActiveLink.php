<?php

function isActivePage($name): string {
	return CURRENT_PAGE === $name ? 'class="active"' : '';
}