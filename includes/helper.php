<?php

function cleanString(string $value): string
{
    return trim(htmlspecialchars($value, ENT_QUOTES));
}