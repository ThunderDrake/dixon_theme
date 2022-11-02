<?php

use Dixon\Helper;
use Dixon\Site;

function ct(): Site {
	return Site::getInstance();
}

function cth(): Helper {
	return Helper::getInstance();
}
