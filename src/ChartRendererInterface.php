<?php

namespace PHPMaker2023\jootidigitalhealthcare;

/**
 * Chart renderer interface
 */
interface ChartRendererInterface
{

    public function getContainer($width, $height);

    public function getScript($width, $height);
}
