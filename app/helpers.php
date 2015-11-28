<?php

/*
 * Use this for item instances (items as they exist in the world or inventory)
 * Check for collisions?
 */
function getRandomHex($num_bytes=4) {   //http://stackoverflow.com/a/22104268
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
}